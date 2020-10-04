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
     <th rowspan="2">日勤</th>
     <th rowspan="2">公休</th>
     <th rowspan="2">有休</th>
     <th rowspan="2">代休</th>
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
      @php
        $holiday_count = 0;
        $holiday_count2 = null;
        $holiday_count3 = null;
      @endphp
　　<tr>
    @php
       $weekday = $current_month_weekday;
    @endphp
  　　<th>{{$user -> name}}</th>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
        @php
          $holiday_flag = false;
        @endphp
        @if ($weekday%7 == 0)
          <td bgcolor="#FFCC33">
          @php
            $holiday_count = $holiday_count + 1;
            $holiday_flag = true;
          @endphp
        @elseif (array_search($current_month->format('Y-m') . '-' . sprintf('%02d', $i), $isHolidays))
          <td bgcolor="#FF3333">
        @else
          <td>
        @endif
        @if ($weekday++%7 == 0)
            公
        @elseif (!empty($user->holidays))
          @foreach ($user->holidays as $holiday)
            @if ( $current_month->format('Y-m') . '-' . sprintf('%02d', $i) == $holiday->day )
              {{ $holiday -> description }} 
           @endif
          @endforeach
        @endif
          </td>
     @endfor
     @php
     $holiday_count = $holiday_count + $user->kokyu($current_month->year, $current_month->month);
     $holiday_count2 = $user->yukyu($current_month->year, $current_month->month);
     $holiday_count3 = $user->daikyu($current_month->year, $current_month->month);
     $works = $current_month->daysInMonth - $holiday_count - $holiday_count2 - $holiday_count3;
     @endphp
     <th>{{$works}}</th>
     <th>{{$holiday_count}}</th>
     <th>{{$holiday_count2}}</th>
     <th>{{$holiday_count3}}</th>
    </tr>
    @endforeach
  </table>
@endsection