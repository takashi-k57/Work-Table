<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminHoliday;

class AdminHolidayController extends Controller
{
    //
    public function index(){
        //公休数の取得
        $holiday_data = new AdminHoliday();
        return view('adminholiday/index', ['holiday_data' => $holiday_data]);
    }

   public function store(Request $request){
       //公休数のデータを登録
       $admin_holiday = new AdminHoliday();
       $admin_holiday->day = $request->day;
       $admin_holiday->save();

       return redirect('admin/holiday');


   }

}
