@extends('adminlayout')
@section('title', '公休数登録')
@section('content')
<h1>公休数登録</h1>
<div>
<a class="btn btn-primary" href="/admin/holiday?year={{$last_year->year}}" role="button">&lt;前年</a>
 {{$current_month->year}}年
<a class="btn btn-primary" href="/admin/holiday?year={{$following_year->year}}" role="button">翌年&gt;</a>
</div>
<form method="POST" action="{{action('Admin\AdminHolidayController@store')}}"> 
    <table border="1">
    <tr>
    @if($admin_list->count() > 0)
        @foreach($admin_list as $holiday)
        <th> {{$holiday->month}}月</th>
        <th>
        <div class="form-group2">
            <input type="text" name="day[]" class="form-control" value="{{$holiday->day}}">
        </div>
        </th>
        @endforeach
    @else
        @for ($i = 1; $i <= 12; $i++)
        <th> {{$i}}月</th>
        <th>
        <div class="form-group2">
            <input type="text" name="day[]" class="form-control" value="0">
        </div>
        </th>
        @endfor
    @endif
    </tr>
    </table>
    @csrf
    <button type="submit" class="btn btn-primary">登録</button> 
    <input type="hidden" name="year" value="{{ $current_month->year }}" />
</form>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection