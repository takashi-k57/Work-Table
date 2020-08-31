<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;
use App\Calendar;
use DateInterval;

class CalendarController extends Controller //クラス名間違いエラーあり
{
    
    public function index(Request $request){
        $list = Holiday::where('user_id', auth()->user()->id)->get();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);

        $now = new \dateTime(); 
        $last_day = new \dateTime($now->format('y-m-t')); 
        $day = new \dateTime($now->format('y-m-t')); 
        $day->sub(new DateInterval('P1M')); 

        return view('calendar.index', ['cal_tag' => $tag, 'holidays' => Holiday::all(),
        'last_day' => $last_day, 'day' => $day
         ]);

    }
   
}
