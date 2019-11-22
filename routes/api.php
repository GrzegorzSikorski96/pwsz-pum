<?php

use Illuminate\Support\Facades\Route;

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

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'auth'
    ],
    function ($router): void {
        Route::post('/register', 'Auth\RegisterController@register');
        Route::post('/login', 'AuthController@login');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/refresh', 'AuthController@refresh');
        Route::post('/me', 'AuthController@me');
    });

Route::group(
    [
        'middleware' => 'api',
    ],
    function ($router): void {
        Route::post('/fetch/{deviceId}', 'MeasurementController@fetchDeviceMeasurement')->where(['deviceId' => '[0-9]+']);
        Route::post('/fetch/all', 'MeasurementController@fetchAllDevicesMeasurements');
        Route::post('/fetch/device/{deviceId}/{token}', 'DeviceController@fetchDevice');

        Route::post('/measurements/{deviceId}', 'MeasurementController@get');


        Route::get('/device/{deviceId}', 'DeviceController@device');
        Route::get('/devices', 'DeviceController@devices');

        Route::get('/last', 'MeasurementController@getLastMeasurements');

        Route::post('/user/{userId}/password', 'UserController@changePassword');
        Route::post('/user/{userId}/email', 'UserController@changeEmail');

        Route::get('/users', 'UserController@users');
        Route::get('/user/{userId}', 'UserController@user');

        Route::put('/user/{userId}', 'UserController@edit');
    });

Route::group(
    [
        'middleware' => 'role.administrator',
    ],
    function (): void {
        Route::post('/device', 'DeviceController@create');
        Route::delete('/device/{deviceId}', 'DeviceController@remove');

        Route::post('/user', 'UserController@create');
        Route::delete('/user/{userId}', 'UserController@remove');

        Route::get('/roles', 'RoleController@roles');
        Route::post('/user/{userId}/role/{roleId}', 'RoleController@changeRole');
    }
);
