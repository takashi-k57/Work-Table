@extends('adminlayout')
@section('title', '公休数登録')
@section('content')
<h1>公休数登録</h1>
<table border="1">
  <tr>
  @for ($i = 1; $i <= 12; $i++)
   <th> {{$i}}月</th>
   <th>
   <form method="POST" action="admin/holiday"> 
   <div class="form-group2">
   @csrf  
   <input type="text"  class="form-control" value="{{$holiday_data->day}}">
   </div>
   </th>
  @endfor
   <button type="submit" class="btn btn-primary">登録</button> 
   <input type="hidden" name="id" value="{{$holiday_data->id}}">
   </form>
   

  </tr>
</table>
@endsection