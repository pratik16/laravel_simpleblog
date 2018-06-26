<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = ['avatar', 'about', 'facebook', 'youtube'];
	
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
