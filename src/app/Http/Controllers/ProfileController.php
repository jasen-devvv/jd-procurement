<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Enums\ProfileGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display the specified profile user.
     */
    public function index()
    {
        $genders = ProfileGender::cases();
        $userId = Auth::id();
        $profile = Profile::where('user_id', $userId)->first();

        $activeTab = session('activeTab', 'profile-overview');

        $data = [
            'title' => 'Profile | E-Procurement',
            'genders' => $genders,
            'profile' => $profile,
            'activeTab' => $activeTab
        ];

        return view('dashboard.profile', $data);
    }

    /**
     * Update the specified profile user in storage.
     */
    public function update(Request $request)
    {
        $validData = $request->validate([
            'name' => ['nullable'],
            'about' => ['nullable'],
            'address' => ['nullable'],
            'gender' => ['nullable', Rule::enum(ProfileGender::class)],
            'phone' => ['nullable']
        ]);

        $userId = Auth::id();

        $profile = Profile::updateOrCreate(['user_id' => $userId], $validData);
        Profile::activity('updated');

        return redirect()->route('profile')->with('success', 'Your profile has been successfully updated.')->with('activeTab', 'profile-edit');
    }

    /**
     * Change password the specified user in storage.
     */
    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('activeTab', 'profile-change-password');
        }

        $user = Auth::user();
        $validData = $validator->validated();

        if(!Hash::check($validData['old_password'], $user->password)) {
            return redirect()->back()->with('failed', 'The current password you entered is incorrect.')->with('activeTab', 'profile-change-password');
        }

        $user->password = $validData['new_password'];
        $user->save();

        Profile::activity('changed password');
        
        return redirect()->back()->with('success', 'Your password has been successfully changed.')->with('activeTab', 'profile-change-password');
    }
}
