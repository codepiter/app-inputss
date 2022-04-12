<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUser extends Model
{
    //use HasFactory;

    protected $table = "contact_user";
	protected $fillable = [
		'user_profiles_id',
		'fullname',
		'email',
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
