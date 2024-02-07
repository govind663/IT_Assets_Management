<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolesRequest;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::select('id', 'role_name')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($roles);

        return view('master.roles.index')->with(['roles' => $roles]);
    }

    public function create()
    {
        return view('master.roles.create');
    }

    public function store(RolesRequest $request, )
    {
        $data = $request->validated();
        $data['inserted_by'] =  Auth::user()->id;
        $data['inserted_at'] =  Carbon::now();
        try {
            Role::create($data);
            return redirect()->route('roles.index')->with('message','Role created successfully');

        } catch(\Exception $ex){
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    public function show( Role $roles, $id)
    {
        $roles = Role::findOrFail($id);
        // dd($roles);
        return view('master.roles.view')->with(['roles' => $roles]);
    }

    public function edit( Role $roles, $id)
    {
        $roles = Role::findOrFail($id);
        // dd($roles);
        return view('master.roles.edit' )->with([ 'roles'=>$roles ]);
    }

    public function update(RolesRequest $request, $id)
    {
        $data = $request->validated();
        $data['modified_by'] =  Auth::user()->id;
        $data['modified_at'] =  Carbon::now();
        try {
            $roles= Role::findOrFail($id);
            $roles->update($data);
            return redirect()->route('roles.index')->with('message', 'Role updated Successfully!');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $roles = Role::findOrFail($id);
            $roles->update();

            return redirect()->route('roles$roles.index')->with('message','Role Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
