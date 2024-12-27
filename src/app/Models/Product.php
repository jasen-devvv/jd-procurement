<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

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

    public static function logActivity($eventName)
    {
        activity('product')
            ->causedBy(Auth::user()) 
            ->performedOn(new self())
            ->log("Product {$eventName}");
    }
}
