<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorsRequest;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorsController extends Controller
{
    public function index()
    {
        $vendors = Vendor::select('id', 'company_name', 'company_add', 'company_phone_no', 'person_name', 'phone', 'email', 'gst_no', 'description', 'status')
                           ->whereNull('deleted_at')
                           ->orderBy('id', 'desc')
                           ->get();
        // dd($vendors);

        return view('master.vendors.index')->with(['vendors' => $vendors]);
    }

    public function create()
    {
        return view('master.vendors.create');
    }

    public function store(VendorsRequest $request)
    {
        $request->validated();
        try {
            $vendor = new Vendor();
            $vendor->company_name = $request->company_name;
            $vendor->company_add = $request->company_add;
            $vendor->company_phone_no = $request->company_phone_no;
            $vendor->person_name = $request->person_name;
            $vendor->phone = $request->phone;
            $vendor->email = $request->email;
            $vendor->gst_no = $request->gst_no;
            $vendor->description = $request->description;
            $vendor->inserted_by =  Auth::user()->id;
            $vendor->inserted_at =  Carbon::now();
            $vendor->save();

            return redirect()->route('vendors.index')->with('message','Vendors created successfully');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    public function show(Vendor $vendors, $id)
    {
        $vendors = Vendor::findOrFail($id);
        // dd($vendors);
        return view('master.vendors.view')->with(['vendors' => $vendors]);
    }

    public function edit(Vendor $vendors, $id)
    {
        $vendors = Vendor::findOrFail($id);
        // dd($vendors);
        return view('master.vendors.edit' )->with([ 'vendors'=>$vendors ]);
    }

    public function update(VendorsRequest $request, $id)
    {
        $request->validated();

        try {

            $vendor= Vendor::findOrFail($id);
            $vendor->company_name = $request->company_name;
            $vendor->company_add = $request->company_add;
            $vendor->company_phone_no = $request->company_phone_no;
            $vendor->person_name = $request->person_name;
            $vendor->phone = $request->phone;
            $vendor->email = $request->email;
            $vendor->gst_no = $request->gst_no;
            $vendor->description = $request->description;
            $vendor->modified_by =  Auth::user()->id;
            $vendor->modified_at =  Carbon::now();
            $vendor->update();

            return redirect()->route('vendors.index')->with('message', 'Vendors updated Successfully!');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $vendors = Vendor::findOrFail($id);
            $vendors->update();

            return redirect()->route('vendors.index')->with('message','Vendors Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
