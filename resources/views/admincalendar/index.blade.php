@extends('adminlayout')
@section('title', 'カレンダー')
@section('content')

@php
print_r($isHolidays);
@endphp
<table border="1"> 
    <tr>
      <th></th>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
      @if (array_search($current_month->format('Y-m') . '-' . sprintf('%02d', $i), $isHolidays))
        <th bgcolor="red">{{$i}}</th>
      @else
        <th>{{$i}}</th>
      @endif
     @endfor
    </tr>
    <tr>
      <td>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
      @if ($current_month_weekday%7 == 0)
        <td bgcolor="blue">{{$weekdays[($current_month_weekday++)%7]}}</td>
      @else
        <td>{{$weekdays[($current_month_weekday++)%7]}}</td>
      @endif
     @endfor
    </tr>
　　@foreach ($users as $user)
　　<tr>
  　　<th>{{$user -> name}}</th>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
      <td>
      @if (!empty($user->holidays))
      @foreach ($user->holidays as $holiday)
       @if ( $current_month->format('Y-m') . '-' . sprintf('%02d', $i) == $holiday->day )
        {{ $holiday -> description }}
       @endif
      @endforeach
      @endif
      </td>
     @endfor
    </tr>
    @endforeach
    
  
  </table>
@endsection