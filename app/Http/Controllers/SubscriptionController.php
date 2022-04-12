<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserProfile;
use App\Models\Subs_email;
use App\Models\Subs_sms;

use App\Mail\SubscriptionMailable;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->LIMIT = 20;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$type = $request->has('type') ? strtolower($request->type) : null;

        if ($type)
            return view('subscriptions.index', compact('type'));
        else
            return redirect('/home');
    }

    /*Funcion para obtener los primeros 20 registros de subscriptores segun el tipo de subscriptor */
    public function getSubscribers(Request $request)
    {
        $type_subs = strtolower($request->get('type_subs'));

        if($type_subs != 'email' && $type_subs != 'sms')
            return response()->json(['errors' => 'tipo de suscriptor no valido'], 422);

        $user_id = auth()->id();
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $user_profile_id = $user_profile->id;

        $limit = $this->LIMIT;
        $offset = $request->has('page') ? ($request->get('page')-1) * $limit : 0;
        
        if($type_subs == 'email') {
            $dataSubs = Subs_email::select('name', 'lastname', 'email', 'created_at')->where('user_profiles_id', $user_profile_id)->skip($offset)->take($limit)->get();
            $total = count (Subs_email::select('id')->where('user_profiles_id', $user_profile_id)->get());
            return response()->json(['data' => $dataSubs, 'TotalSubs' => $total], 200);
        } else {
            $dataSubs = Subs_sms::select('name', 'lastname', 'phone', 'created_at')->where('user_profiles_id', $user_profile_id)->skip($offset)->take($limit)->get();
            $total = count (Subs_sms::select('id')->where('user_profiles_id', $user_profile_id)->get());
            return response()->json(['data' => $dataSubs, 'TotalSubs' => $total], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /*Funcion para registrar los datos del subscriptor y enviar notificacion email al dueño del inputslink*/
    public function subscriptionEmail(Request $request)
	{
		$user_profiles_id = $request->get('user_profile_id');
		$name = ucfirst(strtolower($request->get('name')));
		$lastname = ucfirst(strtolower($request->get('lastname')));
		$email = strtolower($request->get('email'));
		$email_owner = $request->get('email_owner');
		
		$subscriber = Subs_email::where('user_profiles_id', $user_profiles_id)->where('email', $email)->first();
		
		if(empty($subscriber)) {
			$sub_email = new Subs_email;
			$sub_email->user_profiles_id = $user_profiles_id;
			$sub_email->name = $name;
			$sub_email->lastname = $lastname;
			$sub_email->email = $email;
			$sub_email->save();

			$userProfile = UserProfile::where('id', $user_profiles_id)->first();
			$url = url($userProfile->slug);

			$data['type_subscription'] = 'Email';
			$data['url'] = $url;
			
			$correo = new SubscriptionMailable($data);
			Mail::to($email_owner)->send($correo);
			return redirect()->back()->with('success','Mensaje enviado');
		} else {
			return redirect()->back()->with('failure','Mensaje no fue enviado');
		}
	}

    /*Funcion para registrar los datos del subscriptor y enviar notificacion email al dueño del inputslink*/
	public function subscriptionSms	(Request $request)
	{
		$user_profiles_id = $request->get('user_profile_id');
		$name = ucfirst(strtolower($request->get('name')));
		$lastname = ucfirst(strtolower($request->get('lastname')));
		$phone = $request->get('phone');
		$email_owner = $request->get('email_owner');

		$subscriber = Subs_sms::where('user_profiles_id', $user_profiles_id)->where('phone', $phone)->first();
		
		if(empty($subscriber)) {
			$sub_sms = new Subs_sms;
			$sub_sms->user_profiles_id = $user_profiles_id;
			$sub_sms->name = $name;
			$sub_sms->lastname = $lastname;
			$sub_sms->phone = $phone;
			$sub_sms->save();

			$userProfile = UserProfile::where('id', $user_profiles_id)->first();
			$url = url($userProfile->slug);

			$data['type_subscription'] = 'Sms';
			$data['url'] = $url;
			
			$correo = new SubscriptionMailable($data);
			Mail::to($email_owner)->send($correo);
			return redirect()->back()->with('success','Mensaje enviado');
		} else {
			return redirect()->back()->with('failure','Mensaje no fue enviado');
		}
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
