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
        // Permissions Requests
        Permission::create(['name' => 'view request']);
        Permission::create(['name' => 'create request']);
        Permission::create(['name' => 'edit request']);
        Permission::create(['name' => 'delete request']);
        Permission::create(['name' => 'approve request']);
        Permission::create(['name' => 'reject request']);
        
        // Permissions Suppliers
        Permission::create(['name' => 'view supplier']);
        Permission::create(['name' => 'create supplier']);
        Permission::create(['name' => 'edit supplier']);
        Permission::create(['name' => 'delete supplier']);

        // Permissions Products
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        // Roles
        $admin = Role::create(['name' => 'admin']);
        $staff = Role::create(['name' => 'staff']);

        // Assign permissions to roles
        $admin->givePermissionTo(['view request', 'approve request', 'reject request', 'view supplier', 'create supplier', 'edit supplier', 'delete supplier', 'view product', 'create product', 'edit product', 'delete product']);
        $staff->givePermissionTo(['view request', 'create request', 'edit request', 'delete request', 'view supplier', 'view product']);
    }
}
