<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/**
 * Guest Routes
 */
Route::get('/', 'HomeController@index');
Route::get('/stats', 'HomeController@stats');
Route::get('/test', 'HomeController@test');

/**
 * Auth Routes
 */
Auth::routes();

/**
 * User routes
 */
Route::get('/dashboard', 'HomeController@dashboard');

/**
 * Admin CP
 */
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function(){
    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::resource('/users', 'Admin\UsersController');
    Route::resource('/roles', 'Admin\RolesController');
    Route::resource('/permissions', 'Admin\PermissionsController');
});