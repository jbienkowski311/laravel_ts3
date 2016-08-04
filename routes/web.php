<?php

use App\Notifications\TestNotification;
use App\User;


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

Route::get('/', function(){
    if (Auth::guest()) {
        return view('welcome');
    } else {
        return redirect('/home');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function(){
    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::resource('/users', 'Admin\UsersController');
    Route::resource('/roles', 'Admin\RolesController');
    Route::resource('/permissions', 'Admin\PermissionsController');
});