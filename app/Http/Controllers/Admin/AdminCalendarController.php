<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Calendar;
use App\Holiday;
use App\User;
use App\Models\AdminHoliday;
use Carbon\Carbon;
use Yasumi\Yasumi;

class AdminCalendarController extends Controller
{
    //
    public function index(Request $request){
        $users = User::all();
        $now = Carbon::now();

        //変更前
        //$isHolidays = Yasumi::create('Japan', $request->year, 'ja_JP')->getHolidayDates();
        //変更後
        if(empty($request->year)){
            $isHolidays = Yasumi::create('Japan', $now->year, 'ja_JP')->getHolidayDates();
        } else{
            $isHolidays = Yasumi::create('Japan', $request->year, 'ja_JP')->getHolidayDates();
        }
        
        
        // 変更前
        // $current_month = Carbon::createFromDate($now->year, $now->month, 1, 'Asia/Tokyo');

        // 変更後
        if (empty($request->year)) {
            $current_month = Carbon::createFromDate($now->year, $now->month, 1, 'Asia/Tokyo');
        } else{
            $current_month = Carbon::createFromDate($request->year, $request->month, 1, 'Asia/Tokyo');
        }

        
        //前月
        $last_month = Carbon::createFromDate($current_month->year, $current_month->month-1, 1, 'Asia/Tokyo');
        //翌月
        $following_month = Carbon::createFromDate($current_month->year, $current_month->month+1, 1, 'Asia/Tokyo');

        $current_month_weekday = $current_month->dayOfWeek;
        $weekdays = ['日','月','火','水','木','金','土'];

        //公休数表示
        $admin_list = AdminHoliday::where('year', $current_month->year)
                     ->where('month', $current_month->month)
                     ->first();
        

        return view('admincalendar.index', ['users' => $users, 'day' => $now, 'weekdays' => $weekdays, 'current_month' => $current_month, 'current_month_weekday' => $current_month_weekday, 'isHolidays' => $isHolidays, 'last_month' => $last_month, 'following_month' => $following_month, 'admin_list' => $admin_list]);

    }

    public function store(Request $request){
        $form = $request->all();
            
        $holiday = Holiday::where('user_id', $request->user_id)->where('day', $request->day)->get()->first();

        if (is_null($holiday)) {
            $holiday = new Holiday();
        }

        if(isset($form['kokyu'])) {
            $holiday->description = '公';
            unset($form['kokyu']);
        } elseif(isset($form['hanko'])) {
            $holiday->description = '半公';
            unset($form['hanko']);
        } elseif(isset($form['yukyu'])) {
            $holiday->description = '有';
            unset($form['yukyu']);
        } elseif(isset($form['hanyu'])) {
            $holiday->description = '半有';
            unset($form['hanyu']);
        } elseif(isset($form['daikyu'])) {
            $holiday->description = '代';
            unset($form['daikyu']);
        } elseif(isset($form['handai'])) {
            $holiday->description = '半代';
            unset($form['handai']);
        } 

        unset($form['_token']);

        $holiday->fill($form);
        $holiday->save();

       return redirect('/admin');
        
        

    }
   
    public function delete(Request $request){
        $form = $request->all();

        $holiday = Holiday::where('user_id', $request->user_id)->where('day', $request->day)->get()->first();

        if (is_null($holiday)) {
            return redirect('/admin');
        }

        $holiday->delete();

        return redirect('/admin');

    }
}
