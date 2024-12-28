<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'sometimes'
        ]);

        $user = User::create([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => $validData['password'],
        ]);

        $user->assignRole($validData['role']);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'sometimes',
            'role' => 'sometimes'
        ]);

        $updatedData = [
            'name' => $validData['name'],
            'email' => $validData['email'],
        ];
        
        if($validData['password'] != null) {
          $updatedData['password'] = $validData['password'];  
        }
        
        $user->update($updatedData);
        $user->syncRoles($validData['role']);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();
     
        return redirect()->route('users.index');
    }
}
