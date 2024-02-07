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
        $vendors = Vendor::select('id', 'company_name', 'company_add', 'company_phone_no', 'phone', 'email', 'gst_no', 'description', 'status')
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

    public function store(VendorsRequest $request, )
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        try {
            Vendor::create($data);
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
        $data = $request->validated();
        $data['modified_by'] =  Auth::user()->id;
        $data['modified_at'] =  Carbon::now();
        try {
            $catagories= Vendor::findOrFail($id);
            $catagories->update($data);
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
            $catagories = Vendor::findOrFail($id);
            $catagories->update();

            return redirect()->route('vendors.index')->with('message','Vendors Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}