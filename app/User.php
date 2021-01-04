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

      //$current_year = date('Y');
      //$current_date = date('m/d');
      //$search_range_start = ($current_year ."/".$current_date  > $current_year.'/03/31') ? (string)$current_year . "/04/01" : (string)($current_year - 1) . "/04/01";
      //$search_range_end = ($current_year ."/".$current_date  > $current_year.'/03/31') ? (string)($current_year - 1) . "/03/31" : (string)($current_year) . "/03/31";
      //$search_range = [$search_range_start, $search_range_end];
      //dd($search_range);
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
        $current_year = date('Y');
        $current_date = date('m/d');
        $search_range_start = ($current_year ."/".$current_date  > $current_year.'/03/31') ? (string)$current_year . "/04/01" : (string)($current_year - 1) . "/04/01";
        $search_range_end = ($current_year ."/".$current_date  > $current_year.'/03/31') ? (string)($current_year - 1) . "/03/31" : (string)($current_year) . "/03/31";
        $search_range = [$search_range_start, $search_range_end];
        //dd($search_range);

    if($this->worksystem == '常勤'){
      return $this->holidays()->wherebetween('day', $search_range)->where('description', '有')->count() * 1 + $this->holidays()->wherebetween('day', $search_range)->where('description', '半有')->count() * 0.5;
    }elseif($this->worksystem == '非常勤'){
      return $this->works()->wherebetween('day', $search_range)->where('description', '有')->count() * 1 + $this->works()->wherebetween('day', $search_range)->where('description', '半有')->count() * 0.5;
    }
  }

        //有給表示
        //if(Auth::user()'){
            //$paid_holidays = Holiday::where('description', '有')->count() * 1 + Holiday::where('description', '半有')->count() * 0.5 ;
        //}elseif(Auth::user()->worksystem == '非常勤'){
            //$paid_holidays = Work::where('description', '有')->count() * 1 + Work::where('description', '半有')->count() * 0.5;
       // }

}
