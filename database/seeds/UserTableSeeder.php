<?php

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
        //
        $role_employee = App\Role::where('name', 'user')->first();
        $role_manager  = App\Role::where('name', 'admin')->first();
        $employee = new App\User();
        $employee->name = 'User';
        $employee->email = 'user@example.com';
        $employee->password = bcrypt('secret');
        $employee->save();
        $employee->roles()->attach($role_employee);
        $manager = new App\User();
        $manager->name = 'Admin';
        $manager->email = 'admin@example.com';
        $manager->password = bcrypt('secret');
        $manager->save();
        $manager->roles()->attach($role_manager);

        factory(App\User::class, 20)->create();
    }
}
