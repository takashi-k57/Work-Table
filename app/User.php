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
    $this->yukyu = $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '有')->count() * 1 + $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '半有')->count() * 0.5;
    $this->daikyu = $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '代')->count() * 1 + $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '半代')->count() * 0.5;
    $this->kokyu = $sunday + $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '公')->count() * 1 + $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', '半公')->count() * 0.5;

    $holidays = $this->yukyu + $this->daikyu + $this->kokyu;
    if ( $this->is_part_time ) {
      $this->workingdays = $this->holidays()->whereYear('day', $year)->whereMonth('day', $month)->where('description', 'A')->count() * 1;
    } else {
      $this->workingdays = $daysInMonth - $holidays;
    }
  }
}
