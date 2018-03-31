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

    //Route::post('alarm/export/pdf', 'PDFController@getAlarmLogsPDF');
    Route::resource('alarm', 'RobotALarmLogsController', ['only' => [
        'index', 'show', 'destroy'
    ]]);

    Route::resource('status', 'RobotStatusController', ['only' => [
        'index', 'show', 'destroy'
    ]]);

    Route::resource('coordinate', 'RobotCoordinateController', ['only' => [
        'index', 'show', 'destroy'
    ]]);

    Route::get('product/customer/setting', 'ProductController@getProductCustomerSetting');
    Route::post('product/customer/setting', 'ProductController@resetProductCustomerSetting');
    Route::post('product/reset/avatar', 'ProductController@resetProductAvatar');
    Route::resource('product', 'ProductController', ['except' => [
        'create', 'store'
    ]]);

    Route::get('throughput/daily', 'throughputController@getDailyThroughput');
    Route::get('throughput/cumulate', 'throughputController@getCumulateThroughput');

    Route::post('user/reset/profile', 'UserController@resetUserProfile');
    Route::post('user/reset/password', 'UserController@resetUserPassword');
    Route::post('user/reset/avatar', 'UserController@resetUserAvatar');
    Route::get('/user/alarm/setting', 'UserController@getUserAlarmSetting');
    Route::post('/user/alarm/setting', 'UserController@resetUserAlarmSetting');
    Route::resource('user', 'UserController', ['only' => [
        'update'
    ]]);
});

Route::post('alarm/export/pdf', 'PDFController@getAlarmLogsPDF');
Route::post('alarm/export/excel', 'ExcelController@getAlarmLogsExcel');


