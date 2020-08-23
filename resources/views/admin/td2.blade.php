@foreach($dayIterator as $day)
  <td style="border:1px solid black; padding:1em;">
  @foreach($holidays->where('user_id',$user->id)->get() as $holiday)
    @if($day->format('Y-m-d') == $holiday->day)
      {{ $holiday->description }}
    @endif
  @endforeach
  </td>
@endforeach
