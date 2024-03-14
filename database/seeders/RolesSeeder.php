<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['guard_name' => 'api','name' => 'edit']);
        Permission::create(['guard_name' => 'api','name' => 'publish']);
        Permission::create(['guard_name' => 'api','name' => 'delete']);
        Permission::create(['guard_name' => 'api','name' => 'create']);

        $default = Role::create(['guard_name' => 'api','name' => 'normal']);

        $admin = Role::create(['guard_name' => 'api','name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $owner = Role::create(['guard_name' => 'api','name' => 'owner']);
        $owner->givePermissionTo(Permission::all());

        $manager = Role::create(['guard_name' => 'api','name' => 'manager']);
        $manager->givePermissionTo(['edit','publish']);

        $cashier = Role::create(['guard_name' => 'api','name' => 'cashier']);  
        $cashier->givePermissionTo(['edit']);    
    }
}
