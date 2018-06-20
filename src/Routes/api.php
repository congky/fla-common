<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'App\Common\AuthController@login');
Route::post('logout', 'App\Common\AuthController@logout');

Route::group(['middleware' => ['verifyReq']], function () {

    // ROLE
    Route::post('add-role', 'App\Admin\RoleController@add');
    Route::post('edit-role', 'App\Admin\RoleController@edit');
    Route::post('remove-role', 'App\Admin\RoleController@remove');
    Route::get('get-role-list-advance', 'App\Admin\RoleController@getRoleListAdvance');
    Route::get('count-role-list-advance', 'App\Admin\RoleController@countRoleListAdvance');

    // ROLE & TASK
    Route::post('mapping-role-task', 'App\Admin\RoleTaskController@mappingRoleTask');
    Route::post('unmapping-role-task', 'App\Admin\RoleTaskController@unmappingRoleTask');
    Route::get('get-task-list-advance', 'App\Admin\RoleTaskController@getTaskListAdvance');
    Route::get('count-task-list-advance', 'App\Admin\RoleTaskController@countTaskListAdvance');
    Route::get('get-role-task-list-advance', 'App\Admin\RoleTaskController@getRoleTaskListAdvance');
    Route::get('count-role-task-list-advance', 'App\Admin\RoleTaskController@countRoleTaskListAdvance');

    // USER
    Route::post('add-user', 'App\Admin\UserController@add');
    Route::post('edit-user', 'App\Admin\UserController@edit');
    Route::post('remove-user', 'App\Admin\UserController@remove');
    Route::get('get-user-list-advance', 'App\Admin\UserController@getUserListAdvance');
    Route::get('count-user-list-advance', 'App\Admin\UserController@countUserListAdvance');
    Route::get('get-user-logged-info', 'App\Admin\UserController@getUserLoggedInfo');

});
