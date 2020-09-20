@extends('adminlayout')
@section('title', 'カレンダー')
@section('content')
{{ $current_month->format('Y-m') . '-' . sprintf('%02d', 1) }}
<table border="1"> 
    <tr>
      <th></th>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
      <th>{{$i}}</th>
     @endfor
    </tr>
    <tr>
      <td>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
      <td>{{$weekdays[($current_month_weekday++)%7]}}</td>
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