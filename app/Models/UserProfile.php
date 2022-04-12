<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //use HasFactory;
	protected $fillable = [
		'user_id',
		'slug', // La url que tendra su entorno donde estaran cargados todos los inputLinks
		'name',
		'description',
		'personid',
		'telefono',
		'logo',
		'background1',
		'contactame',
		'msg_giro',
		'color_fuente',
		'friend_1',
		'friend_2',
		'titulo_amigo',
		'type_plan',
		'seo',
		'color',
		'privado',
		'clave',
		'templ',
		'redirect',
		'redirect_to',
	];


	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
	
	public function inputLinks()
	{
		return $this->hasMany('App\Models\InputLink');
	}

	public function pathb() 
	{
	  //return url("/userprofiles/{$this->slug}"); //userprofiles es como lo llamas en la ruta o  web.php
	  return url("/{$this->slug}"); //userprofiles es como lo llamas en la ruta o  web.php
	}
	
	public function codigoQr()
	{
		return $this->hasOne('App\Models\CodigoQr');
	}
	
	public function customers()
	{
		return $this->hasMany('App\Models\Customer');
	}

	// Verifica que el user profiles tiene la asignación Pro.
	public function isPro(){
		return $this->type_plan == 'pro';
	}
	// Usando la relación de uno a mucho, consulta los registros con el campo premiun = 1.
	public function inputLinksPro(){
		return  $this->inputLinks()->where('is_premium', 1)->get();
	}
	// Verifica que el user profiles tenga asignación Pro, campo show_logo sea true y la dirección del logo no sea null.
	public function isProWithLogoTitle(){
		return $this->isPro() && $this->show_logo_title == true && $this->logo_title != null;
	}
}

