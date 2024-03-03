<?php

namespace App\Http\Controllers;

use App\Models\NewMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewMaterialController extends Controller
{
    public function index()
    {
        $newMaterials = NewMaterial::with('department')->whereNull('deleted_at')->orderBy('id', 'desc')->get();

        // === newMaterials status
        $currentMaterialStatus  = NewMaterial::whereNull('deleted_at')
                                               ->where('user_id', Auth::user()->id)
                                               ->orderByDesc('id')
                                               ->first( 'status' );
        // dd($currentMaterialStatus);
        if ( isset( $currentMaterialStatus ) && !is_null( $currentMaterialStatus->status ) ) {
            $materialStatus = $currentMaterialStatus->status;
        } else {
            $materialStatus =  "null";
        };
        return view('new_request_material.index', ['newMaterials' => $newMaterials, 'materialStatus' => $materialStatus]);
    }

    public function create()
    {
        return view('new_request_material.create');
    }

    public function show(string $id)
    {
        return view('new_request_material.view');
    }

    public function edit(String $id)
    {
        return view('new_request_material.edit');
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            // delete  from table stockdetail first then stock
            DB::table("request_material_products")->where("new_material_id", "=",  $id)->update($data);
            DB::table("new_materials")->where("id","=",$id)->update($data);

            return redirect()->route('new_request_material.index')->with('message','Your request for new material has been deleted successfully.');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
