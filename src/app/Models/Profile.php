<?php

namespace App\Models;

use App\Enums\ProfileGender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
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

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public static function activity($eventName)
    {
        activity('profile')
            ->causedBy(Auth::user())
            ->performedOn(new self())
            ->log("Profile {$eventName}");
    }
}
