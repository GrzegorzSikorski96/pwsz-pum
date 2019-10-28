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
        Route::get('/fetch/device/{deviceId}', 'MeasurementController@fetchDeviceMeasurement');
        Route::get('/fetch/all', 'MeasurementController@fetchAllDevicesMeasurements');

        Route::post('/device', 'DeviceController@create');
        Route::put('/device/{deviceId}', 'DeviceController@edit');
        Route::get('/device/{deviceId}', 'DeviceController@device');
        Route::get('/devices', 'DeviceController@devices');
        Route::delete('/device/{deviceId}', 'DeviceController@remove');



        Route::get('/users', 'UserController@users');
        Route::get('/user', 'UserController@users');
        Route::post('/user', 'UserController@create');
        Route::put('/user/{userId}', 'UserController@edit');
        Route::post('/changePassword', 'UserController@changePassword');
        Route::delete('/user/{userId}', 'UserController@remove');
    });
