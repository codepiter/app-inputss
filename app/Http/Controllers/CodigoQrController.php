<?php

namespace App\Http\Controllers;

use App\Models\CodigoQr;
use App\Models\User;
use App\Models\UserProfile;

use Illuminate\Http\Request;

use Image;

class CodigoQrController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
		$user = User::where('id', auth()->id())->first();
		$id_user_p = $user->userProfile->id;
		
		$user_profile = UserProfile::where('id', $id_user_p)->first();
		
		$url = "https://app.inputslink.com/".$user_profile->slug;
		//echo $url;die;
		
		$cod = CodigoQr::where('user_profile_id', $id_user_p)->first();
		if ($cod){
			$qr = 1;
		} else {
			$qr = 0;
			$cod = "";
		}

       return view('codigoqrs.index', compact('qr','cod', 'url'));
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
		/*******************************************************************************/
        if ($request->file('image')== null) {
			$image="";
		} else {
			$img1 = Image::make($request->file('image')->getRealPath());
			$img1->orientate();

			$file_image = "image" . time() . "." . $request->file('image')->extension();
			
			$img1->save(storage_path('/app/public/uploads/' . $file_image));
			//$img1->save(public_path('/app/public/uploads/' . $file_image));

			$image= $x['image']= "".$file_image;//nombre con que se guarda en la base de datos.
		}

		$user = User::where('id', auth()->id())->first();
		$id_user_p = $user->userProfile->id;
		/*******************************************************************************/
		
		$request->validate([
			//'url' => 'required',
			'typedots' => 'required',
			'width' => 'required',
			'height' => 'required',
			'background' => 'required',
			'color' => 'required',
		]);

		/***************************************************************/
		$user_profile = UserProfile::where('id', $id_user_p)->first();
		$remplazo_vacio = "https://app.inputslink.com/".$user_profile->slug;
			
		if ($request->get('url')==""){
			//echo "Usted mandó una url vacía" ;die;
			$url = $remplazo_vacio;
		} else {
			$url = $request->get('url');
		}
		/***************************************************************/
        //UserProfile::create($request->all());
		$data = new CodigoQr([
        	'user_profile_id' => $id_user_p,
            'image' => $image,
			'url' => $url,
			'typedots' => $request->get('typedots'),
			'width' => $request->get('width'),
			'height' => $request->get('height'),
			'background' => $request->get('background'),
			'color' => $request->get('color'),
        ]);

		$data->save();
        return redirect()->back()->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CodigoQr  $codigoQr
     * @return \Illuminate\Http\Response
     */
    public function show(CodigoQr $codigoQr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CodigoQr  $codigoQr
     * @return \Illuminate\Http\Response
     */
    public function edit(CodigoQr $codigoQr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CodigoQr  $codigoQr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {    
		$codigoQr = CodigoQr::where('id',$request->get('id_qr'))->first();
	
		/*************************************************************************/
		if ($request->file('image')== null) {
			if ($request->file('imageUp')== 0 ){
				$image = "";
			} else {
				$image=$codigoQr->image;
			}	
		} else {
			$img1 = Image::make($request->file('image')->getRealPath());
			$img1->orientate();

			$file_image = "image" . time() . "." . $request->file('image')->extension();
			
			$img1->save(storage_path('/app/public/uploads/' . $file_image));
			//$img1->save(public_path('/app/public/uploads/' . $file_image));

			$image= $x['image']= "".$file_image;//nombre con que se guarda en la base de datos.
		}
		/***************************************************************/
		$user = User::where('id', auth()->id())->first();
		$id_user_p = $user->userProfile->id;
			
		$user_profile = UserProfile::where('id', $id_user_p)->first();
		$remplazo_vacio = "https://app.inputslink.com/".$user_profile->slug;
			
		if ($request->get('url')==""){
			//echo "Usted mandó una url vacía" ;die;
			$url = $remplazo_vacio;
		} else {
			$url = $request->get('url');
		}
		/***************************************************************/
		
		$codigoQr->update([
			'image' => $image,
			'url' => $url,
			'typedots' => $request->get('typedots'),
			'width' => $request->get('width'),
			'height' => $request->get('height'),
			'background' => $request->get('background'),
			'color' => $request->get('color'),
		]);

		return redirect()->back()->with('success', 'Contact saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CodigoQr  $codigoQr
     * @return \Illuminate\Http\Response
     */
    public function destroy(CodigoQr $codigoQr)
    {
        //
    }
}
