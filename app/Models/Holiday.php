<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'day', 'description', 'user_id',
  ];

    //
    public function user()
    {
      return $this->belongsTo('App\User');
    }

   // public  function yukyu(Request $request) {
      //return $this->holidays()->where('description', '有')->count() * 1 + $this->holidays()->where('description', '半有')->count() * 0.5;

    //}
    
}
