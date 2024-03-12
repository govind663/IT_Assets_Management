<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMaterialProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'new_material_id',
        'catagories_id',
        'product_id',
        'product_code',
        'brand',
        'model',
        'unit_id',
        'quantity',
        'inserted_by',
        'created_at',
        'modified_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    // Relationship with Catagories model.
    public function catagory(){
        return $this->belongsTo(Catagories::class , "catagories_id");
    }

    // Relationship with Product model.
    public function product(){
        return $this->belongsTo(Product::class , "product_id", "id");
    }

    // Relationship with Unit model.
    public function unit() {
        return $this->belongsTo(Unit::class , "unit_id");
    }

    // Relationship with new_material_id model.
    public function material() {
        return $this->belongsTo(NewMaterial::class,  "new_material_id");
    }

}
