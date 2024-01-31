<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'table_name',
        'log_type',
        'data',
        'url',
        'action',
        'ip_address',
        'created_at',
        'updated_at',
    ];
}
