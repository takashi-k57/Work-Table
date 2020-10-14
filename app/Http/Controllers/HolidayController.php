<?php

namespace App\Http\Controllers;


use App\Holiday;
use App\Calendar;
use App\dayIterator;
use Illuminate\Http\Request;

class HolidayController extends Controller
{

    //
    public function create(Request $request)
    {   
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::where('user_id', auth()->user()->id)->get();
        // $list = Holiday::getSundayHoliday(auth()->user(), new dayIterator);
        return view('calendar.holiday', ['list' => $list,'data' => $data]);
    }
   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'day' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ]);
        // POSTで受信した休日データの登録
            $holiday = new Holiday();
            
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->user_id = auth()->user()->id;
            $holiday->save();
            
           return redirect('/holiday');
         // 休日データ取得
         //$data = new Holiday();
         //$list = Holiday::where('user_id', auth()->user()->id)->get();
         //return view('calendar.holiday', ['list' => $list,'data' => $data]);
    }

    public function edit($id)
    {
        
        
        
    }

    public function update(Request $request, $id)
    {
        
        
        
    }

    public function destroy(Request $request){
        //Deleteで受信した休日データの削除
        if(isset($request->id)){
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->delete();
        }
        //休日データ取得
          $data = new Holiday();
          $list = Holiday::where('user_id', auth()->user()->id)->get();;
        //dd($list);
        return redirect('/holiday');

    }
}
