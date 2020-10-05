@foreach($dayIterator as $dayobj)
  <td
  class="<?php echo ($dayobj->is_sunday) ? 'is_sunday' : ''; ?>  <?php echo ($dayobj->is_public_holiday) ? 'is_public_holiday' : ''; ?>" 
  style="border:1px solid black; padding:1em;">
  @if( $dayobj->is_sunday )
      公休
  @endif
  @foreach( $user->holidays as $holiday )
    @if( $holiday->day == $dayobj->day->format('Y-m-d') )
      {{ $holiday->description }}
    @endif
  @endforeach
  </td>
@endforeach
<td style="border:1px solid black; padding:1em;">
    {{ $holidays::getShiftDayNums($user, $dayIterator) }}
</td>
<td style="border:1px solid black; padding:1em;">
    {{ $holidays::getSunDayNums($dayIterator) }}
</td>
<td style="border:1px solid black; padding:1em;">
    {{ $holidays::getHoliDayNums($user, $dayIterator) }}
</td>