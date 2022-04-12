<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
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
		
		$customer = Customer::where('user_profile_id', $id_user_p)->first();
		 if ($customer){
        $cant = Customer::where('user_profile_id', $id_user_p)->get();
		$exist_user = 1;
		}else{
			$cant = 0;
			$exist_user = 0;
		 }
		 
		
		 
		 $customers = Customer::where('user_profile_id', $id_user_p)->orderBy('name')->latest()->get();
		 
          return view('customers.index',compact('customers', 'cant', 'exist_user'))
             ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		/*primero Debemos consultar la tabla customers y ver que no existaan datos repetidos en email*/
		
		$email = $request->get('email');
		
		
		$una_fila = Customer::where('email', $email)->first();
		  if ($una_fila){

				 return redirect()->back()->with('repeated', 'Este Email ya se encuentra registrado');
		  }else{
		
		
		
		
		
		$id_user = auth()->id();
		$user = User::find($id_user);
		$id_user_p = $user->userProfile->id;
		
         $request->validate([
            //'name' => 'required',
            'email' => 'required',

		   
		]);

        //UserProfile::create($request->all());
		 $data = new Customer([
           // 'user_id' => auth()->id(),
            'user_profile_id' => $id_user_p,
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);
		$data->save();
        
		//echo "se guardo esta joda";
		return redirect()->back()->with('success', 'Cliente Creado!');
    }
	 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
		//echo $customer;die;
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
     //public function update(Request $request, $id)
	{
		//$customer = Customer::findOrFail($id);
		$customer->update([
				 'name' => $request->get('name'),
				 'email' => $request->get('email'),
				        ]);

        return redirect()->back()->with('success', 'Profile update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
   public function destroy ($id)
   //public function destroy(Customer $customer)
    {
        Customer::destroy($id);

		return response()->json([
		'success' => 'Record deleted successfully!'
		]);    
    }
}
