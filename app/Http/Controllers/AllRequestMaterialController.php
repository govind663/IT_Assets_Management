<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemarksRequest;
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

    /**
     * Approved the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveRequestMaterial($id, $status)
    {
        if (Auth::user()->role_id == 2 && Auth::user()->department_id == 1 ) {
            $update = [
                'status' => 6, // ==== form go to clerck  for approval
                'is_checked_by_hod' => 1, // === checked and approved by HOD
                'checked_by_hod_at' => date("Y-m-d H:i:s"),
            ];

            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 1)->with('message', "The request for material has been checked and approved by the department HOD.");

        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1){
            $update = [
                'status' => 7, // ==== form go to IT Department for appproval
                'is_processed_by_clerk' => 1, // === checked and approved by Clerk
                'checked_by_clerk_at' => date("Y-m-d H:i:s"),
            ];
            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 1)->with('message', 'The request for material has been reviewed and endorsed by the department clerk.');
        }

    }

    /**
     * Rejected the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectRequestMaterial(RemarksRequest $request, $id, $status)
    {
        if (Auth::user()->role_id == 2 && Auth::user()->department_id == 1 ) {
            $update = [
                'status' => 2, // === Rejected
                'is_checked_by_hod' => 2, // ===== checked and rejected  by HOD
                'rejection_reason_by_hod' => $request->get('rejection_reason_by_hod'),
                'checked_by_hod_at' => date("Y-m-d H:i:s"),
            ];

            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 2)->with('message', 'The request for material has been reviewed and rejected by the department HOD.');


        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1) {
            $update = [
                'status' => 2, // === Rejected
                'is_processed_by_clerk' => 2, // ===== material processing was rejected by clerk
                'rejection_reason_by_clerk' => $request->get('rejection_reason_by_clerk'),
                'checked_by_clerk_at' => date("Y-m-d H:i:s"),
            ];

            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 2)->with('message', 'The request for material has been reviewed and rejected by the department clerk.');


        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listRequestMaterial($status)
    {
        $query = NewMaterial::with('department')
                 ->whereNull('deleted_at')
                 ->orderBy('id', 'desc');


        if (Auth::user()->role_id == 2) {  // === Departmental HOD
            $query->where('is_checked_by_hod', $status);
        } elseif (Auth::user()->role_id == 3) {  //=== Departmental Clerk
            $query->where('is_processed_by_clerk', $status);
        }

        $newMaterials = $query->get();

        return view('all_request_material.current_request_material.index', ['newMaterials' => $newMaterials,  'status'=>$status]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRequestMaterial($id, $status)
    {
        $query = NewMaterial::with('department', 'role')
                 ->whereNull('deleted_at')
                 ->orderBy('id', 'desc');


        if (Auth::user()->role_id == 2) {  // === Departmental HOD
            $query->where('id', $id)
                  ->where('is_checked_by_hod', $status);
        } elseif (Auth::user()->role_id == 3) {  //=== Departmental Clerk
            $query->where('id', $id)
                  ->where('is_processed_by_clerk', $status);
        }

        $materials['new_material'] = $query->firstOrFail();

        //  Checking whether there is any record or not in other table  for this id then push  it to view data array
        foreach ($materials as $material ) {

            $materials['requested_products'] = RequestMaterialProduct::with('catagory','product','unit')
                                                ->where("new_material_id", $material->id)
                                                ->get();
        }
        // return $materials['requested_products'];
        return view('all_request_material.current_request_material.view', ['materials' => $materials,  'status'=>$status]);
    }
}
