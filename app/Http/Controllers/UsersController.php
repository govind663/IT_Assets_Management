<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('department', 'role')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        // dd($users);

        return view('master.users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = Department::select('dept_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $rols = Role::select('role_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        return view('master.users.create')->with([ 'rols' => $rols, 'department' => $department ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersRequest $request)
    {
        $data = $request->validated();
        try {
            $data = new User();
            $data->f_name =  $request->get('f_name');
            $data->m_name =  $request->get('m_name');
            $data->l_name =  $request->get('l_name');
            $data->department_id =  $request->get('department_id');
            $data->role_id =  $request->get('role_id');
            $data->phone_number =  $request->get('phone_number');
            $data->email =  $request->get('email');
            $data->password =  Hash::make($request->get('password'));
            $data->created_by =  Auth::user()->id;
            $data->created_at =  Carbon::now();
            $data->save();

            return redirect()->route('users.index')->with('message','Users created successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $users = User::findOrFail($id)->with('department', 'role')->whereNull('deleted_at')->orderByDesc('id')->first();
        // return($users);
        return view('master.users.view')->with(['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        $department = Department::select('dept_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();
        $rols = Role::select('role_name', 'id')->whereNull('deleted_at')->orderByDesc('id')->get();

        // dd($users);
        return view('master.users.edit')->with(['users' => $users, 'rols' => $rols, 'department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersRequest $request, $id)
    {
        $data = $request->validated($id);
        try {
            $data = User::findOrFail($id);
            $data->f_name =  $request->get('f_name');
            $data->m_name =  $request->get('m_name');
            $data->l_name =  $request->get('l_name');
            $data->role_id =  $request->get('role_id');
            $data->department_id =  $request->get('department_id');
            $data->phone_number =  $request->get('phone_number');
            $data->email =  $request->get('email');
            $data->updated_by =  Auth::user()->id;
            $data->updated_at =  Carbon::now();
            $data->update();

            return redirect()->route('users.index')->with('message','Users updated successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $user = User::findOrFail($id);
            $user->update($data);

            return redirect()->route('users.index')->with('message','Users Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
