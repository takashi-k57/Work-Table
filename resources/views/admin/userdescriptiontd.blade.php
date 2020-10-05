@foreach($dayIterator as $dayobj)
  <td
  class="<?php echo ($dayobj->is_sunday) ? 'is_sunday' : ''; ?>  <?php echo ($dayobj->is_public_holiday) ? 'is_public_holiday' : ''; ?>" 
  style="border:1px solid black; padding:1em;">
  @foreach($user->holidays as $holiday)
    @if($dayobj->is_sunday)
      公休
    @elseif($holiday->day == $dayobj->day->format('Y-m-d'))
      {{ $holiday->description }}
    @endif
  @endforeach
  </td>
@endforeach
<td>
    {{ App\Holiday::getShiftDays($user, $dayIterator) }}
</td>
