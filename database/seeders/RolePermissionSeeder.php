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
        Permission::updateOrCreate(['name' => 'view-dashboard-mdd']);

        Permission::updateOrCreate(['name' => 'view-dashboard-superadmin']);

        Permission::updateOrCreate(['name' => 'view-dashboard-admin']);

        Permission::updateOrCreate(['name' => 'view-dashboard-officer']);

        Permission::updateOrCreate(['name' => 'view-dashboard-user']);

        Role::updateOrCreate(['name' => 'mdd']);
        Role::updateOrCreate(['name' => 'superadmin']);
        Role::updateOrCreate(['name' => 'admin']);
        Role::updateOrCreate(['name' => 'officer']);
        Role::updateOrCreate(['name' => 'user']);

        $roleMdd = Role::findByName('mdd');
        $roleMdd->givePermissionTo('view-dashboard-mdd');

        $roleSuperadmin = Role::findByName('superadmin');
        $roleSuperadmin->givePermissionTo('view-dashboard-superadmin');

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('view-dashboard-admin');

        $roleOfficer = Role::findByName('officer');
        $roleOfficer->givePermissionTo('view-dashboard-officer');

        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo('view-dashboard-user');
    }
}
