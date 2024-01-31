<?php

namespace App\logs;

use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class UserLogActivityLogs{

    public function logUserLoginActivity($tableName, $logType, $data=null){

        if (Auth::check()) {
            $user = Auth::user();
            $data = [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'table_name' => $tableName,
                'log_type' => $logType,
                'logged_at' => now(),
                'url' => URL::full(),
                'ip' => request()->ip(),
                'device' => request()->header('Device-Type'),
                'platform' =>request()->header('Platform') ?: "Other",
                'os_version' => request()->header('OS-Version') ?: "Not Mentioned"
            ];
        }

        return UserActivityLog::create([
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'table_name' => $tableName,
            'log_type' => $logType,
            'data' => json_encode($data),
            'url' => URL::current(),
            'action' => isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '',
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }

}
