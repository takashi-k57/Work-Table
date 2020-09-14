@foreach($dayIterator as $dayobj)
    <td 
    class="<?php echo ($dayobj->is_holiday) ? 'is_holiday' : ''; ?>"
    style="border:1px solid black; padding:1em;">{{ $dayobj->day->format('d') }}</td>
@endforeach