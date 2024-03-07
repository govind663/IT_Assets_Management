<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemarksRequest;
use App\Models\ReplaceOldMaterial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AllRequestReturnMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status)
    {
        $query = ReplaceOldMaterial::with('department', 'product')
                 ->whereNull('deleted_at')
                 ->orderBy('id', 'desc');


        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1) {  // === Other Departmental HOD
            $query->where('status', $status);
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 && $status == 6 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
            $query->where('status', $status);
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 && $status == 3 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
            $query->where('status', $status);
        }

        $returnMaterials = $query->get();

        return view('all_replace-material.replace-material.index', ['returnMaterials' => $returnMaterials,  'status'=>$status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $status)
    {
        $query = ReplaceOldMaterial::with('department', 'product')
                 ->whereNull('deleted_at')
                 ->orderBy('id', 'desc');

        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1) {  // === Other Departmental HOD
            $query->where('id', $id)
                  ->where('status', $status);
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
            $query->where('id', $id)
                  ->where('status', $status);
        }

        $replaceOldMaterial = $query->firstOrFail();

        return view('all_replace-material.replace-material.view', ['replaceOldMaterial' => $replaceOldMaterial,  'status'=>$status]);
    }

    /**
     * Approved the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveRequestMaterial($id, $status)
    {
        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1 ) {
            $update = [
                'status' => 6, // ==== form go to clerck  for approval
                'is_checked_by_hod' => 1, // === checked and approved by HOD
                'checked_by_hod_at' => date("Y-m-d H:i:s"),
            ];

            ReplaceOldMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('replace-old-material.processslist', 1)->with('message', "The request for material has been checked and approved by the department HOD.");

        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1){
            $update = [
                'status' => 7,
                'is_processed_by_clerk' => 1, // === checked and approved by It Dept clerk
                'checked_by_clerk_at' => date("Y-m-d H:i:s"),
            ];
            ReplaceOldMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('replace-old-material.processslist', 1)->with('message', 'The request for material has been reviewed and endorsed by the department clerk.');

        } elseif (Auth::user()->role_id == 2 && Auth::user()->department_id == 1){
            $update = [
                'status' => 7,
                'is_processed_by_it' => 1, // === checked and approved by It Dept clerk
                'sent_to_it_at' => date("Y-m-d H:i:s"),
            ];
            ReplaceOldMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('replace-old-material.processslist', 1)->with('message', 'The request for material has been reviewed and endorsed by the department HOD.');
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
        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1) {
            $update = [
                'status' => 2, // === Rejected
                'is_checked_by_hod' => 2, // ===== checked and rejected  by HOD
                'rejection_reason_by_hod' => $request->get('rejection_reason_by_hod'),
                'checked_by_hod_at' => date("Y-m-d H:i:s"),
            ];

            ReplaceOldMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('replace-old-material.processslist', 2)->with('message', 'The request for material has been reviewed and rejected by the department HOD.');

        } elseif (Auth::user()->role_id == 2 && Auth::user()->department_id == 1) {
            $update = [
                'status' => 2, // === Rejected
                'is_processed_by_clerk' => 2, // ===== material processing was rejected by clerk
                'rejection_reason_by_clerk' => $request->get('rejection_reason_by_clerk'),
                'checked_by_clerk_at' => date("Y-m-d H:i:s"),
            ];

            ReplaceOldMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('replace-old-material.processslist', 2)->with('message', 'The request for material has been reviewed and rejected by the department clerk.');

        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1) {
            $update = [
                'status' => 2, // === Rejected
                'is_processed_by_it' => 2, // ===== material processing was rejected by clerk
                'rejection_reason_by_it' => $request->get('rejection_reason_by_it'),
                'sent_to_it_at' => date("Y-m-d H:i:s"),
            ];

            ReplaceOldMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('replace-old-material.processslist', 2)->with('message', 'The request for material has been reviewed and rejected by the department clerk.');

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listRequestMaterial($status)
    {
        $query = ReplaceOldMaterial::with('department', 'product')
                 ->whereNull('deleted_at')
                 ->orderBy('id', 'desc');

        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1) {  // === Departmental HOD
            $query->where('is_checked_by_hod', $status);
        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
                $query->where('is_processed_by_clerk', $status);
        } elseif (Auth::user()->role_id == 2 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
            $query->where('is_processed_by_it', $status);
        }

        $returnMaterials = $query->get();

        return view('all_replace-material.current-replace-material.index', ['returnMaterials' => $returnMaterials,  'status'=>$status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRequestMaterial($id, $status)
    {
        $query = ReplaceOldMaterial::with('department', 'product')
                 ->whereNull('deleted_at')
                 ->orderBy('id', 'desc');


        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1) {  // === Departmental HOD
            $query->where('id', $id)
                  ->where('is_checked_by_hod', $status);
        } elseif (Auth::user()->role_id == 2 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
            $query->where('id', $id)
                  ->where('is_processed_by_it', $status);
        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
            $query->where('id', $id)
                  ->where('is_processed_by_clerk', $status);
        }

        $replaceOldMaterial = $query->firstOrFail();

        return view('all_replace-material.current-replace-material.view', ['replaceOldMaterial' => $replaceOldMaterial,  'status'=>$status]);
    }

}
