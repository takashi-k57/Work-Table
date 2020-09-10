@extends('adminlayout')
@section('title', 'カレンダー')
@section('content')
{{$weekdays[$today->addDay()->dayOfWeek]}}
<table border="1"> 
    <tr>
       <th></th>
    @for($i=1; $i<=$day->daysInMonth; $i++)
      <th>{{$i}}</th>
    @endfor
    </tr>
    <tr>
      <th></th>
    @for($i=1; $i<=$day->daysInMonth; $i++)
      <th>{{$weekdays[$today->addDay()->dayOfWeek]}}</th>
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
