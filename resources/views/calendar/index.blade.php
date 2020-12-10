@extends('layouts/layout')
@section('title', 'カレンダー')
@section('content')
    @if ($admin_list)
      <p class="kokyu" style="margin-bottom: 0; font-size: 25px; text-align: right;" onclick="clickEvent()">{{$admin_list->day}}休</p>
    @endif
    {!!$cal_tag!!}
    <script>
    function clickEvent(){
      alert('公休が残り'+ '8'+ '休取得できていません');
    }
    </script>
@endsection
