<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'product_code',
        'name',
        'catagories_id',
        'unit_id',
        'brand',
        'model_no',
        'description' ,
        'is_available',
        'inserted_by',
        'inserted_at',
        'modified_by',
        'modified_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at', 'inserted_at', 'modified_at'];

    // Relationship with Catagory model
    public function catagories()
    {
        return $this->belongsTo(Catagories::class);
    }

    // Relationship with Unit model
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
