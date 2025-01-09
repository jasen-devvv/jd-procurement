<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'name',
        'range_start',
        'range_end',
        'total_orders',
        'total_products',
        'total_suppliers',
        'top_product_id',
        'top_supplier_id',
    ];
}
