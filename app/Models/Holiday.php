<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    public $month = '';

    // ユーザーが登録した休日と公休（日曜日）を取得する
    public static function getSundayHoliday(User $user, dayIterator $dayIterator) {

        return array_merge(
            self::getSunday($dayIterator),
            self::getHoliday($user, $dayIterator)
         );
    }

    public function users() {
        return $this->belongsTo('App\User');
    }

    public static function getShiftDayNums(User $user, dayIterator $dayIterator) {

        $month_days = $dayIterator->last_day->format('d');
        $holidays = count( self::getSundayHoliday($user, $dayIterator) );
        return $month_days - $holidays;
    }
    
    public static function getSunday(dayIterator $dayIterator) {
        foreach($dayIterator as $dayobj) {
            foreach( self::where('description', '公休')->get() as $public_holiday) {
                if( $public_holiday->day == $dayobj->day->format('Y-m-d') ) {
                    $holidays[] = $public_holiday->day;
                }
            }
        } 

        return $holidays;
    }

    public static function getHoliday(User $user, dayIterator $dayIterator) {
        foreach($dayIterator as $dayobj) {

            foreach( $user->holidays as $holiday ) {
                if( $holiday->day == $dayobj->day->format('Y-m-d') ) {
                    $holidays[] = $holiday->day;
                }
            }
        } 

        return $holidays;
    }

    public static function getHolidayNums(User $user, dayIterator $dayIterator) {
        return count(self::getHoliday($user, $dayIterator));
    }

    public static function getSundayNums(dayIterator $dayIterator) {
        return count(self::getSunday($dayIterator));
    }
}
