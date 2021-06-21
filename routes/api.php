<?php

use Illuminate\Http\Request;
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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('v1')->group(function(){
    Route::get('/unauthorized', 'Api\Auth\AuthController@unauthorized');
    Route::post('register', 'Api\Auth\AuthController@register');
    Route::post('login', 'Api\Auth\AuthController@login');

    Route::group(['middleware' => 'auth_passport:api'], function(){

        Route::get('getUser', 'Api\Auth\AuthController@getUser');
        Route::post('logout', 'Api\Auth\AuthController@logout');
        //apis
        Route::apiResource('users','Api\Auth\UserController');
        Route::apiResource('roles','Api\Auth\RoleController');
        Route::apiResource('permissions','Api\Auth\PermissionController');
        //others
        //listas
    });
});
