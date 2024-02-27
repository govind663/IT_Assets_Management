<?php

namespace App\Http\Controllers;

use App\Models\NewMaterial;
use App\Models\RequestMaterialProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllRequestMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status)
    {
        $query = NewMaterial::with('department')
                 ->whereNull('deleted_at')
                 ->orderBy('id', 'desc');


        if (Auth::user()->role_id == 1) {  // === Departmental Head
            $query->where('status', $status);
        } elseif (Auth::user()->role_id == 2) {  // === Departmental HOD
            $query->where('status', $status);
        } elseif (Auth::user()->role_id == 3) {  //=== Departmental Clerk
            $query->where('status', $status);
        }

        $newMaterials = $query->get();

        return view('all_request_material.request_material.index', ['newMaterials' => $newMaterials,  'status'=>$status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $status)
    {
        $query = NewMaterial::with('department')
                 ->whereNull('deleted_at')
                 ->orderBy('id', 'desc');


        if (Auth::user()->role_id == 1) {  // === Departmental Head
            $query->where('id', $id)
                  ->where('status', $status);
        } elseif (Auth::user()->role_id == 2) {  // === Departmental HOD
            $query->where('id', $id)
                  ->where('status', $status);
        } elseif (Auth::user()->role_id == 3) {  //=== Departmental Clerk
            $query->where('id', $id)
                  ->where('status', $status);
        }

        $materials['new_material'] = $query->firstOrFail();

        //  Checking whether there is any record or not in other table  for this id then push  it to view data array
        foreach ($materials as $material ) {

            $materials['requested_products'] = RequestMaterialProduct::with('catagory','product','unit')
                                                ->where("new_material_id", $material->id)
                                                ->get();
        }
        // return $materials['requested_products'];
        return view('all_request_material.request_material.view', ['materials' => $materials,  'status'=>$status]);
    }
}
