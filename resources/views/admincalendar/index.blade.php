@extends('adminlayout')
@section('title', 'カレンダー')
@section('content')


<table border="1"> 
    <tr>
    @php
       $weekday = $current_month_weekday;
    @endphp
      <th></th>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
     @if ($weekday++%7 == 0)
        <th bgcolor="#FFCC33">{{$i}}</th>
      @elseif (array_search($current_month->format('Y-m') . '-' . sprintf('%02d', $i), $isHolidays))
        <th bgcolor="#FF3333">{{$i}}</th>
      @else
        <th>{{$i}}</th>
      @endif
     @endfor
    </tr>
    <tr>
    @php
       $weekday = $current_month_weekday
    @endphp
      <td>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
      @if ($weekday%7 == 0)
        <td bgcolor="#FFCC33">{{$weekdays[($weekday++)%7]}}</td>
      @elseif (array_search($current_month->format('Y-m') . '-' . sprintf('%02d', $i), $isHolidays))
        <th bgcolor="#FF3333">{{$weekdays[($weekday++)%7]}}</th>
      @else
        <td>{{$weekdays[($weekday++)%7]}}</td>
      @endif
     @endfor
    </tr>
　　@foreach ($users as $user)
　　<tr>
    @php
       $weekday = $current_month_weekday;
    @endphp
  　　<th>{{$user -> name}}</th>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
     @if ($weekday++%7 == 0)
        <td bgcolor="#FFCC33">
      @elseif (array_search($current_month->format('Y-m') . '-' . sprintf('%02d', $i), $isHolidays))
        <td bgcolor="#FF3333">
      @else
        <td>
      @endif
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