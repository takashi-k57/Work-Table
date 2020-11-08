<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Calendar_w;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    //
    public function create(Request $request)
    {
        $data = new Work();
        $list = Work::where('user_id', auth()->user()->id)->get();
        return view('calendar_w.work', ['list' => $list, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'day' => 'required|date_format:Y-m-d',
            
        ]);
        // POSTで受信した休日データの登録
        $work = new Work(); 
        $work->user_id = auth()->user()->id;
        $work->day = $request->day;

        if($request->work) {
            $work->description = 'A';
        } elseif ($request->yukyu){
            $work->description = '有';
        } elseif($request->hanyu) {
            $work->description = '半有';
        }        
        $work->save();
        // 休日データ取得
        $list = Work::all();

        return redirect('/work');
    }

    public function destroy(Request $request){
        //Deleteで受信した休日データの削除
        if(isset($request->id)){
            $work = Work::where('id', '=', $request->id)->first();
            $work->delete();
        }
        //休日データ取得
          $data = new Work();
          $list = Work::where('user_id', auth()->user()->id)->get();
        //dd($list);
        return redirect('/holiday');

    }


}
