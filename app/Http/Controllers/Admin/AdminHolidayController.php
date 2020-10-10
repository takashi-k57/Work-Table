<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminHoliday;

class AdminHolidayController extends Controller
{
    //
    public function index(){
        return view('adminholiday/index');
    }

}
