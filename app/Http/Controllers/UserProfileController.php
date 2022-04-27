<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\InputLink;
use App\Models\CodigoQr;
use App\Models\User;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\ContactUser;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
//use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Image;
use JeroenDesloovere\VCard\VCard;

use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;



class UserProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth')->except(['show', 'sendemail']);
    }
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//echo auth::user()->nimda_si;die;
		$id_user = auth()->id();
		$user_profile = UserProfile::where('user_id', $id_user)->first();
		
		if(auth::user()->nimda_si==1){
			$userprofiles = UserProfile::latest()->simplePaginate(8);
        	return view('userprofiles.index', compact('userprofiles'))
            	->with('i', (request()->input('page', 1) - 1) * 5);
		} else {
			$message = "acceso denegado";
			echo json_encode($message);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userprofiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //public function store(Request $request, $id)
    {
		/*primero Debemos consultar la tabla UserProfile y ver que no existaan datos repetidos en slug*/
		
		$slug = $request->get('slug');
		if ($slug == "") {
			return redirect()->back()->with('varsesion', 'La Url Esta vacía');
		}
		
		$url_link = UserProfile::where('slug', "inputslink-".$slug)->first();
		if ($url_link) {
			return redirect()->back()->with('varsesion', 'Este Nombre de url ya ha sido tomado');
		}
/*******************************************************************************/
		if ($request->file('logo')== null) {

			if($request->get('logo-pre') != "") {
				$pre=$request->get('logo-pre');
				$logo= "uploads/webs/".$pre;
			} else {
				$logo="";
			}
		} else {
			$img1 = Image::make($request->file('logo')->getRealPath());
			if($img1->width() > $img1->height()) {
				$img1->resize(300, null, function($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				   });
				$img1->orientate();
				$file_logo = "logo" . time() . ".jpg";
				$img1->save(storage_path('/app/public/uploads/' . $file_logo));
				$logo= $x['logo']= "".$file_logo;//nombre con que se guarda en la base de datos.
			} else {
				$img1->resize(null, 300, function($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				   });
				$img1->orientate();
				$file_logo = "logo" . time() . ".jpg";
				$img1->save(storage_path('/app/public/uploads/' . $file_logo));
				$logo= $x['logo']= "".$file_logo;//nombre con que se guarda en la base de datos.
			}
		}
/*******************************************************************************/
		if ($request->file('background1')== null) {

			if($request->get('background1-pre') != ""){
				$pre=$request->get('background1-pre');

				$background1= "uploads/webs/".$pre;
			} else {
				$background1="";
			}
		} else {

			$img2 = Image::make($request->file('background1')->getRealPath());
			$img2->orientate();

			$file_back = "background1" . time() . "." . $request->file('background1')->extension();
			
			$img2->save(storage_path('/app/public/uploads/' . $file_back));
			//$img2->save(public_path('/app/public/uploads/' . $file_back));

			$background1= $x['background1']= "".$file_back;//nombre con que se guarda en la base de datos.
		}
/*******************************************************************************/
		
        $request->validate([
        	'slug' => 'required',
        	// 'name' => 'required',
            //'description' => 'required',
            //'personid' => 'required',
        	// 'telefono' => 'required',
            //'logo' => 'required',
		]);

        //borrar este comentario
        $nom_slug = $request->get('slug');
		$slug = Str :: slug ($nom_slug);

        //UserProfile::create($request->all());
		$data = new UserProfile([
        	'user_id' => auth()->id(),
            'slug' => "inputslink-".$slug,
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'personid' => $request->get('personid'),
            'telefono' => $request->get('telefono'),
            'friend_1' => $request->get('friend_1'),
            'friend_2' => $request->get('friend_2'),
            'titulo_amigo' => 'AMIGO FIEL',
			'seo' => $request->get('seo'),
			'color' => $request->get('color'),
            'logo' => $logo,
            'background1' => $background1,
        ]);
		$data->save();
	
        return redirect()->back()->with('success', 'Contact saved!');
	 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userprofile)
    {
		//Consulta de status de publicidad
		$status_ad = \App\Models\Ads\StateAd::first();

		//echo $userprofile->type_plan;die;
		$template = $userprofile->templ;
		// $nombreRuta = Route::currentRouteName();
		// echo($nombreRuta);die;

		$id_user = auth()->id() ? auth()->id() : 0;

		if($id_user != $userprofile->user_id && $userprofile->redirect)
			return redirect()->away($userprofile->redirect_to);
		
		$id_user_p = $userprofile->id;
		
		$friend1 = $userprofile->friend_1;
		$friend2 = $userprofile->friend_2;		
		$img_f1="";
		$img_f2="";
		if($friend1){
			$path = parse_url($friend1, PHP_URL_PATH);
			$segments = explode('/', rtrim($path, '/'));
			$slug = end($segments);
		
			$f1 = UserProfile::where('slug', $slug)->first();
			if($f1){
				$img_f1 =$f1->logo;
			}
		}
			
		if($friend2){
			$path2 = parse_url($friend2, PHP_URL_PATH);
			$segments2 = explode('/', rtrim($path2, '/'));
			$slug2 = end($segments2);
		
			$f2 = UserProfile::where('slug', $slug2)->first();

			if($f2){
				$img_f2 =$f2->logo;
			}
		}
		
		$data = CodigoQr::where('user_profile_id', $id_user_p)->first();
		$inputlinks = InputLink::where('user_profile_id', $id_user_p)->where('is_premium', 0)->orderBy('position')->get();
		
		if($userprofile->privado == "on" AND $template != '1'){
				
//echo "privado on y template NO ES 1";die;
			
			return view('userprofiles.show', compact('userprofile','inputlinks', 'data', 'img_f1', 'img_f2', 'id_user', 'template', 'status_ad'))->with('private', 'on');

		}
		
		//if($userprofile->privado != "on" AND is_null($template)){
		if($userprofile->privado != "on" AND $template=='2'){

//echo "privado NO ES ON probablemete ES NULL y template si que es NULL";die;
//echo "privado NO ES ON probablemete ES NULL y template es 2";die;
			
			return view('userprofiles.show', compact('userprofile','inputlinks', 'data', 'img_f1', 'img_f2', 'id_user', 'template', 'status_ad'));
		}
		
		if($userprofile->privado == "on" AND $template=='1'){

//echo "privado ES ON y template ES 1";die;
			
			return view('userprofiles.templ', compact('userprofile','inputlinks', 'data', 'img_f1', 'img_f2', 'id_user', 'template', 'status_ad'))->with('private', 'on');
		}
		
		if($userprofile->privado != "on" AND $template=='1'){

//echo "privado NO ES ON probablemete ES NULL y template ES 1";die;
			
			return view('userprofiles.templ', compact('userprofile','inputlinks', 'data', 'img_f1', 'img_f2', 'id_user', 'template', 'status_ad'));
	
		}
		
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProfile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userprofile)
    {	
		//echo $userprofile->id; die;
        return view('userprofiles.edit', compact('userprofile'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
   // public function update(Request $request, UserProfile $userprofile)
	public function update(Request $request, $id)
    {
		
		if(Auth::user()->userProfile->type_plan == "pro"){
			$request->validate([
			   'logo' =>  'mimes:png,jpg,gif,jpeg|max:1000',
			   'background1' =>  'mimes:png,jpg,gif,jpeg|max:2000',
			   'show_log' => 'boolean',
			]);
		}else{
			$request->validate([
			   'logo' =>  'mimes:png,jpg,jpeg|max:1000',
			   'background1' =>  'mimes:png,jpg,jpeg|max:2000',
			]);
		}
		$user_profile = UserProfile::findOrFail($id);
		$slug = $request->slug;

		$UserProf = UserProfile::where('slug', '=', $slug)->where('id', '!=' , $id)->first();
		if ($UserProf === null) {
		   //echo "user doesn't exist";die;
/**********************************************************************************/
		if ($request->hasFile('logo')) {

			if ($request->file('logo')->extension() == 'gif') {
				$name_logo =  "logo" . time() . "." . $request->file('logo')->extension();
				$request->file('logo')->storeAs('public/uploads', $name_logo);
				$userProfile['logo'] =  $name_logo;
			} else {
				$imgUpdate = Image::make($request->file('logo')->getRealPath());
				if($imgUpdate->width() > $imgUpdate->height()) {
					$imgUpdate->resize(300, null, function($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
				} else {
					$imgUpdate->resize(null, 300, function($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
				}
				$imgUpdate->orientate();
				$file_logo = "logo".time().'.jpg';
	
				$imgUpdate->save(storage_path('app/public/uploads/'.$file_logo));
				$userProfile['logo'] = $file_logo;
			}

			if(File::exists(storage_path('app/public/uploads/'.$user_profile->logo))) {
				if(!strpos($user_profile->logo, '/'))
					File::delete(storage_path('app/public/uploads/'.$user_profile->logo));
			} 
			
        } else {
			if($request->get('logo-pre') != "") {
				if(File::exists(storage_path('app/public/uploads/'.$user_profile->logo))) {
					if(!strpos($user_profile->logo, '/'))
						File::delete(storage_path('app/public/uploads/'.$user_profile->logo));
				}

				$pre=$request->get('logo-pre');
				$userProfile['logo']= "rrss/".$pre;
			}
		}
/**********************************************************************************/
// Funcion para almacenar la imagen de logo title
if ($request->hasFile('logo_title')) {

	if ($request->file('logo_title')->extension() == 'gif') {
		$name_logo_title =  "logo_title" . time() . "." . $request->file('logo_title')->extension();
		$request->file('logo_title')->storeAs('public/uploads/logos_title', $name_logo_title);
		$userProfile['logo_title'] =  'logos_title/'.$name_logo_title;
	} else {
		$imgUpdate = Image::make($request->file('logo_title')->getRealPath());
		if($imgUpdate->width() > $imgUpdate->height()) {
			$imgUpdate->resize(300, null, function($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
		} else {
			$imgUpdate->resize(null, 300, function($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
		}
		$imgUpdate->orientate();
		$file_logo_title = "logo_title".time().'.jpg';

		$imgUpdate->save(storage_path('/app/public/uploads/logos_title/'.$file_logo_title));
		$userProfile['logo_title'] = 'logos_title/'.$file_logo_title;
	}

	if(File::exists(storage_path('/app/public/uploads/logos_title/'.$user_profile->logo_title))) {
		if(!strpos($user_profile->logo_title, '/'))
			File::delete(storage_path('/app/public/uploads/logos_title/'.$user_profile->logo_title));
	} 
	
} else {
	if($request->get('logo_title-pre') != "") {
		if(File::exists(storage_path('/app/public/uploads/logos_title/'.$user_profile->logo_title))) {
			if(!strpos($user_profile->logo_title, '/'))
				File::delete(storage_path('/app/public/uploads/logos_title/'.$user_profile->logo_title));
		}

		$pre=$request->get('logo_title-pre');
		$userProfile['logo_title']= "rrss/".$pre;
	}
}		
/**************************************************************************/
		if ($request->hasFile('background1')) {
			
			if ($request->file('background1')->extension() == 'gif') {
				$name_back =  "back" . time() . "." . $request->file('background1')->extension();
				$request->file('background1')->storeAs('public/uploads', $name_back);
				$userProfile['background1'] =  $name_back;
			} else {
				$imgUpdate = Image::make($request->file('background1')->getRealPath());
				if($imgUpdate->width() > $imgUpdate->height()) {
					$imgUpdate->resize(1920, null, function($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
				} else {
					$imgUpdate->resize(null, 1080, function($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
				}
				$imgUpdate->orientate();
				$name_back = "back".time().'jpg';
	
				$imgUpdate->save(storage_path('/app/public/uploads/'.$name_back));
				$userProfile['background1'] = $name_back;
			}

			if(File::exists(storage_path('/app/public/uploads/'.$user_profile->background1))) {
				if(!strpos($user_profile->background1, '/'))
					File::delete(storage_path('/app/public/uploads/'.$user_profile->background1));
			}

        } else {
			if($request->get('back-pre') != "") {
				if(File::exists(storage_path('/app/public/uploads/'.$user_profile->background1))) {
					if(!strpos($user_profile->background1, '/'))
						File::delete(storage_path('/app/public/uploads/'.$user_profile->background1));
				}
				$pre=$request->get('back-pre');
				$userProfile['background1']= "background/".$pre;
			}
		}
/**************************************************************************/
	// Verifica usuario Pro y el campo show_logo
	if ($user_profile->isPro()) {
		if ($user_profile->show_logo_title == false && !isset($request['show_logo_title'])) {
			//'false y false, no hago nada';
		} else if ($user_profile->show_logo_title == false && isset($request['show_logo_title'])) {
			$userProfile['show_logo_title'] = true;
			//'false y true, actualizo a mostrar logo';
		} elseif ($user_profile->show_logo_title == true && !isset($request['show_logo_title'])){
			$userProfile['show_logo_title'] = false;
			//'true y false, actualizco a ocultar logo';
		}else if ($user_profile->show_logo_title == true && isset($request['show_logo_title'])) {
			//'true y true, no hago nada';
		}
	}
/**************************************************************************/

		$nom_slug = $request->slug;
		$slug = Str :: slug ($nom_slug);
		$cadenaEncriptada = Crypt::encryptString($request->clave);

		$userProfile['slug']= $slug == '' ? $user_profile->slug : $slug;
		$userProfile['name']= $request->name;
		$userProfile['description']= $request->description;
		$userProfile['personid']= $request->personid;
		$userProfile['telefono']= $request->telefono;
		$userProfile['contactame']= $request->contactame;
		$userProfile['msg_giro']= $request->msg_giro;
		$userProfile['color_fuente']= $request->color_fuente ? $request->color_fuente : "#ffffff";
		$userProfile['friend_1']= $request->friend_1;
		$userProfile['friend_2']= $request->friend_2;
		$userProfile['titulo_amigo']= $request->titulo_amigo;
		$userProfile['seo']= $request->seo;
		$userProfile['color']= $request->color;
		$userProfile['privado']= $request->privado;
		$userProfile['clave']= $cadenaEncriptada;
		$userProfile['templ']= $request->templ ? $request->templ: 2;
		
		$userProfile['redirect'] = $request->redirect ? 1 : 0;
		$userProfile['redirect_to'] = $request->redirect_to;
		$userProfile['subs_email'] = $request->subs_email ? 1 : 0;
		$userProfile['title_subs_email'] = $request->title_subs_email;
		$userProfile['subtitle_subs_email'] = $request->subtitle_subs_email;
		$userProfile['subs_sms'] = $request->subs_sms ? 1 : 0;
		$userProfile['title_subs_sms'] = $request->title_subs_sms;
		$userProfile['subtitle_subs_sms'] = $request->subtitle_subs_sms;

		UserProfile::where('id','=',$id)->update($userProfile);
		
        return redirect()->back()->with('success', 'Profile update!');
	}else{
		 //echo "user exist";die;
		 return redirect()->back()->with('varsesion', 'Este Nombre de url ya existe');
	}

    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userprofile)
    {
        $userprofile->delete();

        return redirect()->route('userprofiles.index')
            ->with('success', 'UserProfile deleted successfully');
    }

	public function sendemail(Request $request){
		$user_profiles_id = $request->get('user_profile_id');
		$fullname = ucfirst(strtolower($request->get('name'))).' '.ucfirst(strtolower($request->get('lastname')));
		$email = strtolower($request->get('email'));
		$phone = $request->get('phone');
		$email_owner = $request->get('email_owner');

		$contact = ContactUser::where('user_profiles_id', $user_profiles_id)->where('email', $email)->first();

		if(empty($contact)) {
			$contact = new ContactUser;
			$contact->user_profiles_id = $user_profiles_id;
			$contact->fullname = $fullname;
			$contact->email = $email;
			$contact->phone = $phone;
			$contact->save();

			$userProfile = UserProfile::where('id', $user_profiles_id)->first();
			$url = url($userProfile->slug);

			$data['fullname'] = $fullname;
			$data['email'] = $email;
			$data['phone'] = $phone;
			$data['url'] = $url;
			
			$correo = new ContactanosMailable($data);
			Mail::to($email_owner)->send($correo);
			return redirect()->back()->with('success','Mensaje enviado');
		} else {
			return redirect()->back()->with('failure','Mensaje no fue enviado');
		}
	}

	public function vcard($id){

	    $userProfile = UserProfile::where('id', $id)->first();
        $id_user = $userProfile->user_id;
		$user = User::where('id', $id_user)->first();
		$email= $user->email;

		$vcard = new VCard();
		// define variables
        $additional = '';
		$prefix = '';
		$suffix = '';
		$name = $userProfile->name;
		$description = $userProfile->description;
		$personid = $userProfile->personid;
		$telefono = $userProfile->telefono;

		$vcard->addName($name);
		$vcard->addRole($description);
		$vcard->addEmail($email);//este no lo tengo en la tabla personal_information
		$vcard->addPhoneNumber($telefono, 'PREF;WORK');

		//$vcard->addURL($website);
		return $vcard->download();		
	} 
	 
	public function insertTypePlan(Request $request){
		
	
		$id_user = auth()->id();
		
			$data = new UserProfile([
        	'user_id' => auth()->id(),
            'type_plan' => $request->get('type_plan'),
            'templ' => (($request->get('type_plan')) == "free" ) ? 2 : 1,
          
        ]);
		$data->save();
		
		if(($request->get('type_plan')) != "free" ){
			$payment = new Payment([
				'user_id' => auth()->id(),
				'amount' => $request->get('amount'),
				'payment_mode' => 'paypal',
				'type_card' => $request->get('id_subscription'),
			]);
			$payment->save();
			
		}	
					return response()->json([
				'success' => 'Create successfully!'
			]);
	}
	
	public function updateTypePlan(Request $request){
		
		$id_user = auth()->id();
		$user_profile = UserProfile::where('user_id', $id_user)->first();
		
		$user_profile->update([
			'type_plan' => $request->get('type_plan'),			
		]);
			
		$payment = new Payment([
            'user_id' => auth()->id(),
            'amount' => $request->get('amount'),
            'payment_mode' => 'paypal',
            'type_card' => $request->get('id_subscription'),
        ]);
		$payment->save();
		
		return response()->json([
			'success' => 'Update successfully!'
		]);
	}
	
	public function verifyPrivate(Request $request){
		
		$email=$request->email;
		$password= $request->password;
		
		$id_up=$request->id_up;
		
		$customer = Customer::where('email', $email)->first();
		if($customer){
			$userprofile = UserProfile::where('id', $id_up)->first();
		
			$pass=$userprofile->clave;
				
			$pass_d = Crypt::decryptString($pass);	
			
			if($password == $pass_d){
				
				$coincide = "1";
				$id_user = auth()->id();

				if($id_user != $userprofile->user_id && $userprofile->redirect)
					return redirect()->away($userprofile->redirect_to);
		
				$id_user_p = $userprofile->id;
				
				$friend1 = $userprofile->friend_1;
				$friend2 = $userprofile->friend_2;		
				$img_f1="";
				$img_f2="";
				if($friend1){
					$path = parse_url($friend1, PHP_URL_PATH);
					$segments = explode('/', rtrim($path, '/'));
					$slug = end($segments);
				
					$f1 = UserProfile::where('slug', $slug)->first();
					if($f1){
						$img_f1 =$f1->logo;
					}
				}
					
				if($friend2){
					$path2 = parse_url($friend2, PHP_URL_PATH);
					$segments2 = explode('/', rtrim($path2, '/'));
					$slug2 = end($segments2);
				
					$f2 = UserProfile::where('slug', $slug2)->first();
					if($f2){
						$img_f2 =$f2->logo;
					}
				}
				
				$data = CodigoQr::where('user_profile_id', $id_user_p)->first();
				$inputlinks = InputLink::where('user_profile_id', $id_user_p)->orderBy('position')->get();
			

				$coincide = "1";
			}else{
				$coincide = "0";
			}
			
			
		}else{
			$coincide = "0";
		}
		
		return response()->json($coincide);
	}

	public function searchUsers($search){
		$usersProfiles = UserProfile::where('name', 'like', '%'.$search.'%')
			->orWhere('slug', 'like', '%'.$search.'%')
			->orWhere('type_plan', 'like', '%'.$search.'%')
			->get(['id', 'logo', 'slug', 'name', 'type_plan']);
		return json_encode($usersProfiles);
	}
	public function searchUserAll(){
		$usersProfiles = UserProfile::all(['id', 'logo', 'slug', 'name', 'type_plan']);
		return json_encode($usersProfiles);
	}
}
