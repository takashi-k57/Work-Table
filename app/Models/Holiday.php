<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    // ユーザーが登録した休日と公休（日曜日）を取得する
    public function getSundayHoliday(User $user) {
        foreach( $user->holidays as $holiday ) {
            $holidays[] = $holiday->day;
        }

        foreach( self::where('description', '公休')->get() as $public_holiday) {
            $holidays[] = $public_holiday->day;
        }

        return $holidays;
    }

    public function users() {
        return $this->belongsTo('App\User');
    }
    
}
