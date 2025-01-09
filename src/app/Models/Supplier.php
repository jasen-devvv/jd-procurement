<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'address'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(SupplierRating::class);
    }

    public static function activity($eventName)
    {
        activity("supplier")
            ->causedBy(Auth::user())
            ->performedOn(new self())
            ->log("Supplier {$eventName}");
    }
}
