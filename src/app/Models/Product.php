<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'supplier_id',
        'name',
        'description',
        'price'
    ];

    public function Supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
