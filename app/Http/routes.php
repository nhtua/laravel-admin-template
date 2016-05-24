<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'/dashboard', 'as'=>'backend::', 'middleware' => ['web','auth']], function () {
  Route::get('/', ['as'=>'dashboard', 'uses'=>'Backend\DashboardController@home']);

  Route::controller('user', 'Backend\UserController',[
      'getIndex'    => 'user.home',
      'getAdd'      => 'user.add',
      'postStore'   => 'user.save',
      'getShow'     => 'user.show',
      'getEdit'     => 'user.edit',
      'postUpdate'  => 'user.update',
      'deleteBan'   => 'user.lock',
      'getJail'     => 'user.jail',
      'getUnlock'   => 'user.unlock',
      'getProfile'  => 'user.profile',
      'postProfile' => 'user.updateProfile',
  ]);
  Route::controller('role', 'Backend\RoleController',[
      'getIndex'    => 'role.home',
      'getEdit'     => 'role.edit',
      'postUpdate'  => 'role.update',
  ]);
});
Route::group(['middleware' => 'web'], function () {
  Route::get('/', ['as'=>'home', 'uses'=>'Frontend\HomeController@home']);
  Route::auth();
});
