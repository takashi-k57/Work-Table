@extends('layouts/layout')
@section('title', '休日設定')
@section('content')
    <h1>勤務・休日設定</h1>
    <!-- 休日入力フォーム -->
    <form method="POST" action="/holiday"> 
    <div class="form-group">
    @csrf   
    <label for="day">日付[YYYY/MM/DD] </label>
    <input type="text" name="day" class="form-control" id="day" value="{{$data->day}}">
    <input class="btn  btn-primary"  type="submit"  name="kokyu"   value="公">
    <input class="btn  btn-primary"  type="submit"  name="hanko"  value="半公">
    <input class="btn  btn-primary"  type="submit"  name="yukyu"   value="有">
    <input class="btn  btn-primary"  type="submit"  name="hanyu"   value="半有">
    <input class="btn  btn-primary"  type="submit"  name="daikyu"  value="代">
    <input class="btn  btn-primary"  type="submit"  name="handai"   value="半代">
    </form> 
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- 休日一覧表示 -->
    <table class="table">
    <thead>
    <tr>
    <th scope="col">日付</th>
    <th scope="col">説明</th>
    </tr>
    </thead>
    @foreach($list as $val)
    <tr>
        <!-- 日付のリンクをつける -->
        <th scope="row"><a href="{{ url('/holiday/'.$val->id) }}">{{$val->day}}</a></th>
        <td>{{$val->description}}</td>
        <td><form action="/holiday" method="post">
            <input type="hidden" name="id" value="{{$val->id}}">
            {{ method_field('delete') }}
            @csrf
            <button class="btn btn-default" type="submit">削除</button>
        </form></td>
    </tr>
    @endforeach
    </tbody>
    </table>
    <a href="{{ url('/') }}">カレンダーに戻る</a>
    <script>
    $( function() {
     $( "#day" ).datepicker({dateFormat: 'yy-mm-dd'});
    } );
    </script>
    

@endsection