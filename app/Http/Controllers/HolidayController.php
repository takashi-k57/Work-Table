<?php

namespace App\Http\Controllers;

use App\Holiday;
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
        $holiday->day = $validatedData["day"];
        $holiday->description = $validatedData["description"];
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
        // 休日データ取得
        $data = Holiday::find($id);
        return view('calendar.edit', ['data' => $data, 'id' => $id]);
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
        $validatedData = $request->validate(
            ['day' => 'required|date_format:Y-m-d', 'description' => 'required',]
        );
        $holiday = Holiday::find($id);
        $holiday->day = $validatedData['day'];
        $holiday->description = $validatedData['description'];
        $holiday->save();
        return redirect('/holiday');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Holiday::destroy($id);
        return redirect('/holiday');
    }
}
