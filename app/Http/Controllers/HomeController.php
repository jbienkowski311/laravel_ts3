<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    private $ts3;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'stats']]);
        $this->ts3 = $this->connectTs3Query();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){

        $ts3_info = $this->ts3->getInfo();
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
            'online' => $this->ts3->isOnline(),
            'users_online' => $ts3_info['virtualserver_clientsonline'] - $ts3_info['virtualserver_queryclientsonline'],
            'users_max' => $ts3_info['virtualserver_maxclients'],
            'uptime' => $uptime
        ];

        return view('welcome', ['data' => $data]);
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function stats()
    {
        return view('dashboard');
    }

    public function test()
    {
        return dd($this->ts3->getInfo());
    }
}
