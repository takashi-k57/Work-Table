<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'worksystem',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function holidays()
  {
    return $this->hasMany('App\Holiday');
  }

    public function works()
  {
    return $this->hasMany('App\Models\Work');
  }

    public  function kokyu($year, $month) {
    return $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '公')->count() * 1 + $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '半公')->count() * 0.5;
  }

    public  function yukyu($year, $month) {
    return $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '有')->count() * 1 + $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '半有')->count() * 0.5;
  }

    public  function daikyu($year, $month) {
    return $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '代')->count() * 1 + $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '半代')->count() * 0.5;
  }
 
    public  function yukyu_w($year, $month) {
    return $this->works()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '有')->count() * 1 + $this->works()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '半有')->count() * 0.5;
  }
  
    public  function work($year, $month) {
    return $this->works()->whereYear('day', $year)->whereMonth('day', $month)->where('description', 'A')->count() * 1 ;
  }

     //有給表示
  public function paidholiday_count()
  {
    if($this->worksystem == '常勤'){
      return $this->holidays->where('description', '有')->count() * 1 + $this->holidays->where('description', '半有')->count() * 0.5;
    }elseif($this->worksystem == '非常勤'){
      return $this->works->where('description', '有')->count() * 1 + $this->works->where('description', '半有')->count() * 0.5;
    }
  }

        //有給表示
        //if(Auth::user()'){
            //$paid_holidays = Holiday::where('description', '有')->count() * 1 + Holiday::where('description', '半有')->count() * 0.5 ;
        //}elseif(Auth::user()->worksystem == '非常勤'){
            //$paid_holidays = Work::where('description', '有')->count() * 1 + Work::where('description', '半有')->count() * 0.5;
       // }

}
