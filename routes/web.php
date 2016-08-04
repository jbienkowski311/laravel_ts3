<?php

use App\Notifications\TestNotification;
use App\User;
use Carbon\Carbon;


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
        $ts3_server_ip = env('TS3_IP');
        $ts3_server_port = env('TS3_PORT');
        $ts3_query_port = env('TS3_QUERY_PORT');
        $ts3_user = env('TS3_LOGIN');
        $ts3_pass = env('TS3_PASSWORD');
        $ts3 = \TeamSpeak3::factory("serverquery://{$ts3_user}:{$ts3_pass}@{$ts3_server_ip}:{$ts3_query_port}/?server_port={$ts3_server_port}");

        $ts3_info = $ts3->getInfo();
        $diff = Carbon::now()->diff(Carbon::createFromTimestampUTC(time() - $ts3_info['virtualserver_uptime']));
        $uptime = '';
        if ($diff->y > 0) {
            $uptime .= "{$diff->y} years ";
        }
        if ($diff->m > 0) {
            $uptime .= "{$diff->m} months ";
        }
        $uptime .= "{$diff->h} hours {$diff->i} minutes {$diff->s} seconds";

        $data = [
            'server_name' => $ts3_info['virtualserver_name'],
            'online' => $ts3->isOnline(),
            'users_online' => $ts3_info['virtualserver_clientsonline'],
            'users_max' => $ts3_info['virtualserver_maxclients'],
            'uptime' => $uptime
        ];
        return view('welcome', ['data' => $data]);
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