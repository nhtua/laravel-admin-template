<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
  public static function getLabels()
  {
    return [
      'name' => 'Tên',
      'display_name' => 'Tên hiển thị',
      'description' => 'Mô tả',
    ];
  }
}
