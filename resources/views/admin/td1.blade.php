@foreach($dayIterator as $dayobj)
    <td 
    class="<?php echo ($dayobj->is_holiday) ? 'is_holiday' : ''; ?>  <?php echo ($dayobj->is_public_holiday) ? 'is_public_holiday' : ''; ?>"
    style="border:1px solid black; padding:1em;">{{ $dayobj->day->format('d') }}</td>
@endforeach