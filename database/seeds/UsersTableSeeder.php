<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //setup Role
    $admin = new Role();
    $admin->name         = 'admin';
    $admin->display_name = 'Administrator';
    $admin->description  = 'Administrator';
    $admin->save();

    //setup User
    $demo1 = new User();
    $demo1->name = 'John Doe';
    $demo1->email = 'admin@demo.com';
    $demo1->password = Hash::make('123456a@');
    $demo1->save();
    $demo1->attachRole($admin);
  
    //setup permission
    /**
     * List of all Admin permission
     * @var Permission
     */
    $createUser = new Permission();
    $createUser->name         = 'create-user';
    $createUser->display_name = 'Add user';
    $createUser->description  = 'Add user';
    $createUser->save();

    $editUser = new Permission();
    $editUser->name         = 'edit-user';
    $editUser->display_name = "Change user's information";
    $editUser->description  = "Change user's information, include the password";
    $editUser->save();

    $lockUser = new Permission();
    $lockUser->name         = 'lock-user';
    $lockUser->display_name = 'Lock user';
    $lockUser->description  = "lock/ban/inactive user";
    $lockUser->save();

    $unlockUser = new Permission();
    $unlockUser->name         = 'unlock-user';
    $unlockUser->display_name = 'Unlock';
    $unlockUser->description  = 'unlock/unban/active user';
    $unlockUser->save();

    /**
     * Các quyền của Admin
     * @var Permission
     */

    $editRole = new Permission();
    $editRole->name         = 'edit-role';
    $editRole->display_name = 'Edit role';
    $editRole->description  = "Change role info, grant permissions to role";
    $editRole->save();

    $admin->attachPermissions([$editUser, $createUser, $lockUser, $unlockUser, $editRole]);
  }
}
