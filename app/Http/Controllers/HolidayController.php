<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Calendar;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::where('user_id', auth()->user()->id)->get();
        return view('calendar.holiday', ['list' => $list,'data' => $data]);
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            ['day' => 'required|date_format:Y-m-d', 'description' => 'required',]
        );
        $holiday = new Holiday();
        $holiday->day = $request->day;
        $holiday->description = $request->description;
        $holiday->user_id = auth()->user()->id;
        $holiday->save();
        
        return redirect('/holiday');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //Deleteで受信した休日データの削除
        if(isset($id)){
            $holiday = Holiday::where('id', '=', $id)->first();
            $holiday->delete();
        }
        return redirect('/holiday');
    }
}
