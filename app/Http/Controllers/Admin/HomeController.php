<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holiday;
use App\User;
use App\dayIterator;

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
        $dayIterator = new dayIterator();

        $now = new \DateTime(); 
        $first_day = new \DateTime($now->format('y-m-01')); 
        $last_day = new \DateTime($now->format('y-m-t')); 

        return view('admin.home', [
                'users' => User::all(),
                'holidays' => new Holiday,
                'dayIterator' => $dayIterator
             ]);
    }
}
