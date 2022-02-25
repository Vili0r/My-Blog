<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);
        Permission::create(['name' => 'user management']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('create articles');
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'publisher']);
        $role2->givePermissionTo('publish articles');

        $role3 = Role::create(['name' => 'admin']);
        $role3->givePermissionTo('publish articles');
        $role3->givePermissionTo('unpublish articles');

        $role4 = Role::create(['name' => 'Super Admin']);
        $role4->givePermissionTo('create articles');
        $role4->givePermissionTo('edit articles');
        $role4->givePermissionTo('delete articles');
        $role4->givePermissionTo('publish articles');
        $role4->givePermissionTo('unpublish articles');
        $role4->givePermissionTo('user management');

        Role::create(['name' => 'user']);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Writer',
            'email' => 'writer@mail.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Publisher',
            'email' => 'publisher@mail.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
        ]);
        $user->assignRole($role4);
    }
}
