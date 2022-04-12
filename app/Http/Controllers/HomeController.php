<?php

namespace App\Http\Controllers;
use App\Models\UserProfile;
use App\Models\InputLink;
use App\Models\Plan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use View;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	 
	 public function verificar()
	{
		
		 $id_user = auth()->id();
		 $user_profile = UserProfile::where('user_id', $id_user)->first(); // echo json_encode($user);
        if (!$user_profile){
			return View::make('formPaypal.index');
		}else{
			        $slug = $user_profile->slug;
					if (is_null($slug)){
					$profile = 0;
					$id_user_p=$user_profile->id;
					$cantidad = 0;
					$plan_actual =$user_profile->type_plan;
					$slug = "";
					}else{
					$profile = 1;
					$id_user_p=$user_profile->id;
					$cantidad = count(InputLink::where('user_profile_id', $id_user_p)->get());
					$plan_actual =$user_profile->type_plan;
					}
					return view('home', compact('profile', 'cantidad', 'plan_actual', 'slug', 'id_user_p'));
		}
	}
	 

	public function index()
	{
		
		
		$id_user = auth()->id();
		$user_profile = UserProfile::where('user_id', $id_user)->first();

		//echo $slug;die;

		if ($user_profile){
			$profile = 1;
			$id_user_p=$user_profile->id;				
			$plan_actual =$user_profile->type_plan;
			$cantidad = count(InputLink::where('user_profile_id', $id_user_p)->get());
			$slug = $user_profile->slug;
		} else {
			$profile = 0;
			$cantidad = 0;
			$plan_actual = "";
			$slug = "";
			$id_user_p= "";
		}
		
		/*if ($plan_actual == ""){
			return View::make('formPaypal.index');
		}*/

		
		//$url = asset('img/photo.jpg');
		//echo $url;die;
		//$path = public_path();
		//echo $path;die;
		
		return view('home', compact('profile', 'cantidad', 'plan_actual', 'slug','id_user_p'));
	}
	
	public function editProfile() 
	{
		$id_user = auth()->id();
		$user_profile = UserProfile::where('user_id', $id_user)->first();
		if ($user_profile) {
			$profile = 1;
		} else {
			$profile = 0;
		}

		$id_user = auth()->id();
		$user_profile = UserProfile::where('user_id', $id_user)->first();
		$cadena_encriptada = $user_profile->clave;
		// echo $cadena_encriptada;die;
		
		if($cadena_encriptada ==""){
			$cadenaDesencriptada = '';
		}else{
			$cadenaDesencriptada = Crypt::decryptString($cadena_encriptada);
		}

		if ($user_profile){
			$profile = 1;
		} else {
			$profile = 0;
		}
		  
		return view('userprofiles.edit', compact('profile', 'user_profile', 'cadenaDesencriptada'));
    }



}
