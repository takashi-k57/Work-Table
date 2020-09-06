@extends('adminlayout')
@section('title', 'カレンダー')
@section('content')
<table border="1"> 
    <tr>
       <th></th>
    @for($i=1; $i<=$days->daysInMonth; $i++)
      <th>{{$i}}</th>
    @endfor
    </tr>
    @foreach($users as $user)
    <tr>
      <th>{{$user -> name}}</th>
    </tr>
    @endforeach
  </table>
@endsection
