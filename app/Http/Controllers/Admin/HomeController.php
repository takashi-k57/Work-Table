<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holiday;
use App\User;
use App\dayIterator;
use App\AnnualHoliday;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $month = $request->month;
        // 一月だけページめくりを可能にする
        if ($month == 'next' || $month == 'prev') {
            $dayIterator = new dayIterator('month', $month);
        }else {
            $dayIterator = new dayIterator('month');
        }
        
        return view('admin.home', [
                'users' => User::all(),
                'holidays' => new Holiday,
                'dayIterator' => $dayIterator
             ]);
    }

    public function create() {
        $annualHoliday = AnnualHoliday::all()->sortByDesc('month');

        return view('admin.annualholidays', ['annualHolidays' => $annualHoliday]);
    }

    public function store(Request $request) {
        
        foreach(range(1, 12) as $month) {
            $annualHoliday = new AnnualHoliday;
            $holidays = $request->input("holidays{$month}") ?? 0;
            $annualHoliday->month = $month;
            $annualHoliday->holidays = $holidays;
            $annualHoliday->save();
        }

        return redirect('/admin/');
        
    }
}
