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
        'catagories_id',
        'inward_dt',
        'product_id',
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
}
