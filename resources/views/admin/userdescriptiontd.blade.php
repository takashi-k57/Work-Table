@foreach($dayIterator as $dayobj)
  <td
  class="<?php echo ($dayobj->is_sunday) ? 'is_sunday' : ''; ?>  <?php echo ($dayobj->is_public_holiday) ? 'is_public_holiday' : ''; ?>" 
  style="border:1px solid black; padding:1em;">
  @foreach($holidays->getSundayHoliday() as $holiday)
    @if($dayobj->day->format('Y-m-d') == $holiday->day)
      {{ $holiday->description }}
    @endif
  @endforeach
  </td>
@endforeach
