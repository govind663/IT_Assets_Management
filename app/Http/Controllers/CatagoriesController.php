<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatagoriesRequest;
use App\Models\Catagories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CatagoriesController extends Controller
{
    public function index()
    {
        $catagories = Catagories::select('id', 'catagories_name')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($catagories);

        return view('master.catagories.index')->with(['catagories' => $catagories]);
    }

    public function create()
    {
        return view('master.catagories.create');
    }

    public function store(CatagoriesRequest $request, )
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        try {
            Catagories::create($data);
            return redirect()->route('catagories.index')->with('message','Category created successfully');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    public function show(Catagories $catagories, $id)
    {
        $catagories = Catagories::findOrFail($id);
        // dd($catagories);
        return view('master.catagories.view')->with(['catagories' => $catagories]);
    }

    public function edit(Catagories $catagories, $id)
    {
        $catagories = Catagories::findOrFail($id);
        // dd($catagories);
        return view('master.catagories.edit' )->with([ 'catagories'=>$catagories ]);
    }

    public function update(CatagoriesRequest $request, $id)
    {
        $data = $request->validated();
        $data['modified_by'] =  Auth::user()->id;
        $data['modified_at'] =  Carbon::now();
        try {
            $catagories= Catagories::findOrFail($id);
            $catagories->update($data);
            return redirect()->route('catagories.index')->with('message', 'Category updated Successfully!');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $catagories = Catagories::findOrFail($id);
            $catagories->update();

            return redirect()->route('catagories.index')->with('message','Category Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
