<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'company_name',
        'company_add',
        'company_phone_no',
        'phone',
        'email',
        'gst_no',
        'description' ,
        'status',
        'inserted_by',
        'inserted_at',
        'modified_by',
        'modified_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

}
