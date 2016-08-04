<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create admin account.
         */
        $admin = new User;
        $admin->name = 'Jakub Bieńkowski';
        $admin->email = 'jbienkowski311@gmail.com';
        $admin->password = bcrypt('password');
        $admin->save();
        /**
         * Attach Role to Admin.
         */
        $admin->attachRole(Role::where('name', 'admin')->first());

        /**
         * Create test user account.
         */
        $user = new User;
        $user->name = 'Test Test';
        $user->email = 'test@test.com';
        $user->password = bcrypt('password');
        $user->save();
        /**
         * Attach Role to User.
         */
        $user->attachRole(Role::where('name', 'user')->first());

        /**
         * Create test VIP account.
         */
        $user = new User;
        $user->name = 'VIP Test';
        $user->email = 'vip@test.com';
        $user->password = bcrypt('password');
        $user->save();
        /**
         * Attach Role to User.
         */
        $user->attachRole(Role::where('name', 'vip')->first());
    }
}
