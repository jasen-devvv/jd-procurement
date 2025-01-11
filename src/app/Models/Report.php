<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'total_orders',
        'total_products',
        'total_suppliers',
        'top_product_id',
        'top_product_total',
        'top_supplier_id',
        'top_supplier_total',
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];
}
