@foreach($dayIterator as $day)
    <td style="border:1px solid black; padding:1em;">{{ __('week.'.$day->format('D')) }}</td>
@endforeach