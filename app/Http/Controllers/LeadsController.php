<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\ContactUser;

use Illuminate\Http\Request;

class LeadsController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        $this->LIMIT = 20;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leads.index');
    }

    /*Funcion para obtener los primeros 20 registros de leads*/
    public function getLeads(Request $request)
    {
        $user_id = auth()->id();
        $user_profile = UserProfile::where('user_id', $user_id)->first();
        $user_profile_id = $user_profile->id;

        $limit = $this->LIMIT;
        $offset = $request->has('page') ? ($request->get('page')-1) * $limit : 0;

        $dataLeads = ContactUser::select('fullname', 'email', 'phone', 'created_at')->where('user_profiles_id', $user_profile_id)->skip($offset)->take($limit)->get();
        $total = ContactUser::select('id')->where('user_profiles_id', $user_profile_id)->get()->count();
        return response()->json(['data' => $dataLeads, 'TotalLeads' => $total], 200);
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
