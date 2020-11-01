<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;
use App\Calendar;
use App\Models\AdminHoliday;

class CalendarController extends Controller //クラス名間違いエラーあり
{
    
    public function index(Request $request){
        $list = Holiday::where('user_id', auth()->user()->id)->get();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);

        //$admin_list = AdminHoliday::where('year', $tag->year)
                    //->where('month', $tag->month)
                    //->first();

        return view('calendar.index', ['cal_tag' => $tag]);

    }

   
}
