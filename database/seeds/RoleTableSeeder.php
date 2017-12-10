<?php

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
        $role_employee = new App\Role();
        $role_employee->name = "user";
        $role_employee->description = "Normal User";
        $role_employee->save();
        $role_manager = new App\Role();
        $role_manager->name = "admin";
        $role_manager->description = "Site Admin";
        $role_manager->save();
  }
}
