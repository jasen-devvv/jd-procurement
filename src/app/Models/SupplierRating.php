<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'user_id',
        'rating',
        'review'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
