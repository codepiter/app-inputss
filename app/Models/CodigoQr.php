<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoQr extends Model
{
    //use HasFactory;
	protected $table = 'codigo_qrs';
	
	protected $fillable = [
		'user_profile_id',
		'url',
		'typedots',
		'width',
		'height',
		'background',
		'color',
		'image',
	];
	
	public function userProfile()
	{
		return $this->belongsTo('App\Models\UserProfile');
	}
	
	public function userProfileUser()
    {
        return $this->hasOneThrough('App\Models\User', 'App\Models\UserProfile');
    }
}
