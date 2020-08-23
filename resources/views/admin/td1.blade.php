@foreach($dayIterator as $day)
    <td style="border:1px solid black; padding:1em;">{{ $day->format('d') }}</td>
@endforeach