<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'description',
        'quantity',
        'deadline',
        'status'
    ];

    protected function casts(): array 
    {
        return [
            'status' => OrderStatus::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function activity($eventName)
    {
        activity('order')
            ->causedBy(Auth::user())
            ->performedOn(new self())
            ->log("Order {$eventName}");
    }
}
