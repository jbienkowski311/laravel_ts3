<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Sample Roles.
         */
        $roles = [
            'admin' => [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Administrator'
            ],
            'user' => [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'Normal User'
            ],
            'vip' => [
                'name' => 'vip',
                'display_name' => 'VIP',
                'description' => 'VIP User'
            ]
        ];

        /**
         * Sample Permissions.
         */
        $permissions = [
            'create-channel' => [
                'name' => 'create-channel',
                'display_name' => 'Create Channel',
                'description' => 'Permission Create Channel allows to create new TS3 channel.'
            ],
            'edit-channel' => [
                'name' => 'edit-channel',
                'display_name' => 'Edit Channel',
                'description' => 'Permission Edit Channel allows to edit own TS3 channel.'
            ],
            'delete-channel' => [
                'name' => 'delete-channel',
                'display_name' => 'Delete Channel',
                'description' => 'Permission Delete Channel allows to delete own TS3 channel.'
            ]
        ];

        /**
         * Create Permissions.
         */
        foreach ($permissions as $p) {
            $permission = new Permission;
            $permission->name = $p['name'];
            $permission->display_name = $p['display_name'];
            $permission->description = $p['description'];
            $permission->save();
        }

        $permissions = Permission::all();

        /**
         * Create Roles.
         */
        foreach ($roles as $r) {
            $role = new Role;
            $role->name = $r['name'];
            $role->display_name = $r['display_name'];
            $role->description = $r['description'];
            $role->save();

            /**
             * Attach Permissions to Roles.
             */
            $role->attachPermissions($permissions);
        }
    }
}
