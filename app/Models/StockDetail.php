<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'stock_id',
        'product_code',
        'catagories_id',
        'product_id',
        'brand',
        'model',
        'unit_id',
        'warranty_dt',
        'quantity',
        'inserted_by',
        'inserted_at',
        'modified_by',
        'modified_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    // Relationship with Stock model.
    public function stock() {
        return $this->belongsTo(Stock::class);
    }

    // Relationship with Catagories model.
    public function catagory(){
        return $this->belongsTo(Catagories::class);
    }

    // Relationship with Product model.
    public function product(){
        return $this->belongsTo(Product::class);
    }

    // Relationship with Unit model.
    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
