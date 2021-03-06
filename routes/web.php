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

Route::resource('teachers', 'Modules\System\TeachersController');

Route::get('home', 'HomeController@index')->name('home');

Route::get('test', 'TestController@test');
Route::get('test/chart', 'TestController@chart');

Route::group(['namespace' => 'Modules\System', 'middleware' => ['auth']], function () {
    Route::get('user/datatable', 'UsersController@datatable');
    Route::post('user/update-profile', 'UserController@update');
    Route::resource('user', 'UserController');

    Route::get('user/{username}/group', 'UserGroupController@index');
    Route::post('user/{username}/give-badge', 'UserController@giveBadge');

    Route::post('group/{groupCode}/join', 'GroupController@joinGroup');
    Route::resource('group', 'GroupController');

    Route::get('post/group/{groupCode}', 'PostController@listPostByGroup');
    Route::get('post/group/{groupCode}/seed', 'PostController@seedPosts');
    Route::resource('post', 'PostController');

    Route::get('calendar/posts', 'CalendarController@getPostsByDateRange');

    Route::get('task/json', 'TaskController@listAllJson');
    Route::get('/task/{taskId}/group/{groupCode}/student/{studentNumber}/responses', 'TaskController@studentResponses');
    Route::get('task/{taskId}/group/{groupCode}/results', 'TaskController@taskGroupResults');
    Route::post('task/{taskId}/submit-answers', 'TaskController@submitAnswers');
    Route::get('task/{taskId}/group/{groupCode}/report', 'TaskController@generateTaskReport');
    Route::resource('task', 'TaskController');

    Route::resource('material', 'MaterialController');
    
    Route::resource('profiles', 'ProfileController');
});
