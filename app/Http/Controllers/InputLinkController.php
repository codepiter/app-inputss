<?php

namespace App\Http\Controllers;

use App\Models\InputLink;
use App\Models\User;
use App\Models\UserProfile;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Image;
use Auth;

class InputLinkController extends Controller
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
        $id_user = auth()->id();
		$user = User::find($id_user);
		$id_user_p = $user->userProfile->id;
		$plan = $user->userProfile->type_plan;
		
		$url_link = InputLink::where('user_profile_id', $id_user_p)->first();
		if ($url_link){
			$link = 1;
			$cant =InputLink::where('user_profile_id', $id_user_p)->get();
		} else {
			$link = 0;
			$cant = 0;
		}

	    $inputlinks = InputLink::where('user_profile_id', $id_user_p)->orderBy('position')->latest()->get();
        
        return view('inputlinks.index',compact('inputlinks', 'link', 'url_link','cant', 'plan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_user = auth()->id();
		$user_profile = UserProfile::where('user_id', $id_user)->first();
		$slug = $user_profile->slug;
		
		$user = User::find($id_user);
		$id_user_p = $user->userProfile->id;
		$plan = $user->userProfile->type_plan;
		
		$links = InputLink::where('user_profile_id', $id_user_p)->get();

		$type = $request->has('type') ? strtolower($request->type) : null;
		
		if($links){
			if ($plan == "free"){
				$cant = count($links);
				if($cant >= 12){
					return redirect()->back();
				}else{
					//return view('inputlinks.create');
					if ($type == 'video')
						return view('inputlinks.createVideo', compact('slug'));
					else if ($type == 'image')
						return view('inputlinks.createImage', compact('slug'));
					else
						return view('inputlinks.create', compact('slug'));
				}
			}else{
				//return view('inputlinks.create');
				if ($type == 'video')
					return view('inputlinks.createVideo', compact('slug'));
				else if ($type == 'image')
					return view('inputlinks.createImage', compact('slug'));
				else
					return view('inputlinks.create', compact('slug'));
			}
		
		}else{
			//return view('inputlinks.create');
			if ($type == 'video')
				return view('inputlinks.createVideo', compact('slug'));
			else if ($type == 'image')
				return view('inputlinks.createImage', compact('slug'));
			else
				return view('inputlinks.create', compact('slug'));
		}  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if(Auth::user()->userProfile->type_plan == "pro"){
			$request->validate([
			   'logo' =>  'mimes:png,jpg,gif,jpeg|max:1000',
			]);
		}else{
			$request->validate([
			   'logo' =>  'mimes:png,jpg,jpeg|max:1000',	   
			]);
		}
		
		$requestData = $request->all();
		
		if ($request->hasFile('logo')) {

			if ($request->file('logo')->extension() == 'gif') {
				$name_logo =  "logo" . time() . "." . $request->file('logo')->extension();
				$request->file('logo')->storeAs('public/uploads', $name_logo);
				$requestData['logo']= $name_logo;
			} else {
				$imgStore = Image::make($request->file('logo')->getRealPath());
				if($imgStore->width() > $imgStore->height()) {
					$imgStore->resize(88, null, function($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
				} else {
					$imgStore->resize(null, 88, function($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
				}
				$imgStore->orientate();
				$name_logo = "logo".time().'jpg';
	
				$imgStore->save(storage_path('/app/public/uploads/'.$name_logo));
				$requestData['logo']= $name_logo;
			}
        } else {
			if($request->get('logo-pre') != "") {
				$pre=$request->get('logo-pre');
				$requestData['logo']= "rrss/".$pre;
			}
		}
		  
		if ($request->hasFile('img_comercial')) {
			if ($request->file('img_comercial')->extension() == 'gif') {
				$name_img =  "img_com" . time() . "." . $request->file('img_comercial')->extension();
				$request->file('img_comercial')->storeAs('public/uploads', $name_img);
				$requestData['img_comercial']= $name_img;
			} else {
				$imgComercialStore = Image::make($request->file('img_comercial')->getRealPath());

				$imgComercialStore->resize(425, null, function($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				});

				$imgComercialStore->orientate();
				$name_img = "img_com".time().'jpg';
				$imgComercialStore->save(storage_path('/app/public/uploads/'.$name_img));
				$requestData['img_comercial']= $name_img;
			}
        }

		$requestData['user_profile_id'] = Auth::user()->userProfile->id; 		
			
		InputLink::create($requestData);
		/* $inputs = InputLink::create([
			'user_profile_id' =>  Auth::user()->userProfile->id,
			'logo' => $requestData['logo']= $name_logo,
			
			'url' => $requestData['url'],
		    'video' => $requestData ['video'],
            'music' => $requestData['music'],
            'title' => $requestData['title'],
            'subtitle' => $requestData['subtitle'],
			
			'position' => $request->get('position'),
			'comercial' => $request->get('comercial'),
			'url_comercial' => $request->get('url_comercial'),
			
		 ]);*/
		
		return redirect()->back()->with('success', 'InputLink Creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InputLink  $inputLink
     * @return \Illuminate\Http\Response
     */
    public function show(InputLink $inputLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InputLink  $inputLink
     * @return \Illuminate\Http\Response
     */
   // public function edit(InputLink $inputLink) //esta funcion no me funciono asi como esta
    public function edit(Request $request, $id) //el id
    {
		$data = InputLink::where('id', $id)->first();

		if ($data->comercial == 'on')
			return view('inputlinks.editVideo', compact('id','data'));
		else if ($data->comercial2 == 'on')
			return view('inputlinks.editImage', compact('id','data'));
		else
			return view('inputlinks.edit', compact('id','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InputLink  $inputLink
     * @return \Illuminate\Http\Response
     */
   // public function update(Request $request, InputLink $inputLink)
    public function update(Request $request, $id)
    {
		if(Auth::user()->userProfile->type_plan == "pro"){
			$request->validate([
			   'logo' =>  'mimes:png,jpg,gif,jpeg|max:1000',	   
			]);
		}else{
			$request->validate([
			   'logo' =>  'mimes:png,jpg,jpeg|max:1000',	   
			]);
		}	

		$inputLink = InputLink::findOrFail($id);
		$input_link =  $request->except(['_token', '_method', 'com', 'com2', 'logo-pre']);
		
		if($request->has('video')) {
			if($input_link['video'] != null) {
				$input_link['logo'] = null;
			} else {
				
				if($input_link['url']== null) {
					return redirect()->back()->with('failure', 'Ingrese una url para crear el enlace');
				}
	
				if ($request->hasFile('logo')) {
	
					if ($request->file('logo')->extension() == 'gif') {
						$name_logo =  "logo" . time() . "." . $request->file('logo')->extension();
						$request->file('logo')->storeAs('public/uploads', $name_logo);
						$input_link['logo'] =  $name_logo;
					} else {
						$imgUpdate = Image::make($request->file('logo')->getRealPath());
						if($imgUpdate->width() > $imgUpdate->height()) {
							$imgUpdate->resize(88, null, function($constraint) {
								$constraint->aspectRatio();
								$constraint->upsize();
							});
						} else {
							$imgUpdate->resize(null, 88, function($constraint) {
								$constraint->aspectRatio();
								$constraint->upsize();
							});
						}
						$imgUpdate->orientate();
						$name_logo = "logo".time().'jpg';
			
						$imgUpdate->save(storage_path('/app/public/uploads/'.$name_logo));
						$input_link['logo'] = $name_logo;
					}
	
					if(File::exists(storage_path('/app/public/uploads/'.$inputLink->logo))) {
						if(!strpos($inputLink->logo, '/'))
							File::delete(storage_path('/app/public/uploads/'.$inputLink->logo));
					}
	
				} else {
					if($request->get('logo-pre') != ""){
						$pre=$request->get('logo-pre');
						$input_link['logo']= "rrss/".$pre;
					}
				}
			}
		}
		
		if ($request->hasFile('img_comercial')) {
			if ($request->file('img_comercial')->extension() == 'gif') {
				$name_img =  "img_com" . time() . "." . $request->file('img_comercial')->extension();
				$request->file('img_comercial')->storeAs('public/uploads', $name_img);
				$input_link['img_comercial']= $name_img;
			} else {
				$imgComercialUpdate = Image::make($request->file('img_comercial')->getRealPath());

				$imgComercialUpdate->resize(425, null, function($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				});

				$imgComercialUpdate->orientate();
				$name_img = "img_com".time().'jpg';
				$imgComercialUpdate->save(storage_path('/app/public/uploads/'.$name_img));
				$input_link['img_comercial']= $name_img;
			}

			if(File::exists(storage_path('/app/public/uploads/'.$inputLink->img_comercial))) {
				if(!strpos($inputLink->img_comercial, '/'))
					File::delete(storage_path('/app/public/uploads/'.$inputLink->img_comercial));
			}
        }
		if(!$request->get('expanded')){
			$input_link['expanded']= "";
		}
		InputLink::where('id','=',$id)->update($input_link);

        return redirect()->back()->with('success', 'Profile update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InputLink  $inputLink
     * @return \Illuminate\Http\Response
     */
   // public function destroy(InputLink $inputLink)
    public function destroy ($id)
    {
		$inputlink = InputLink::findOrFail($id);
		if(File::exists(storage_path('/app/public/uploads/'.$inputlink->logo))) {
			if(!strpos($inputlink->logo, '/'))
				File::delete(storage_path('/app/public/uploads/'.$inputlink->logo));
		}

		if(File::exists(storage_path('/app/public/uploads/'.$inputlink->img_comercial))) {
			if(!strpos($inputlink->img_comercial, '/'))
				File::delete(storage_path('/app/public/uploads/'.$inputlink->img_comercial));
		}

		InputLink::destroy($id);
		return response()->json(['success' => 'Record deleted successfully!']);    
	}

	public function sortable(Request $request)
    {
		$inputs = InputLink::all();

        foreach ($inputs as $inp) {
            foreach ($request->position as $position) {
                if ($position['id'] == $inp->id) {
                    $inp->update(['position' => $position['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
	}
}
