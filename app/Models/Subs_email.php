<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subs_email extends Model
{
    //use HasFactory;
    protected $table = "subs_email";
	protected $fillable = [
		'user_profiles_id',
		'name',
		'lastname',
		'email',
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
