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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'API\PassportController@logout');

    Route::resource('total_status','RobotTotalStatusController', ['only' => [
        'index', 'show', 'destroy'
    ]]);

    Route::resource('alarm', 'RobotALarmLogsController', ['only' => [
        'index', 'show', 'destroy'
    ]]);

    Route::resource('status', 'RobotStatusController', ['only' => [
        'index', 'show', 'destroy'
    ]]);

    Route::resource('coordinate', 'RobotCoordinateController', ['only' => [
        'index', 'show', 'destroy'
    ]]);

    Route::resource('product', 'ProductController', ['except' => [
        'create', 'store'
    ]]);

    Route::post('user/reset/profile', 'UserController@resetUserProfile');
    Route::post('user/reset/password', 'UserController@resetUserPassword');
    Route::post('user/reset/avatar', 'UserController@resetUserAvatar');
    Route::resource('user', 'UserController', ['only' => [
        'update'
    ]]);
});

Route::get('get-details', 'API\PassportController@getDetails');

