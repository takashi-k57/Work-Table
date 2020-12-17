@extends('layouts/adminlayout')
@section('title', '有給一覧')
@section('content')
<h1 style="text-align: center; margin-top:10px; margin-bottom:10px">有給一覧表</h1>
<table border="1">
 <tr>
  <th>取得日数</th>
 </tr>
 <tr>
  @foreach($users as $user)
  <th>{{$user -> name}}</th>
   <td>{{ $user->paidholiday_count() }}日</td>
  @endforeach
 </tr>
</table>
@endsection