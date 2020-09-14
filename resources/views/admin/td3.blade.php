@foreach($dayIterator as $dayobj)
    <td 
    class="<?php echo ($dayobj->is_holiday) ? 'is_holiday' : ''; ?>"
    style="border:1px solid black; padding:1em;">{{ __('week.'.$dayobj->day->format('D')) }}</td>
@endforeach

<?php // ひと段落したらSassの方へ書き直す ?>
<style>
.is_holiday {
    background-color: red;
}

</style>