<?php

namespace App\Models;

use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'supplier_id',
        'name',
        'description',
        'quantity',
        'deadline',
        'status',
        'rejection_reason'
    ];

    protected function casts(): array 
    {
        return [
            'status' => RequestStatus::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
