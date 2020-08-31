@extends('layout')
@section('title', 'カレンダー')
@section('content')
    {!!$cal_tag!!}
    @if(auth()->user()->is_admin)
        全員の休日登録リストを表示します<br>
        <table>
            <tr>
                @while($day != $last_day)
                <td style="border:1px solid black; padding:1em;">{{ $day->add(new \dateInterval('P1D'))->format('d') }}</td>
                <?php $targetholidays = $holidays->where('day', $day->format('Y-m-d')) ?>
                <td>
                    @foreach($targetholidays as $targetholiday)
                        {{ $targetholiday->id}}番さんが
                        {{ $targetholiday->description}}です
                    @endforeach
                </td>
                @endwhile
            </tr>
        </table>
        
    @endif
@endsection
