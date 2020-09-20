@foreach($dayIterator as $dayobj)
  <td
  class="<?php echo ($dayobj->is_holiday) ? 'is_holiday' : ''; ?>  <?php echo ($dayobj->is_public_holiday) ? 'is_public_holiday' : ''; ?>" 
  style="border:1px solid black; padding:1em;">
  @foreach($holidays->where('user_id', $user->id )->get() as $holiday)
    @if($dayobj->day->format('Y-m-d') == $holiday->day)
      {{ $holiday->description }}
    @endif
  @endforeach
  </td>
@endforeach
