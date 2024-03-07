<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplaceOldMaterial extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'serial_no',
        'product_id',
        'department_id',
        'work_order_no',
        'order_dt',
        'supply_dt',
        'return_dt',
        'reason',
    ];
    protected $dates = ['deleted_at'];

    // Relationship with Product model.
    public function product(){
        return $this->belongsTo(Product::class , "product_id", "id");
    }

    // Relationship with Department model.
    public function department() {
        return $this->belongsTo(Department::class, "department_id","id");
    }
}
