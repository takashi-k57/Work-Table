<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    public $month = '';

    // ユーザーが登録した休日と公休（日曜日）を取得する
    public static function getSundayHoliday(User $user, dayIterator $dayIterator) {
        foreach($dayIterator as $dayobj) {

            foreach( $user->holidays as $holiday ) {
                if( $holiday->day == $dayobj->day->format('Y-m-d') ) {
                    $holidays[] = $holiday->day;
                }
            }
            foreach( self::where('description', '公休')->get() as $public_holiday) {
                if( $public_holiday->day == $dayobj->day->format('Y-m-d') ) {
                    $holidays[] = $public_holiday->day;
                }
            }
        } 

        return $holidays;
    }

    public function users() {
        return $this->belongsTo('App\User');
    }

    public static function getShiftDays(User $user, dayIterator $dayIterator) {

        $month_days = $dayIterator->last_day->format('d');
        $holidays = count( self::getSundayHoliday($user, $dayIterator) );
        return $month_days - $holidays;
    }
    
}
