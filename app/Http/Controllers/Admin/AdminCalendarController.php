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
        $day = Carbon::now();
        $today = new Carbon();
        $weekdays = array('日','月','火','水','木','金','土');

        return view('admincalendar.index', ['cal_tag' => $tag, 'users' => $users, 'day' => $day, 'weekdays' => $weekdays, 'today' => $today]);

    }
   
    //public function hoge(){
        //return view('admincalendar.index', ['days' =>Calendar::getDays]);
   // }
}
