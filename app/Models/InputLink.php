<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputLink extends Model
{
    //use HasFactory;
	protected $table = 'input_links';
	
	protected $fillable = [
		'user_profile_id',
		'url', //face, instagram, paginaWeb, otros
		'is_premium',
		'video', //face, instagram, paginaWeb, otros
		'title',
		'subtitle',
		'logo',
		'position',
		'music',
		'comercial',
		'comercial2',
		'url_comercial',
		'img_comercial',
		'paypal_button',
		'expanded',
	];

	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
	
	public function userProfile()
	{
		return $this->belongsTo('App\Models\UserProfile');
	}
}
