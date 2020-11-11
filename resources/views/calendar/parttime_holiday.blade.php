@extends('layout')
@section('title', '勤務設定')
@section('content')
    <h1>非常勤・勤務設定</h1>
    <!-- 休日入力フォーム -->
    <form method="POST" action="/holiday"> 
    <div class="form-group">
    @csrf   
    <label for="day">日付[YYYY/MM/DD] </label>
    <input type="text" name="day" class="form-control" id="day" value="{{$data->day}}">
    <input class="btn  btn-primary"  type="submit"  name="work"   value="A">
    <input class="btn  btn-primary"  type="submit"  name="yukyu"   value="有休">
    <input class="btn  btn-primary"  type="submit"  name="hankyu"   value="半休">
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