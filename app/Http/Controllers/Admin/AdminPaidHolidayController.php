<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminPaidHoliday;
use App\Calendar;
use App\Calendar_w;
use App\Holiday;
use App\Models\Work;
use App\User;

class AdminPaidHolidayController extends Controller
{
    //
    public function index(Request $request){
        $users = User::all();
        return view('adminpaidholiday/index', ['users' => $users]);
    }
}
