<?php

use App\Http\Controllers\Auth\PermissionsController;
use App\Http\Controllers\Auth\RolesController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('logup', '\App\Http\Controllers\Auth\LogupController@execute');
    Route::post('login', '\App\Http\Controllers\Auth\LoginController@execute');
    Route::post('logout', '\App\Http\Controllers\Auth\LogoutController@execute');
    Route::post('refresh', '\App\Http\Controllers\Auth\RefreshController@execute');
    Route::post('me', '\App\Http\Controllers\Auth\MeController@execute');
    Route::post('reset-password', '\App\Http\Controllers\Auth\ResetPasswordController@generate_token');
    Route::post('change-password', '\App\Http\Controllers\Auth\ResetPasswordController@change_password')->name('password.reset');

    Route::controller(RolesController::class)
         ->prefix('roles')
         ->group(function() {
            Route::get('/', 'index');
         });

    Route::controller(PermissionsController::class)
         ->prefix('permissions')
         ->group(function() {
            Route::get('/', 'index');
         });

});
