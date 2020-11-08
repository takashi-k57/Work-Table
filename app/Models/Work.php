<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
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
}
