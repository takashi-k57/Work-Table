<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;
use App\Calendar;

class CalendarController extends Controller //クラス名間違いエラーあり
{
    public function getHoliday(Request $request){
        //休日データ取得
        $list = Holiday::all();
        return view('calendar.holiday',['list' => $list]);
    }
    public function postHoliday(Request $request){
         //POSTで受信した休日データを登録
         $holiday = new Holiday();
         $holiday->day = $request->description;
         $holiday->save();
         //休日データ取得
         $list = Holiday::all();
         return view('calendar.holiday',['list' => $list]);
    }

    public function index(Request $request){
        $list = Holiday::all();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);

        return view('calendar.index', ['cal_tag' => $tag]);

    }
}
