@extends('layouts/adminlayout')
@section('title', '公休数登録')
@section('content')
<h1 style="text-align: center; margin-top:15px; margin-bottom:20px; font-size:2em">公休数登録</h1>
<div style="text-align: center"> 
<a class="btn btn-primary" href="/admin/holiday?year={{$last_year->year}}" role="button">&lt;前年</a>
 {{$current_month->year}}年
<a class="btn btn-primary" href="/admin/holiday?year={{$following_year->year}}" role="button">翌年&gt;</a>
</div>
<form method="POST" action="{{action('Admin\AdminHolidayController@store')}}">
    <table calss="adminholiday"style="with: 50%; margin: 0 auto">
    @if($admin_list->count() > 0)
        @foreach($admin_list as $holiday)
        <tr>
        <th> {{$holiday->month}}月</th>
        <td>
         <div class="form-group2">
             <input type="text" name="day[]" class="form-control" value="{{$holiday->day}}">
         </div>
        </td>
        </tr>
        @endforeach
    @else
        @for ($i = 1; $i <= 12; $i++)
        <tr>
        <th> {{$i}}月</th>
        <td>
         <div class="form-group2">
             <input type="text" name="day[]" class="form-control" value="0">
         </div>
        </td>
        </tr>
        @endfor
    @endif
    </table>
    @csrf
    <div class="col text-center">
    <button type="submit" class="btn btn-primary" style="text-align: center">登録</button> 
    </div>
    <input type="hidden" name="year" value="{{ $current_month->year }}" />
</form>
@endsection