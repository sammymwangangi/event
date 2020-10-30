<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Role;
use Spatie\Permission\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        
        // EVENTS
        Permission::create(['name' => 'edit events']);
        Permission::create(['name' => 'delete events']);
        Permission::create(['name' => 'create events']);
        // VENUES
        Permission::create(['name' => 'edit venues']);
        Permission::create(['name' => 'delete venues']);
        Permission::create(['name' => 'create venues']);
        // SERVICES
        Permission::create(['name' => 'edit services']);
        Permission::create(['name' => 'delete services']);
        Permission::create(['name' => 'create services']);
        // LOGGEDIN USER
        Permission::create(['name' => 'book all']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('book all');

        // or may be done by chaining
        $role = Role::create(['name' => 'event_owner'])
            ->givePermissionTo(['edit events', 'delete events', 'create events']);

        $role = Role::create(['name' => 'venue_owner'])
            ->givePermissionTo(['edit venues', 'delete venues', 'create venues']);

        $role = Role::create(['name' => 'service_owner'])
            ->givePermissionTo(['edit services', 'delete services', 'create services']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
