<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $director = Role::create(['name' => 'director']);
        $building_manager = Role::create(['name' => 'building_manager']);
        $floor_manager = Role::create(['name' => 'floor_manager']);
        $student = Role::create(['name' => 'student']);

        $permissions = ['view dashboard', 'assign tasks', 'manage users'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // $director->givePermissionTo(Permission::all());
        // $building_manager->givePermissionTo(['manage rooms', 'assign tasks']);
        // $floor_manager->givePermissionTo(['assign tasks']);
        // $student->givePermissionTo(['view reports']);

    }
}
