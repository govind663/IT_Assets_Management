<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveActionMaterial extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'new_material_id',
        'name',
        'mobile_no',
        'department_id',
        'gender',
        'role_id',
        'arrived_at',
        'inserted_by',
        'inserted_at',
        'modified_by',
        'modified_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    // Relationships New Materia
    public function newMaterial() {
        return $this->belongsTo(NewMaterial::class, "new_material_id")->withTrashed();
    }

    // Relationships Department
    public function department() {
        return $this->belongsTo(Department::class,  "department_id")->withTrashed();
    }

    // Relationships Role
    public function role(){
        return $this->belongsTo(Role::class,'role_id')->withTrashed();
    }
}
