<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolecustomer        = Role::find('9c5a0257-95a2-453e-9ced-d562870e93ba');
        $permissionscustomer = [
            'checkout hotels',
            'view hotel bookings',
          ];

          $rolecustomer->syncPermissions($permissionscustomer);

            //assign permission to role
          $role        = Role::find('9c5a0257-8e78-4a12-bfae-af78c9b9e842');
          $permissions = Permission::all();

          $role->syncPermissions($permissions);

          //assign role with permission to user
          $user = User::find('9c5a0257-8a3c-4907-abd0-12d87436170f');
          $user->assignRole($role->name);


    }
}
