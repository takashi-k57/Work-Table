@extends('adminlayout')
@section('title', 'カレンダー')
@section('content')
<div>
<a class="btn btn-primary" href="/admin?year={{$last_month->year}}&month={{$last_month->month}}" role="button">&lt;前月</a>
 {{$current_month->year}}年{{$current_month->month}}月
<a class="btn btn-primary" href="/admin?year={{$following_month->year}}&month={{$following_month->month}}" role="button">翌月&gt;</a>
</div>
<div align=”rigth”>休</div>
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
        $weekday = $current_month_weekday;
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
        $kokyu = 0;
        $yukyu = null;
        $daikyu = null;
      @endphp
　　<tr class="description">
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
            $kokyu = $kokyu + 1;
            $holiday_flag = true;
          @endphp
        @elseif (array_search($current_month->format('Y-m') . '-' . sprintf('%02d', $i), $isHolidays))
          <td bgcolor="#FF3333">
        @else
          <td>
        @endif

        <select name="description" id="">
          <option value="公">公休</option>
          <option value="有">有休</option>
          <option value="半公">半公</option>
          <option value="半有">半有</option>
        </select>
        @if ($weekday++%7 == 0)
            <input type="hidden" value="公休" name="description">
        @elseif (!empty($user->holidays))
          @foreach ($user->holidays as $holiday)
            @if ( $current_month->format('Y-m') . '-' . sprintf('%02d', $i) == $holiday->day )
            {{ $holiday->description }}
              <input type="hidden" value="{{ $holiday->description }}" name="description">
           @endif
          @endforeach
        @endif
          </td>
     @endfor
     @php
        $kokyu = $kokyu + $user->kokyu($current_month->year, $current_month->month);
        $yukyu = $user->yukyu($current_month->year, $current_month->month);
        $daikyu = $user->daikyu($current_month->year, $current_month->month);
        $works = $current_month->daysInMonth - $kokyu - $yukyu - $daikyu;
     @endphp
     <th class="works">{{$works}}</th>
     <th class="kokyu">{{$kokyu}}</th>
     <th class="yukyu">{{$yukyu}}</th>
     <th class="daikyu">{{$daikyu}}</th>
    </tr>
    @endforeach
  </table>
@endsection

<script>

</script>