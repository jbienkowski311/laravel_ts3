<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Transformers\Ts3DefaultTransformer;

class HomeController extends Controller
{
    /** @var \TeamSpeak3_Node_Server  */
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
        return view('welcome', [
            'ts3Info' => fractal()
                        ->item($this->ts3)
                        ->transformWith(new Ts3DefaultTransformer)
                        ->toArray()
        ]);
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
