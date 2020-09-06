<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Calendar;
use App\Holiday;
use App\User;
use Carbon\Carbon;

class AdminCalendarController extends Controller
{
    //
    public function index(Request $request){
        $list = Holiday::where('user_id', auth()->user()->id)->get();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);
        $users = User::all();
        $days = Carbon::now();

        return view('admincalendar.index', ['cal_tag' => $tag, 'users' => $users, 'days' => $days]);

    }
   
    //public function hoge(){
        //return view('admincalendar.index', ['days' =>Calendar::getDays]);
   // }
}
