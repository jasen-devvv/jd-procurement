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
        'address',
        'rating'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public static function logActivity($eventName)
    {
        activity("supplier")
            ->causedBy(Auth::user())
            ->performedOn(new self())
            ->log("Supplier {$eventName}");
    }
}
