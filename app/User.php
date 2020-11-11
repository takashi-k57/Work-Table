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
    'name', 'email', 'password', 'is_part_time'
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
  
  public $yukyu, $daikyu, $kokyu, $workingdays;
  
  public function holidays() {
    return $this->hasMany('App\Holiday');
  }
  
  public function setHolidays($year, $month, $sunday, $daysInMonth) {
    $this->yukyu = $this->getTargetHolidays($year, $month, ['有', '半有'], $this->holidays());
    $this->daikyu = $this->getTargetHolidays($year, $month, ['代', '半代'], $this->holidays());
    $this->kokyu = $sunday + $this->getTargetHolidays($year, $month, ['公', '半公'], $this->holidays());
    
    if ( $this->is_part_time ) {
      $this->workingdays = $this->getTargetHolidays($year, $month, ['A'], $this->holidays());
    } else {
      $holidays = $this->yukyu + $this->daikyu + $this->kokyu;
      $this->workingdays = $daysInMonth - $holidays;
    }
  }
  
  
  public function getTargetHolidays($year, $month, $descriptions, $holiday_model) {
    $holidays = 0;
    foreach( $descriptions as $description ) {
      $holiday = $holiday_model->whereYear('day', $year)->whereMonth('day', $month)->where('description',  $description)->count();
      if (strpos($description, '半')) {
        $holiday = $holiday * 0.5;
      }
      $holidays += $holiday;
    }
    
    return $holidays;
  }
  
}
