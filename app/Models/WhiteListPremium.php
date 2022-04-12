<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhiteListPremium extends Model
{
    //use HasFactory;
    protected $table = "white_list_premium";

    protected $fillable = [
		'user_id',
		'email',
		'status',
	];

    protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

    public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
