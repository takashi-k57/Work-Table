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

    public static function getHolidayObj(User $user, dayIterator $dayIterator) {
        foreach( $dayIterator as $dayobj ) {

            foreach( $user->holidays as $holiday ) {
                if( $holiday->day == $dayobj->day->format('Y-m-d') ) {
                    $holidays[] = $holiday;
                }
            }
        } 

        return $holidays;
    }

    public static function getHoliday(User $user, dayIterator $dayIterator) {
        foreach( $dayIterator as $dayobj ) {

            foreach( $user->holidays as $holiday ) {
                if( $holiday->day == $dayobj->day->format('Y-m-d') ) {
                    $holidays[] = $holiday->day;
                }
            }
        } 

        return $holidays;
    }

    public static function getHolidayNums(User $user, dayIterator $dayIterator) {
        $count = 0;
        foreach( self::getHolidayObj($user, $dayIterator) as $holiday) {
            if( $holiday->description == '有給' ) {
                $count += 1;
            }elseif( $holiday->description == '半休' || $holiday->description == '半有' ) {
                $count += 0.5;
            }
        } 
        return (float)$count;
    }

    public static function getSundayNums(dayIterator $dayIterator) {
        return count(self::getSunday($dayIterator));
    }


    public static function getCompensationDayNums(User $user, dayIterator $dayIterator) {
        $count = 0;
        foreach( self::getHolidayObj($user, $dayIterator) as $holiday) {
            if( $holiday->description == '代休' ) {
                $count += 1;
            }
        } 
        return (float)$count;
    }
}
