<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    const permissions = [
        'View all projects',
        'Update all projects',
        'Delete all projects',
        'Create projects',
        'View own projects',
        'Update own projects',
        'Delete own projects',
        'View all tickets',
        'Update all tickets',
        'Delete all tickets',
        'Create tickets',
        'View own tickets',
        'Update own tickets',
        'Delete own tickets',
        'Assign tickets',
        'Change status tickets',
        'Can view Analytics page',
        'Can view Tickets page',
        'Can view Kanban page',
        'View all users',
        'Create users',
        'Update users',
        'Delete users',
        'Assign permissions',
        'Manage ticket statuses',
        'Manage ticket priorities',
        'Manage ticket types',
        'View activity log',
        'Manage user roles',
        'Create user roles',
        'Update user roles',
        'Delete user roles',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::permissions as $permission) {
            if (!Permission::where('name', $permission)->count()) {
                Permission::create(['name' => $permission]);
            }
        }

        Role::create(["name" => "administrator"])
        ->givePermissionTo([
            'View all projects',
            'Update all projects',
            'Delete all projects',
            'Create projects',
            'View own projects',
            'Update own projects',
            'Delete own projects',
            'View all tickets',
            'Update all tickets',
            'Delete all tickets',
            'Create tickets',
            'View own tickets',
            'Update own tickets',
            'Delete own tickets',
            'Assign tickets',
            'Change status tickets',
            'Can view Analytics page',
            'Can view Tickets page',
            'Can view Kanban page',
            'View all users',
            'Create users',
            'Update users',
            'Delete users',
            'Assign permissions',
            'Manage ticket statuses',
            'Manage ticket priorities',
            'Manage ticket types',
            'View activity log',
            'Manage user roles',
            'Create user roles',
            'Update user roles',
            'Delete user roles'
        ]);

        Role::create(["name" => "staff"])
        ->givePermissionTo([
            'View all projects',
            'View all tickets',
            'Update all tickets',
            'Create tickets',
            'View own tickets',
            'Update own tickets',
            'Delete own tickets',
            'Can view Tickets page'
        ]);

        Role::create(["name" => "technician"])
        ->givePermissionTo([
        ]);

        User::find(1)->assignRole('administrator');
        User::find(2)->assignRole('staff');
        User::find(3)->assignRole('technician');
    }
}
