<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(["name" => "views_full"]);

        $role = Role::create(["name" => "administrator"]);
        $role->givePermissionTo("views_full");
        $role = Role::create(["name" => "staff"]);

        $admin = User::create([
            "name" => "Administrator",
            "email" => "admin@ebaymanager.com",
            "password" => bcrypt("123456")
        ]);
        $admin->assignRole("administrator");
    }
}
