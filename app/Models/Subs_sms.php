<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subs_sms extends Model
{
    //use HasFactory;
    protected $table = "subs_sms";
	protected $fillable = [
		'user_profiles_id',
		'name',
		'lastname',
		'phone',
	];

	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

    public function userprofile()
	{
		return $this->belongsTo('App\Models\UserProfile');
	}
}
