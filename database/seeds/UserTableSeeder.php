<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
        $admin = new User();
        $admin->firstname = 'Supper';
        $admin->lastname = 'Admin';
        $admin->username = 'admin';
        $admin->email = 'admin@achchuthan.org';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

    }
}
