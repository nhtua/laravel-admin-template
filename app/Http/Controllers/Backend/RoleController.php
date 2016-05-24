<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{

  public function __construct()
  {
    $this->middleware('permission:edit-role');
  }

  public function getIndex()
  {
    $roles = Role::all();
    return view('backend.role.index', compact('roles'));
  }

  public function getEdit($id)
  {
    $role = Role::whereId($id)->firstOrFail();
    return view('backend.role.edit', compact('role'));
  }
  
  /**
   * Update the specified role
   *
   * @param  Request  $request
   * @return Response
   */
  public function postUpdate(Request $request)
  {        
      $role = Role::whereId($request->get('id'))->firstOrFail();
      $role->description = $request->description;         

      // Lưu phân quyền
      $role->perms()->sync($request->get('permissions'));

      $role->save();
      return redirect(route('backend::role.edit',[$role->id]) )->with('status', 'Cập nhật thành công!');
  }
}
