<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Calendar;
use App\Calendar_w;
use App\Models\AdminHoliday;

class CalendarController extends Controller //クラス名間違いエラーあり
{
    
    public function index(Request $request){

        if(Auth::check()){
            if(Auth::user()->worksystem == '常勤'){
                $list = Holiday::where('user_id', auth()->user()->id)->get();
                $cal = new Calendar($list);
                $tag = $cal->showCalendarTag($request->month,$request->year);
                return view('calendar.index', ['cal_tag' => $tag]);
            }elseif(Auth::user()->worksystem == '非常勤'){
                $list = Work::where('user_id', auth()->user()->id)->get();
                $cal = new Calendar($list);
                $tag = $cal->showCalendarTag($request->month,$request->year);
                return view('calendar_w.index', ['cal_tag' => $tag]);
            }
        }

        //$admin_list = AdminHoliday::where('year', $tag->year)
                    //->where('month', $tag->month)
                    //->first();

 

    }

   
}
