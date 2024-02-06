<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::select('id', 'unit_name')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($units);

        return view('master.units.index')->with(['units' => $units]);
    }

    public function create()
    {
        return view('master.units.create');
    }

    public function store(UnitRequest $request, )
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        try {
            Unit::create($data);
            return redirect()->route('units.index')->with('message','Units created successfully');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    public function show(Unit $units, $id)
    {
        $units = Unit::findOrFail($id);
        // dd($units);
        return view('master.units.view')->with(['units' => $units]);
    }

    public function edit(Unit $units, $id)
    {
        $units = Unit::findOrFail($id);
        // dd($units);
        return view('master.units.edit' )->with([ 'units'=>$units ]);
    }

    public function update(UnitRequest $request, $id)
    {
        $data = $request->validated();
        $data['modified_by'] =  Auth::user()->id;
        $data['modified_at'] =  Carbon::now();
        try {
            $units= Unit::findOrFail($id);
            $units->update($data);
            return redirect()->route('units.index')->with('message', 'Units updated Successfully!');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $units = Unit::findOrFail($id);
            $units->update($data);

            return redirect()->route('units.index')->with('message','Units Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
