@extends('adminlayout')
@section('title', 'カレンダー')
@section('content')
<div>
<a class="btn btn-primary" href="/admin?year={{$last_month->year}}&month={{$last_month->month}}" role="button">&lt;前月</a>
 {{$current_month->year}}年{{$current_month->month}}月
<a class="btn btn-primary" href="/admin?year={{$following_month->year}}&month={{$following_month->month}}" role="button">翌月&gt;</a>
</div>
<div align=”rigth”>{{$admin_list->day}}休</div>
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
　　<tr>
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
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalForm" data-user_id="{{$user->id}}" data-day="{{$current_month->format('Y-m') . '-' . sprintf('%02d', $i)}}">
          
          </button>　
          @php
            $kokyu = $kokyu + 1;
            $holiday_flag = true;
          @endphp
        @elseif (array_search($current_month->format('Y-m') . '-' . sprintf('%02d', $i), $isHolidays))
          <td bgcolor="#FF3333">　
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalForm" data-user_id="{{$user->id}}" data-day="{{$current_month->format('Y-m') . '-' . sprintf('%02d', $i)}}">
          
          </button>　
        @else
        <td>　
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalForm" data-user_id="{{$user->id}}" data-day="{{$current_month->format('Y-m') . '-' . sprintf('%02d', $i)}}">
          
          </button>　
        @endif
        @if ($weekday++%7 == 0)
            公
        @elseif (!empty($user->holidays))
          @foreach ($user->holidays as $holiday)
            @if ( $current_month->format('Y-m') . '-' . sprintf('%02d', $i) == $holiday->day )
              {{ $holiday -> description }} 
           @endif
          @endforeach
        @endif
          </td>
     @endfor
     <div class="modal fade" id="modalForm" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal ヘッダー -->
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
        </button>
        </div>
      <form role="form" action="{{ action('Admin\AdminCalendarController@store') }}" method="POST">
        <!-- Modal ボディー -->
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input class="btn  btn-primary"  type="submit"  name="kokyu"   value="公">
            <input class="btn  btn-primary"  type="submit"  name="hanko"  value="半公">
            <input class="btn  btn-primary"  type="submit"  name="yukyu"   value="有">
            <input class="btn  btn-primary"  type="submit"  name="hanyu"   value="半有">
            <input class="btn  btn-primary"  type="submit"  name="daikyu"  value="代">
            <input class="btn  btn-primary"  type="submit"  name="handai"   value="半代">
            <input class="modal-input-user-id" type="hidden" name="user_id">
            <input class="modal-input-day" type="hidden" name="day">
          </div>
        </div>
        <!-- Modal フッター -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close
          </button>
        </div>
      </form>
      <form role="form" action="{{ action('Admin\AdminCalendarController@delete') }}" method="POST">
        @csrf
        {{method_field('DELETE')}}
      <div> 
        <input class="modal-input-user-id" type="hidden" name="user_id">
        <input class="modal-input-day" type="hidden" name="day">
        <input class="btn  btn-primary"  type="submit" value="削除">
      </div>
      </form>
    </div>
  </div>
</div>　
     @php
        $kokyu = $kokyu + $user->kokyu($current_month->year, $current_month->month);
        $yukyu = $user->yukyu($current_month->year, $current_month->month);
        $daikyu = $user->daikyu($current_month->year, $current_month->month);
        $works = $current_month->daysInMonth - $kokyu - $yukyu - $daikyu;
     @endphp
     <th>{{$works}}</th>
     <th>{{$kokyu}}</th>
     <th>{{$yukyu}}</th>
     <th>{{$daikyu}}</th>
    </tr>
    @endforeach
  </table>
  <script>

    $('#modalForm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var userId = button.data('user_id');
      var day = button.data('day');
      $('.modal-input-user-id').val(userId);
      $('.modal-input-day').val(day);      
    })
  </script>
@endsection