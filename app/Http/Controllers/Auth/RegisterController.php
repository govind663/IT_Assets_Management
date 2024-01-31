<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\logs\UserLogActivityLogs;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    protected $UserLogActivityLogs;

    public function __construct(UserLogActivityLogs $UserLogActivityLogs)
    {
        $this->UserLogActivityLogs = $UserLogActivityLogs;
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = new User();
        $data->name = $request->get('name');
        $data->email = $request->get('email');
        $data->password = Hash::make($request->get('password'));
        $data->created_at = date("Y-m-d H:i:s");
        $data->save();

        $update = [
            'created_by' => $data->id,
        ];

        User::where('id', $data->id)->update($update);

        $this->UserLogActivityLogs->logUserLoginActivity('users', 'Created New Recoard Successfully.' , $data);

        return redirect()->route('login')->with('message', 'You are Register Sucessfully.');
    }
}
