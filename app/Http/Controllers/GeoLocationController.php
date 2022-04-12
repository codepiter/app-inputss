<?php

namespace App\Http\Controllers;
use App\Models\InputLinkFollow;
use App\Models\GeoLocation;
use Illuminate\Http\Request;

use Stevebauman\Location\Facades\Location;

class GeoLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user_ip = $request->ip();
        $data = Location::get($user_ip);

        InputLinkFollow::create([
            'input_links_id' => $request->input('id_link'),
            'ip_visitor' => $user_ip,
            'country_name' => $data->countryName,
            'country_code' => $data->countryCode,
            'city_name' => $data->cityName
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GeoLocation  $geoLocation
     * @return \Illuminate\Http\Response
     */
    public function show(GeoLocation $geoLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeoLocation  $geoLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(GeoLocation $geoLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeoLocation  $geoLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeoLocation $geoLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeoLocation  $geoLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeoLocation $geoLocation)
    {
        //
    }
}
