@extends('layouts/layout')
@section('title', 'カレンダー')
@section('content')
    @if ($admin_list)
      <p class="kokyu" style="margin-bottom: 0; font-size: 25px; text-align: right">{{$admin_list->day}}休</p>
    @endif
    {!!$cal_tag!!}
    
@endsection
