<?php

namespace App\Models;

use App\Enums\ProfileGender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'about',
        'gender',
        'phone',
        'address',
    ];

    protected function casts(): array 
    {
        return [
            'gender' => ProfileGender::class
        ];
    }

    public static function logActivity($eventName)
    {
        activity('profile')
            ->causedBy(Auth::user())
            ->performedOn(new self())
            ->log("Profile {$eventName}");
    }
}
