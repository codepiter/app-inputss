<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
//class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       // 'name',
        'email',
        'password',
        'nimda_si',

        // Asignación del tipo de usuario.
        'user_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function userProfile()
	{
		return $this->hasOne('App\Models\UserProfile');
	}
	
	public function Payments()
	{
		return $this->hasOne('App\Models\Payment');
	}

    public function WhiteListPremium()
    {
        return $this->hasOne('App\Models\WhiteListPremium');
    }

    public function isAdmin(){
        //return \Auth::user()->user_type_id == 1;
        return $this->user_type_id == 1;
    }

    public function typeUser(){
        return $this->belongsTo('App\Models\UserType', 'user_type_id');
    }
}
