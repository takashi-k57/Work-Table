<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminHoliday;
use Carbon\Carbon;

class AdminHolidayController extends Controller
{
    //
    public function index(Request $request){
       $now = Carbon::now();
        if (empty($request->year)) {
            $current_month = Carbon::createFromDate($now->year, $now->month, 1, 'Asia/Tokyo');
        } else{
            $current_month = Carbon::createFromDate($request->year, $now->month, 1, 'Asia/Tokyo');
        }
        //公休数の取得
        $admin_list = AdminHoliday::where('year', $current_month->year)->get();
        //前年
        $last_year = Carbon::createFromDate($current_month->year-1,  $current_month->month, 1, 'Asia/Tokyo');
        //翌年
        $following_year = Carbon::createFromDate($current_month->year+1, $current_month->month, 1, 'Asia/Tokyo');

        return view('adminholiday/index', ['admin_list' => $admin_list, 'current_month' => $current_month, 'last_year' => $last_year, 'following_year' => $following_year]);
    }

   public function store(Request $request){
        $form = $request->all();
       for($i =0; $i <12; $i++){
           $request = AdminHoliday::updateOrCreate(
               ['year' => $form['year'], 'month' => $i+1],
               ['year' => $form['year'], 'month' => $i+1, 'day' => $form['day'][$i]]
           );      
       }

       return redirect(route('admin.holiday', ['year' => $form['year']]));


   }

}
