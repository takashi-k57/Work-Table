<h1>年度休み登録画面</h1>

<form action="/admin/annualholidays" method="POST">
    @csrf
    @foreach(range(1, 12) as $month)
        <p>{{ $month }}月</p>
        <input type="hidden" name="month" value="{{ $month }}">
        @if( $annualHolidays->where('month', $month)->first() !== null)
            <input type="text" name="holidays{{$month}}" value="{{ $annualHolidays->where('month', $month)->first()->holidays }}">
        @else
            <input type="text" name="holidays{{$month}}" value="0">
        @endif
        <br>
    @endforeach
    <input type="submit" value="送信する">
</form>