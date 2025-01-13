<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the user.
     */
    public function index()
    {
        $authId = Auth::id();
        $users = User::with('roles')->where('id', '!=', $authId)->get();

        $data = [
            'title' => 'User | E-Procurement',
            'users' => $users,
        ];

        return view('dashboard.user.index', $data);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        $data = [
            'title' => 'User | E-Procurement',
            'roles' => $roles
        ];

        return view('dashboard.user.create', $data);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'username' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required']
        ]);

        $user = User::create([
            'username' => $validData['username'],
            'email' => $validData['email'],
            'password' => $validData['password'],
        ]);

        $user->assignRole($validData['role']);
        User::activity("created");

        return redirect()->route('users.index')->with('success', 'User has been successfully added.');
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'title' => 'User | E-Procurement',
            'user' => $user
        ];

        return view('dashboard.user.detail', $data);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id)
    {
        $roles = Role::all();
        $user = User::with('roles')->findOrFail($id);

        $data = [
            'title' => 'User | E-Procurement',
            'user' => $user,
            'roles' => $roles
        ];

        return view('dashboard.user.edit', $data);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validData = $request->validate([
            'username' => ['required'],
            'email' => ['required|email'],
            'password' => ['sometimes'],
            'role' => ['required']
        ]);

        $updatedData = [
            'username' => $validData['username'],
            'email' => $validData['email'],
        ];
        
        if($validData['password'] != null) {
          $updatedData['password'] = $validData['password'];  
        }
        
        $user->update($updatedData);
        $user->syncRoles($validData['role']);
        User::activity("updated");

        return redirect()->route('users.index')->with('success', 'User details have been successfully updated.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();
        User::activity("Deleted");
     
        return redirect()->route('users.index')->with('success', 'User has been successfully deleted.');
    }
}
