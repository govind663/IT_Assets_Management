<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'invoice_no',
        'vendor_id',
        'inward_dt',
        'work_order_no',
        'voucher_no',
        'inserted_by',
        'inserted_at',
        'modified_by',
        'modified_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    // Relationship with Vendor model.
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
