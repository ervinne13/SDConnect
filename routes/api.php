<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {

    Route::group(['namespace' => 'Modules\API'], function() {
        Route::get('tasks', 'TaskController@listAll');
    });

    Route::post('login', 'Auth\LoginController@loginJWT');
});

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function() {

    Route::group(['prefix' => 'mobile', 'namespace' => 'Modules\API'], function() {
        Route::get('current-user', 'UserAccountController@currentUser');

        Route::get('tasks', 'TaskController@listAllMobile');
        Route::get('posts', 'PostApiController@listAllMobile');
    });

    Route::post('mobile/task/{taskId}/submit-answers', 'Modules\System\TaskController@submitAnswers');
});
