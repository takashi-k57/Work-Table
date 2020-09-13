@extends('adminlayout')
@section('title', 'カレンダー')
@section('content')
{{$weekdays[$day->dayOfWeek]}}
<table border="1"> 
    <tr>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
       <th></th>
      <th>{{$i}}</th>
     @endfor
    </tr>
    <tr>
     @for ($i = 1; $i <= $current_month->daysInMonth; $i++)
       <td></td>
      <td>{{$weekdays[($current_month_weekday++)%7]}}</td>
     @endfor
    </tr>
    @foreach($users as $user)
    <tr>
      <th>{{$user -> name}}</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    @endforeach
  </table>
@endsection