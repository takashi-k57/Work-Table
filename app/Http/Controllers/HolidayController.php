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

        $current_year = date('Y');
        $current_date = date('m/d');
        $search_range_start = ($current_year ."/".$current_date  > $current_year.'/03/31') ? (string)$current_year . "/04/01" : (string)($current_year - 1) . "/04/01";
        $search_range_end = ($current_year ."/".$current_date  > $current_year.'/03/31') ? (string)($current_year - 1) . "/03/31" : (string)($current_year) . "/03/31";
        $search_range = [$search_range_start, $search_range_end];

        // $list = Holiday::wherebetween('day', ["2020/04/01", "2021/03/31"])->get();
        //$list = Holiday::where('user_id', auth()->user()->id)->wherebetween('day', ["2020/04/01", "2021/03/31"])->get();
        $list = Holiday::where('user_id', auth()->user()->id)->wherebetween('day', $search_range)->get();


        //if($current_year .'/'.$current_date  > $current_year.'/03/31'){
            //$search_range = [$current_year. '/04/01', $current_year + 1 .'/03/31'];
        //}
        // $search_range = ($current_year ."/".$current_date  > $current_year."/".'3/31') ? [$current_year."/04/01", $current_year + 1."/3/31"] : [$current_year - 1 ."/04/01", $current_year."/3/31"];


        $yukyu = $list->where('description', '有')->count() * 1 + $list->where('description', '半有')->count() * 0.5;
        
        return view('calendar.holiday', ['list' => $list,'data' => $data, 'yukyu' => $yukyu]);
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
