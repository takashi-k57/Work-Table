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
        $now = Carbon::now();
        $current_month = Carbon::createFromDate($now->year, $now->month, 1, 'Asia/Tokyo');
        $current_month_weekday = $current_month->dayOfWeek;
        $weekdays = ['日','月','火','水','木','金','土'];
        $selects = User::with('holidays:user_id,description')->get();
        return view('admincalendar.index', ['cal_tag' => $tag, 'users' => $users, 'day' => $now, 'weekdays' => $weekdays, 'current_month' => $current_month, 'current_month_weekday' => $current_month_weekday]);

    }
   
    //public function hoge(){
        //return view('admincalendar.index', ['days' =>Calendar::getDays]);
   // }
}
