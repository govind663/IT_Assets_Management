<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemarksRequest;
use App\Models\NewMaterial;
use App\Models\ReceiveActionMaterial;
use App\Models\RequestMaterialProduct;
use App\Models\StockDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

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


        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1) {  // === Other Departmental HOD
            $query->where('status', $status);
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 && $status == 6 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
            $query->where('status', $status);
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 && $status == 3 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
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

        // ==== ReceiveActionMaterial  Module Start Here=====
        $materials['receiveActions'] = ReceiveActionMaterial::where('is_confirmed', 1)->where('new_material_id',$id)->first();
        // return($receiveActions);
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
        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1 ) {
            $update = [
                'status' => 6, // ==== form go to clerck  for approval
                'is_checked_by_hod' => 1, // === checked and approved by HOD
                'checked_by_hod_at' => date("Y-m-d H:i:s"),
            ];

            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 1)->with('message', "The request for material has been checked and approved by the department HOD.");

        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1){
            $update = [
                'status' => 7,
                'is_processed_by_clerk' => 1, // === checked and approved by It Dept clerk
                'checked_by_clerk_at' => date("Y-m-d H:i:s"),
            ];
            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 1)->with('message', 'The request for material has been reviewed and endorsed by the department clerk.');

        } elseif (Auth::user()->role_id == 2 && Auth::user()->department_id == 1){
            $update = [
                'status' => 7,
                'is_processed_by_it' => 1, // === checked and approved by It Dept clerk
                'sent_to_it_at' => date("Y-m-d H:i:s"),
            ];
            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 1)->with('message', 'The request for material has been reviewed and endorsed by the department HOD.');
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

            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 2)->with('message', 'The request for material has been reviewed and rejected by the department HOD.');

        } elseif (Auth::user()->role_id == 2 && Auth::user()->department_id == 1) {
            $update = [
                'status' => 2, // === Rejected
                'is_processed_by_clerk' => 2, // ===== material processing was rejected by clerk
                'rejection_reason_by_clerk' => $request->get('rejection_reason_by_clerk'),
                'checked_by_clerk_at' => date("Y-m-d H:i:s"),
            ];

            NewMaterial::where('id', $id)->where('status', $status)->update($update);
            return redirect()->route('request-new-material.processslist', 2)->with('message', 'The request for material has been reviewed and rejected by the department clerk.');

        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1) {
            $update = [
                'status' => 2, // === Rejected
                'is_processed_by_it' => 2, // ===== material processing was rejected by clerk
                'rejection_reason_by_it' => $request->get('rejection_reason_by_it'),
                'sent_to_it_at' => date("Y-m-d H:i:s"),
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

        if (Auth::user()->role_id == 2 && Auth::user()->department_id != 1) {  // === Departmental HOD
            $query->where('is_checked_by_hod', $status);
        } elseif (Auth::user()->role_id == 3 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
                $query->where('is_processed_by_clerk', $status);

        } elseif (Auth::user()->role_id == 2 && Auth::user()->department_id == 1) {  //=== Departmental Clerk
            $query->where('is_processed_by_it', $status);
        }

        $newMaterials = $query->get();

        // return($newMaterials);

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

        $materials['new_material'] = $query->firstOrFail();

        //  Checking whether there is any record or not in other table  for this id then push  it to view data array
        foreach ($materials as $material ) {

            $materials['requested_products'] = RequestMaterialProduct::with('catagory','product','unit')
                                                ->where("new_material_id", $material->id)
                                                ->get();
        }
        // return $materials['requested_products'];

        // ==== ReceiveActionMaterial  Module Start Here=====
        $materials['receiveActions'] = ReceiveActionMaterial::where('is_confirmed', 1)->where('new_material_id',$id)->first();
        // return($receiveActions);

        return view('all_request_material.current_request_material.view', ['materials' => $materials,  'status'=>$status]);
    }

    // ==== Receive  Material
    public function receiveMaterial(Request $request, $id, $status )
    {

        // ==== only  for department clerk with  status "Approved"
        if (Auth::user()->role_id ==  2 && Auth::user()->department_id == 1 ) {
            try {
                $data = new ReceiveActionMaterial();
                $data->new_material_id = $id;
                $data->name =  Auth::user()->f_name.' '. Auth::user()->m_name. ' '. Auth::user()->l_name;
                $data->mobile_no =  Auth::user()->phone_number;
                $data->department_id = Auth::user()->department_id;
                $data->gender = Auth::user()->gender;
                $data->role_id =  Auth::user()->role_id;
                $data->date_time_of_receive =  Carbon::now();
                $data->is_confirmed = 1 ;
                $data->inserted_by =  Auth::user()->id;
                $data->inserted_at =  Carbon::now();
                $data->save();

                //  update the status NewMaterial is delivered  to the clerk
                NewMaterial::where('id' ,$id)->update(['is_processed_by_it'=> 3, 'status'=> 3]);

                $totalQuantity = 0;
                $currentQuantity = $request->input('current_quantity');
                $actualQuantity = StockDetail::where('product_id', $request->input('product_id'))->value('quantity');
                $totalQuantity  = $actualQuantity - $currentQuantity;
                // dd($totalQuantity);
                $update = [
                    'quantity' => $totalQuantity,
                ];
                StockDetail::where([ ['product_code', '=', $request->input("product_code")] ])->update($update);

                return  redirect()->route('request-new-material.processslist', $status )->with('message',  'The Material has been successfully received by the departement clerck & added to the product list !');

            } catch(\Exception $ex){
                return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
            }
        } elseif (Auth::user()->role_id ==  3 &&  Auth::user()->department_id == 1 ) {
            try {
                $data = new ReceiveActionMaterial();
                $data->new_material_id = $id;
                $data->name =  Auth::user()->f_name.' '. Auth::user()->m_name. ' '. Auth::user()->l_name;
                $data->mobile_no =  Auth::user()->phone_number;
                $data->department_id = Auth::user()->department_id;
                $data->gender = Auth::user()->gender;
                $data->role_id =  Auth::user()->role_id;
                $data->date_time_of_receive =  Carbon::now();
                $data->is_confirmed = 1 ;
                $data->inserted_by =  Auth::user()->id;
                $data->inserted_at =  Carbon::now();
                $data->save();

                //  update the status NewMaterial is delivered  to the clerk
                NewMaterial::where('id' ,$id)->update(['is_processed_by_clerk'=>3, 'status'=>3]);

                $totalQuantity = 0;
                $currentQuantity = $request->input('current_quantity');
                $actualQuantity = StockDetail::where('product_id', $request->input('product_id'))->value('quantity');
                $totalQuantity  = $actualQuantity - $currentQuantity;
                // dd($totalQuantity);
                $update = [
                    'quantity' => $totalQuantity,
                ];
                StockDetail::where([ ['product_code', '=', $request->input("product_code")] ])->update($update);

                return  redirect()->route('request-new-material.processslist', $status )->with('message',  'The Material has been successfully received by the departement clerck & added to the product list !');

            } catch(\Exception $ex){
                return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id, $status)
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

        // ==== ReceiveActionMaterial  Module Start Here=====
        $materials['receiveActions'] = ReceiveActionMaterial::where('is_confirmed', 1)->where('new_material_id',$id)->first();
        // return($materials['receiveActions']);


        return FacadePdf::loadView('all_request_material.request_material.pdf', ['materials' => $materials,  'status'=>$status])
                        ->stream('order_details.' . $materials['new_material']->fileExtension);

        // return view('all_request_material.request_material.pdf', ['materials' => $materials,  'status'=>$status]);
    }

}
