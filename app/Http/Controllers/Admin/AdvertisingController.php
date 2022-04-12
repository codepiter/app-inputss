<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads\Advertising;
use Illuminate\Http\Request;
use App\Models\Ads\StateAd;

class AdvertisingController extends Controller
{    
    public function __construct()
    {
        //$this->authorize('view');
        $this->authorizeResource(Advertising::class, 'advertising');
    }

    public function index()
    {
        $status_ad = StateAd::first();
        $advertisementsSelect = Advertising::all();
        $advertisements = Advertising::paginate();

        return view('inputlinks.advertising.index', compact('status_ad', 'advertisements', 'advertisementsSelect'));
    }

    
    public function create()
    {
        return view('inputlinks.advertising.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'advertising' => 'required|min:2|max:100||unique:App\Models\Ads\Advertising,advertising',
            'head' => 'required|min:2|max:300',
            'block' => 'present|nullable|min:2|max:2000',
            'horizontal' => 'present|nullable|min:2|max:2000',
            'vertical' => 'present|nullable|min:2|max:2000',
        ]);

        $ad = Advertising::create($request->all());

        return redirect()->route('admin.ads.index')->with('status',__('messages.advertisements.controller.StateAd.store'));
    }

    
    /*public function show($id)
    {
        //
    }*/

    
    public function edit(Advertising $advertising)
    {
        return view('inputlinks.advertising.edit', compact('advertising'));
    }

   
    public function update(Request $request, Advertising $advertising)
    {
        $request->validate([
            'advertising' => 'required|min:2|max:100|unique:App\Models\Ads\Advertising,advertising,'. $advertising->id,
            //unique:App\Models\Ads\Advertising,advertising
            'head' => 'required|min:2|max:300',
            'block' => 'present|nullable|min:2|max:2000',
            'horizontal' => 'present|nullable|min:2|max:2000',
            'vertical' => 'present|nullable|min:2|max:2000',
        ]);


        $advertising->update($request->all());

        return back()->with('status',__('messages.advertisements.controller.StateAd.update'));
    }

    
    public function destroy(Advertising $advertising)
    {
        $status_ad = StateAd::find(1);
        $msj = '.';
        if($status_ad->advertisements_id == $advertising->id){
            $status_ad->advertisements_id = 1;
            $status_ad->save();
            $msj = __('messages.advertisements.controller.StateAd.destroy2');
        }
        
        $advertising->delete();/**/

        return back()->with('status', __('messages.advertisements.controller.StateAd.destroy1').$msj);
    }
}
