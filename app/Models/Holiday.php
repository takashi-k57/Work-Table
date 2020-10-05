<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    // ユーザーが登録した休日と公休（日曜日）を取得する
    public static function getSundayHoliday() {
        return self::where('user_id', auth()->user()->id)->OrWhere('description', '公休')->get();
    }

    public function users() {
        return $this->belongsTo('App\User');
    }
    
}
