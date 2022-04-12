<?php

namespace App\Http\Controllers;
use App\Models\UserProfile;
use App\Models\InputLink;
use App\Models\InputLinkFollow;

use Illuminate\Http\Request;

class StadisticsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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
        $id_user = auth()->id();
        $user_profile = UserProfile::where('user_id', $id_user)->first();

        $links = InputLink::where('user_profile_id', $user_profile->id)->get()->all();
        return view('stadistics.index', compact('user_profile', 'links'));
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

    public function getLinksData()
    {
        $user_id = auth()->id();
        $user_profile = UserProfile::select('id')->where('user_id', $user_id)->first();

        $links = InputLink::select('id', 'title', 'url', 'created_at')->where('user_profile_id', $user_profile->id)->get();
        foreach($links as $link) {
            $link->click = count(InputLinkFollow::select('id')->where('input_links_id', $link->id)->get());
        }
        return response()->json(['data' => $links], 200);
    }

    public function getDetailedDataLink(Request $request)
    {
        $link_id = $request->id_link;
        $limit = $this->LIMIT;
        $offset = $request->has('page') ? ($request->get('page')-1) * $limit : 0;

        $data = InputLinkFollow::select('country_name', 'city_name', 'created_at')->where('input_links_id', $link_id)->skip($offset)->take($limit)->get();
        $total = count(InputLinkFollow::select('id')->where('input_links_id', $link_id)->get());
        return response()->json(['data' => $data, 'TotalRecords' => $total], 200);
    }

    public function getChartDataLink(Request $request)
    {
        $link_id = $request->id_link;
        $data = InputLinkFollow::select('country_name')->where('input_links_id', $link_id)->distinct()->get();
        foreach($data as $country) {
            $country->clicks = InputLinkFollow::where('input_links_id', $link_id)->where('country_name', $country->country_name)->get()->count();
        }
        return response()->json(['data' => $data], 200);
    }
}
