<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;
use App\Calendar;

class CalendarController extends Controller //クラス名間違いエラーあり
{
    
    public function index(Request $request){
        $list = Holiday::where('user_id', auth()->user()->id)->get();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);

        return view('calendar.index', ['cal_tag' => $tag]);

    }

   
}
