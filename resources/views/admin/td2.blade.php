<?php 
$day = clone $first_day;
$day->sub(new \DateInterval('P1D'));
?>
@while($day != $last_day)
<?php $day->add(new \dateInterval('P1D')); ?>
<td style="border:1px solid black; padding:1em;">
@foreach($holidays->where('user_id',$user->id)->get() as $holiday)
  @if($day->format('Y-m-d') == $holiday->day)
  {{ $holiday->description }}
  @endif
@endforeach
</td>
@endwhile