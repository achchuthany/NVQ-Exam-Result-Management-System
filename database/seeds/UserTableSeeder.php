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
        $role_student = Role::where('name', 'Student')->first();
        $role_lecturer = Role::where('name', 'Lecturer')->first();
        $role_admin = Role::where('name', 'Admin')->first();

        $user = new User();
        $user->first_name = 'Larshanan';
        $user->last_name = 'Student';
        $user->email = 'Larshanan@example.com';
        $user->password = bcrypt('student');
        $user->save();
        $user->roles()->attach($role_student);

        $admin = new User();
        $admin->first_name = 'Achchuthan';
        $admin->last_name = 'Admin';
        $admin->email = 'admin@achchuthan.org';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $lecturer = new User();
        $lecturer->first_name = 'Romiyal';
        $lecturer->last_name = 'Lecturer';
        $lecturer->email = 'Lecturer@example.com';
        $lecturer->password = bcrypt('lecturer');
        $lecturer->save();
        $lecturer->roles()->attach($role_lecturer);
    }
}
