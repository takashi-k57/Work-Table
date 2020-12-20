@extends('layouts/adminlayout')
@section('title', '有給一覧')
@section('content')
<h1 style="text-align: center; margin-top:10px; margin-bottom:10px">有給一覧表</h1>
<div class = "row">
  <div class ="col-md-3"></div>
  <div class ="col-md-6">
    <table border="1" style="with: 50%; margin: 0 auto">
      <tr>
        <th>氏名</th>
        <th>取得日数</th>
      </tr>
      @foreach($users as $user)
        <tr>
      　  <td>{{$user -> name}}</td>
          <td>{{ $user->paidholiday_count() }}日</td>
        </tr>
    　 @endforeach
    </table>
  </div>
  <div class ="col-md-3"></div>
</div>
@endsection