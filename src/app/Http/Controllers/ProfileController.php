<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Enums\ProfileGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $genders = ProfileGender::cases();
        $userId = Auth::id();
        $profile = Profile::where('user_id', $userId)->first();

        $data = [
            'title' => 'Profile | E-Procurement',
            'genders' => $genders,
            'profile' => $profile
        ];

        return view('dashboard.profile', $data);
    }

    public function update(Request $request)
    {
        $validData = $request->validate([
            'full_name' => 'nullable',
            'about' => 'nullable',
            'address' => 'nullable',
            'gender' => ['nullable', Rule::enum(ProfileGender::class)],
            'phone' => 'nullable'
        ]);

        $userId = Auth::id();

        $profile = Profile::updateOrCreate(['user_id' => $userId], $validData);
        Profile::logActivity('updated');

        return redirect()->route('profile');
    }

    public function change_password(Request $request)
    {
        $validData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if(!Hash::check($validData['old_password'], $user->password)) {
            return redirect()->back();
        }

        $user->password = $validData['new_password'];
        $user->save();
        
        return redirect()->route('profile');
    }
}
