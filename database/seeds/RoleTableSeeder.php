<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'Student';
        $role_user->description = 'A normal Student';
        $role_user->save();

        $role_ma = new Role();
        $role_ma->name = 'MA';
        $role_ma->description = 'A Management Assistant';
        $role_ma->save();

        $role_lecturer = new Role();
        $role_lecturer->name = 'Lecturer';
        $role_lecturer->description = 'A Lecturer';
        $role_lecturer->save();

        $role_hod = new Role();
        $role_hod->name = 'Head';
        $role_hod->description = 'A Head of Department';
        $role_hod->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'A Admin';
        $role_admin->save();
    }
}
