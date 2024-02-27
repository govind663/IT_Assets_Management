<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::select('id', 'dept_name', 'dep_code')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($departments);

        return view('master.department.index')->with(['department' => $departments]);
    }

    public function create()
    {
        return view('master.department.create');
    }

    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        try {

            $department = Department::create($data);

            return redirect()->route('department.index')->with('message','Department created successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    public function show(Department $Department)
    {
        // dd($Department);
        return view('master.department.view')->with(['department' => $Department]);
    }

    public function edit(Department $Department)
    {
        // dd($Department);
        return view('master.department.edit' )->with([ 'department'=>$Department ]);
    }

    public function update(DepartmentRequest $request, $id)
    {
        $data = $request->validated();
        $data['modified_by'] =  Auth::user()->id;
        $data['modified_at'] =  Carbon::now();
        try {

            $department = Department::findOrFail($id);
            $department->update($data);

            return redirect()->route('department.index')->with('message','Department updated successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $department = Department::findOrFail($id);
            $department->update($data);

            return redirect()->route('department.index')->with('message','Department Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
