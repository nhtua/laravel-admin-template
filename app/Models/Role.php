<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use App\Models\Permission;

class Role extends EntrustRole
{
  public static function getLabels()
  {
    return [
      'name' => 'Name',
      'display_name' => 'Display Name',
      'description' => 'Describe',
      'permission' => 'Permission',
    ];
  }
  public function getPermsOptions()
  {
    $permissions = Permission::orderBy('id','ASC')->get();
    $html = "";
    foreach ($permissions as $key => $permission) {
        $tmp = '<div class="radio"><label><input type="checkbox" #checked# value="#value#" class="flat" name="permissions[#order#]"> #display_name#</label></div>';
        $tmp = str_replace('#checked#', $this->hasPermission($permission->name)?'checked':'', $tmp);
        $tmp = str_replace('#value#', $permission->id, $tmp);
        $tmp = str_replace('#order#', $key, $tmp);
        $tmp = str_replace('#display_name#', $permission->display_name, $tmp);
        $html .= $tmp;
    }
    return $html;
  }
}
