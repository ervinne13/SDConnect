<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get("/logout", "Auth\LoginController@logout");
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('test', 'TestController@test');
Route::get('test/chart', 'TestController@chart');

Route::group(['namespace' => 'Modules\System', 'middleware' => ['auth']], function () {
    Route::get('user/datatable', 'UsersController@datatable');    
    Route::resource('user', 'UserController');

    Route::get('user/{username}/group', 'UserGroupController@index');
    
    Route::post('group/{groupCode}/join', 'GroupController@joinGroup');
    Route::resource('group', 'GroupController');

    Route::get('post/group/{groupCode}', 'PostController@listPostByGroup');
    Route::get('post/group/{groupCode}/seed', 'PostController@seedPosts');
    Route::resource('post', 'PostController');

    Route::get('calendar/posts', 'CalendarController@getPostsByDateRange');

    Route::get('task/json', 'TaskController@listAllJson');
    Route::resource('task', 'TaskController');

    Route::resource('material', 'MaterialController');
});
