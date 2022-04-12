<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads\Advertising;
use App\Models\Ads\StateAd;
use Illuminate\Http\Request;

class StateAdController extends Controller
{
    public function updateState(){

        $this->authorize('viewAny', Advertising::class);

        $stateAd = StateAd::first();
        $stateAd->active = !$stateAd->active;
        $stateAd->save();

        return back()->with('status', __('messages.advertisements.controller.StateAd.updateState'));
    }

    public function updateAdvertisingSelected(Request $request){//StateAd $stateAd

        $request->validate([
            'selectAds' => 'required|integer|exists:advertisements,id',
        ]);

        $this->authorize('viewAny', Advertising::class);

        $stateAd = StateAd::first();
        if($stateAd->advertisements_id != $request->selectAds){
            $stateAd->advertisements_id = $request->selectAds;
            $stateAd->save();
        }

        return back()->with('status', __('messages.advertisements.controller.StateAd.updateAdvertisingSelected'));
    }
}
