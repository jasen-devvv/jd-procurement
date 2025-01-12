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

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'top_product_id');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'top_supplier_id');
    }
}
