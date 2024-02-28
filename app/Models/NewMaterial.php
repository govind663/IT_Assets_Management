<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewMaterial extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'request_no',
        'user_id',
        'name',
        'department_id',
        'mobile_no',
        'email',
        'requested_at',
        'material_doc',
        'status',
        'inserted_by',
        'inserted_at',
        'modified_by',
        'modified_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    // Relationship with department model.
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    // Relationship with roles model.
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
