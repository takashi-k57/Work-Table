@while($day != $last_day)
    <td style="border:1px solid black; padding:1em;">{{ $day->add(new \dateInterval('P1D'))->format('d') }}</td>
@endwhile