<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        Permission::create(['name' => 'view requests']);
        Permission::create(['name' => 'create requests']);
        Permission::create(['name' => 'approve requests']);
        Permission::create(['name' => 'reject requests']);

        // Roles
        $admin = Role::create(['name' => 'admin']);
        $staff = Role::create(['name' => 'staff']);

        // Assign permissions to roles
        $admin->givePermissionTo(['view requests', 'approve requests', 'reject requests']);
        $staff->givePermissionTo(['view requests', 'create requests']);
    }
}
