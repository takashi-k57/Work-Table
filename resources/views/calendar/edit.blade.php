@extends('layout')
@section('title', '休日設定')
@section('content')
    <h1>勤務・休日設定</h1>
    <!-- 休日入力フォーム -->
    <form method="POST" action="/holiday/{{$id}}"> 
    @method('PUT')
    @csrf 
    <div class="form-group">
    <label for="day">日付[YYYY/MM/DD] </label>
    <input type="text" name="day" class="form-control" id="day" value="{{$data->day}}">
    <label for="description">説明</label>
    <input type="text" name="description" class="form-control" id="description" value="{{$data->description}}"> 
    </div>
    <button type="submit" class="btn btn-primary">登録</button> 
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
    