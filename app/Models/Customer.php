<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //use HasFactory;
	
	protected $fillable = [
		'user_profile_id',
		'name',
		'email',
	];
				
	public function userProfile()
	{
		return $this->belongsTo('App\Models\UserProfile');
	}
}
