<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holiday;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = new \DateTime(); 
        $first_day = new \DateTime($now->format('y-m-01')); 
        $last_day = new \DateTime($now->format('y-m-t')); 
        $day = new \DateTime($now->format('y-m-t')); 
        $day->sub(new \DateInterval('P1M')); 

        return view('admin.home', [
             'users' => User::all(),
             'holidays' => new Holiday,
             'day' => $day,
             'first_day' => $first_day,
             'last_day' => $last_day,
             ]);
    }
}
