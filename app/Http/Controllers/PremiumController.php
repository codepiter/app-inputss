<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhiteListPremium;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\InputLink;

class PremiumController extends Controller
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
    public function index()
    {
        return view('premium.index');
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
        $user_id = auth()->id();
        $email = $request->get('email');

        if($email) {

            $exist = WhiteListPremium::select('id')->where('user_id', $user_id)->where('email', $email)->get()->count();

            if($exist)
                return response()->json(['result' => 'Error: Email ya se encuentra registrado'], 422);

            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $white_list = new WhiteListPremium;
                $white_list->user_id = $user_id;
                $white_list->email = $email;
                $white_list->save();

                return response()->json(['result' => 'Email agregado exitosamente'], 200);
            }
                
            return response()->json(['result' => 'Error: Email no posee el formato correcto'], 422);            
        }
        return response()->json(['result' => 'Error: Email no puede estar vacio'], 422);
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
        if($request->get('email')) {
            $email = filter_var($request->get('email'), FILTER_SANITIZE_EMAIL);
            $record = WhiteListPremium::find($id);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $record->email = $email;
                $record->status = $request->get('status');
                $record->save();

                return response()->json(['result' => 'Email actualizado exitosamente'], 200);
            }
            
            return response()->json(['result' => 'Error: Email no posee el formato correcto'], 422);
        }
        return response()->json(['result' => 'Error: Email no puede estar vacio'], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = WhiteListPremium::find($id);
        if($record) {
            $result = WhiteListPremium::destroy($id);
            if($result)
                return response()->json(['result' => 'Email eliminado exitosamente'], 200);
            
            return response()->json(['result' => 'Error: Email no pudo ser eliminado'], 422);
        }
        return response()->json(['result' => 'Error: Email no encontrado'], 422);
    }

    public function getListPremium(Request $request)
    {
        $user_id = auth()->id();
        $limit = $this->LIMIT;
        $offset = $request->has('page') ? ($request->get('page')-1) * $limit : 0;
        $white_list = WhiteListPremium::select('id', 'email', 'status')->where('user_id', $user_id)->skip($offset)->take($limit)->get();
        $total = WhiteListPremium::select('id')->where('user_id', $user_id)->get()->count();
        return response()->json(['data' => $white_list, 'TotalList' => $total], 200);
    }

    public function getPremiumData(Request $request)
    {
        $userprofile_id = $request->get('userprofile_id');
        $user_id = auth()->id();

        $ownerProfile = UserProfile::select('user_id')->where('id', $userprofile_id)->first();

        if($ownerProfile->user_id == $user_id) {
            //si es el dueño
            $data = InputLink::where('user_profile_id', $userprofile_id)->where('is_premium', 1)->get();
            return response()->json(['result' => $data], 200);
        } else {
            //no es el dueño se valida que este en la white list
            $user = User::select('email')->where('id', $user_id)->first();
            
            $access = WhiteListPremium::select('id')->where('user_id', $ownerProfile->user_id)->where('email', $user->email)->where('status', 1)->first();
            if($access) {
                $data = InputLink::where('user_profile_id', $userprofile_id)->where('is_premium', 1)->get();
                return response()->json(['result' => $data], 200);
            }

            return response()->json(['result' => 'No tiene permiso para acceder al contenido premium'], 422);
        }
    }
}
