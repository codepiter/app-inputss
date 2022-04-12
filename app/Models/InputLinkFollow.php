<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputLinkFollow extends Model
{
    //use HasFactory;
	protected $table = "input_link_follows";
	
	protected $fillable = [
		'input_links_id',
		'ip_visitor',
		'country_name',
		'country_code',
		'city_name',
	];

	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

	public function inputlink()
	{
		return $this->belongsTo('App\Models\InputLink');
	}
}
