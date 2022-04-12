<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

//use App\Models\Coin;


use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use DB;

class PaymentController extends Controller
{
	private $apiContext;
    public function __construct()
	{
		$this->middleware('auth');
		$payPalConfig = Config::get('paypal');
		$this->apiContext = new ApiContext(
        	new OAuthTokenCredential(
            	$payPalConfig['client_id'],     // ClientID
            	$payPalConfig['secret']      // ClientSecret
        	)
		);
    }
	
    public function subscribePayPal(Request $request)
    {
    	//Assign user to plan
    	// auth()->user()->plan_id = $request->planID;
        auth()->user()->paypal_subscribtion_id = $request->subscriptionID;
        auth()->user()->update();

        return response()->json([
            'status' => true,
            'success_url' => redirect()->intended('/plan')->getTargetUrl(),
        ]);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	public function payWithPaypal1(){
		
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$amount = new Amount();
		$amount->setTotal('9.99'); //aca debemos obtener el precio del producto
		$amount->setCurrency('USD');

		$transaction = new Transaction();
		$transaction->setAmount($amount);

        $callbackUrl = url('/paypal/status');

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl($callbackUrl) //cara triste o alegre
					->setCancelUrl($callbackUrl); //cara triste
       

		$payment = new Payment();
		$payment->setIntent('sale')
			->setPayer($payer)
			->setTransactions(array($transaction))
			->setRedirectUrls($redirectUrls);
			
			try {
            $payment->create($this->apiContext);
           // echo $payment;

			return redirect()->away($payment->getApprovalLink());//para url externa dado por paypal
			}catch (PayPalConnectionException $ex) {
				echo $ex->getData();
			}
			
	}
		
    public function payWithPaypal2(){

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$amount = new Amount();
		$amount->setTotal('19.99'); //aca debemos obtener el precio del producto
		$amount->setCurrency('USD');

		$transaction = new Transaction();
		$transaction->setAmount($amount);

        $callbackUrl = url('/paypal/status');

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl($callbackUrl) //cara triste o alegre
					->setCancelUrl($callbackUrl); //cara triste
       

		$payment = new Payment();
		$payment->setIntent('sale')
			->setPayer($payer)
			->setTransactions(array($transaction))
			->setRedirectUrls($redirectUrls);

			try {
            $payment->create($this->apiContext);
           // echo $payment;

			return redirect()->away($payment->getApprovalLink());//para url externa dado por paypal
			}catch (PayPalConnectionException $ex) {
				echo $ex->getData();
			}
			
	}
	
	
	public function payPalStatus(Request $request){    //atender los que nos envia paypal
		//dd($request->all());
		
		/*Lo que devuelve
		  "paymentId" => "PAYID-L46DSTI64526890TK317794Y"
		  "token" => "EC-0WU7265797499541G"
		  "PayerID" => "4FAK9ZRQDA8BS"
		/*hasta aqui de lo que devuelve*/
		
		 //echo "estoy acaph";die;
		
		$paymentId = $request->input('paymentId');
		$payerId = $request->input('PayerID');
		$token = $request->input('token');
		
		
		if(!$paymentId || !$payerId || !$token){
			$status = 'No se pudo proceder con el pago a través de paypal';
			//return redirect ('/paypal/failed')->with(compact('status')); //esto es a donde enviaremos al usuario si falla
			
			
			 return redirect()->back()->with('nei', 'Algo Salio mal');
			
		}
		
		$payment = Payment::get($paymentId, $this->apiContext);
		
		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);
		
		/* Execute the payment*/
		$result = $payment->execute($execution, $this->apiContext);
	//	dd($result);

		if($result->getState() === 'approved'){
			$status = 'hemos recibido su pago puede continuar con el diseño de su Menú';

        $total = $result->transactions[0]->amount->total;
		if($total == "9.99"){
			$type="menu-a";
		}else{
			$type="menu-b";

		}
			$id_user = auth()->id();

			$affected = DB::table('user_profiles')
						  ->where('id', $id_user)
						  ->update(['type_plan' => 'pro']);

			$affected2 = DB::table('payments')->insert([
			  'amount' => $total,
			  'user_id' => $id_user,
			  'payment_mode' => 'paypal',
			  'type_card' => $type
			 ]);

		//$coins = Coin::all();
		//return redirect()->route('menus.create')->with(compact('coins'));	
		 return redirect()->route('home')->with('pago_correcto', 'Su pago ha sido procesado exitosamente');

	} //fin-$result->getState() === 'approved'
	
	
	
	
	

		//$status = 'Lo sentimos! El pago a través de Paypal no se pudo realizar';
		
		 return redirect()->route('home')->with('pago_incorrecto', 'Su pago NO se ha podido procesar');
		
		
		//return View::make('formPaypal.index');
		//return redirect()->route('menus.create')->with(compact ('status'));
		/**/
	}


}
