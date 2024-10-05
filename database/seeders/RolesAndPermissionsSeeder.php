<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create an admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'create prospects']);
        Permission::create(['name' => 'create appointments']);

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'view prospects']);
        Permission::create(['name' => 'view appointments']);

        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'edit customers']);
        Permission::create(['name' => 'edit prospects']);
        Permission::create(['name' => 'edit appointments']);

        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'delete customers']);
        Permission::create(['name' => 'delete prospects']);
        Permission::create(['name' => 'delete appointments']);

        Permission::create(['name' => 'generate reports']);

        // Roles
        $role = Role::create(['name' => 'admin']);

        // Assign permissions
        $role->givePermissionTo(Permission::all());

        // Assign role to admin
        $admin->assignRole($role);
    }
}
