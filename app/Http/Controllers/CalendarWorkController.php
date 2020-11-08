<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Calendar_w;
use Illuminate\Http\Request;

class CalendarWorkController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = Work::all();
        $cal = new Calendar_w($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);

        return view('calendar_w.index', ['cal_tag' => $tag]);
    }
}
