<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);

        $staff = User::create([
            'username' => 'Staff',
            'email' => 'staff@example.com',
            'password' => 'staff123',
        ]);
        
        $admin->assignRole('admin');
        $staff->assignRole('staff');
    }
}
