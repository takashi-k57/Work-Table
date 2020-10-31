<?php

namespace App\Http\Controllers;


use App\Holiday;
use App\Calendar;
use Illuminate\Http\Request;

class HolidayController extends Controller
{

    //
    public function create(Request $request)
    {   
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::where('user_id', auth()->user()->id)->get();
        return view('calendar.holiday', ['list' => $list,'data' => $data]);
    }
   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'day' => 'required|date_format:Y-m-d',
            
        ]);
        // POSTで受信した休日データの登録
            $holiday = new Holiday();
            
            $holiday->day = $request->day;
            $holiday->user_id = auth()->user()->id;
        

            if($request->kokyu) {
                $holiday->description = '公';
            } elseif ($request->hanko){
                $holiday->description = '半公';
            } elseif($request->yukyu) {
                $holiday->description = '有';
            } elseif($request->hanyu) {
                $holiday->description = '半有';
            } elseif($request->daikyu) {
                $holiday->description = '代';
            } elseif($request->handai) {
                $holiday->description = '半代';
            } 
            $holiday->save();
           return redirect('/holiday');
         
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
          $list = Holiday::where('user_id', auth()->user()->id)->get();
        //dd($list);
        return redirect('/holiday');

    }
}
