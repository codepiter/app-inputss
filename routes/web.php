<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InputLinkController;
use App\Http\Controllers\UserProfileController;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\StadisticsController;
use App\Http\Controllers\GeoLocationController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\LeadsController;

use App\Http\Controllers\Admin\AdvertisingController;
use App\Http\Controllers\Admin\StateAdController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
*/


/*
Route::get('/', function () {
       if (Auth::check()) {
	 return view('home');
	 }else{
	  return view('auth.login');
	   }
});
Auth::routes();
*/

Route::get('/', function () {
    if (Auth::check()) {
		$user = Auth::user();
		if ($user->hasVerifiedEmail()) {
			return redirect('/home');
		} else {
			return redirect('email/verify');
		}
	} else {
	  	return view('auth.login');
	}
});
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('editprofile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('editprofile');


Route::get('checking', [App\Http\Controllers\HomeController::class, 'verificar'])->name('checking');

/**verify-private**/
Route::post('userprofiles/verifyPrivate', [UserProfileController::class, 'verifyPrivate'])->name('userprofiles.verifyPrivate');				
/************************** Habilitando smtp **********************************/
Route::get('email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
 
 // -----------------------------form------------------------------------
Route::get('form/new', [App\Http\Controllers\formController::class, 'index'])->name('form/new');
Route::post('form/save', [App\Http\Controllers\formController::class, 'save'])->name('form/save');
Route::get('form/view/report', [App\Http\Controllers\formController::class, 'viewReport'])->name('form/view/report');
// -------------------------InputLinf-----------------------------------
Route::resource('inputlinks', InputLinkController::class)->middleware('auth');
Route::get('inputlinks/create?type=video', [InputLinkController::class, 'create'])->middleware('auth')->name('inputlinks.comercialVideo');
Route::get('inputlinks/create?type=image', [InputLinkController::class, 'create'])->middleware('auth')->name('inputlinks.comercialImage');
 
 
/*sort*/
Route::post('inputlinks/sort', [App\Http\Controllers\InputLinkController::class, 'sortable'])->name('inputlinks.sort');
/*fin sort*/


//Route::get('inputlinks', [App\Http\Controllers\InputLinkController::class, 'index'])->name('inputlinks');


//Route::get('menus/{menu:slug}', [MenuController::class, 'show'])->name('menus.show');

// -------------------------user profile-----------------------------------
//Route::get('userprofiles', [App\Http\Controllers\UserProfileController::class, 'store'])->name('userprofiles');
 

//vcard
//Route::get('personalInformations/vcard/{id}', 'PersonalInformationController@vcard')->name('personalInformations.vcard');


Route::resource('userprofiles', UserProfileController::class)-> middleware ('auth');
Route::resource('customers', CustomerController::class)-> middleware ('auth');

// Ruta UserProfiles, metodo searchUsers para consultar con un filtro los usuarios.
Route::get('userprofiles/search/{search}', [UserProfileController::class, 'searchUsers'])->name('userProfiles.search');
Route::get('userprofiles/searchAll/index', [UserProfileController::class, 'searchUserAll'])->name('userProfiles.searchall');

//Route::get('userprofiles/{userprofile:slug}', [UserProfileController::class, 'show'])->name('userprofiles.show');
Route::get('{userprofile:slug}', [UserProfileController::class, 'show'])->name('show');
Route::post('contactanos', [UserProfileController::class, 'sendemail'])->name('contactanos.sendemail');
Route::get('userprofiles/vcard/{id}', [UserProfileController::class, 'vcard'])->name('userprofiles.vcard');

/**change type plan**/
Route::post('userprofiles/updateTypePlan', [UserProfileController::class, 'updateTypePlan'])->name('userprofiles.updateTypePlan');

/* insert type plan */
Route::post('userprofiles/insertTypePlan', [UserProfileController::class, 'insertTypePlan'])->name('userprofiles.insertTypePlan');

// ------------------------------------- QR ---------------------------------------
Route::get('qr/index', [App\Http\Controllers\CodigoQrController::class, 'index'])->name('codigoqrs.index');
Route::post('qr/store', [App\Http\Controllers\CodigoQrController::class, 'store'])->name('codigoqrs.store');
Route::post('qr/update', [App\Http\Controllers\CodigoQrController::class, 'update'])->name('codigoqrs.update');

// --------------------------- Logout ---------------------------------------
//Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// --------------------------------- Paypal ---------------------------------------			   
Route::get ('/paypal/pay', [App\Http\Controllers\PaymentController::class ,'payWithPaypal1']);/*pagos RESTO*/
Route::get ('/paypal/pay2', [App\Http\Controllers\PaymentController::class ,'payWithPaypal2']);/*pagos EEUU*/
Route::get ('/paypal/status', [App\Http\Controllers\PaymentController::class, 'payPalStatus']);
Route::get ('/paypal/subscribe', [App\Http\Controllers\PaymentController::class, 'subscribePayPal'])->name('subscribe-paypal');
//Route::get ('/paypal/subscribe', [App\Http\Controllers\PaymentController::class, 'subscribePayPal']);
//Route::post('/paypal/subscribe', 'PlansController@subscribePayPal')->name('subscribe-paypal'); //<----------------------------

//geolocation
Route::post('/geolocation', [GeoLocationController::class, 'store']);

//Stadistics
Route::get('stadistics/index', [StadisticsController::class, 'index'])->name('stadistics.index');
Route::post('stadistics/getLinksData', [StadisticsController::class, 'getLinksData']);
Route::post('stadistics/getDetailedDataLink', [StadisticsController::class, 'getDetailedDataLink']);
Route::post('stadistics/getChartDataLink', [StadisticsController::class, 'getChartDataLink']);

// Route::get('customers/index', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index')-> middleware ('auth');

//contact_me
Route::get('leads/index', [LeadsController::class, 'index'])->name('leads.index');
Route::post('leads/getLeads', [LeadsController::class, 'getLeads']);

//suscripciones
Route::get('subscription/index', [SubscriptionController::class, 'index'])->name('subscription');
Route::get('subscription/index?type=sms', [SubscriptionController::class, 'index'])->name('suscription.sms');
Route::get('subscription/index?type=email', [SubscriptionController::class, 'index'])->name('suscription.email');
Route::post('subscription/email', [SubscriptionController::class, 'subscriptionEmail'])->name('subscription.subscriptionEmail');
Route::post('subscription/sms', [SubscriptionController::class, 'subscriptionSms'])->name('subscription.subscriptionSms');
Route::post('subscription/getSubscribers', [SubscriptionController::class, 'getSubscribers']);

//Premium
Route::get('premium/index', [PremiumController::class, 'index'])->name('premium.index');
Route::get('premium/getList', [PremiumController::class, 'getListPremium']);
Route::post('premium/getPremiumData', [PremiumController::class, 'getPremiumData']);
Route::post('premium/addEmail', [PremiumController::class, 'store']);
Route::post('premium/updateEmail/{id}', [PremiumController::class, 'update']);
Route::delete('premium/deleteEmail/{id}', [PremiumController::class, 'destroy']);


Route::middleware(['auth', 'verified'])->group(function () {

	Route::prefix('administrator')->name('admin.')->group(function () {
		//Publicidad-Anuncios
		Route::get('/advertising/index', [AdvertisingController::class, 'index'])->name('ads.index');
		Route::resource('/advertising', AdvertisingController::class)->except('index', 'show');

		//Publicidad - Anuncios State
		Route::get('/StateAds/updateState', [StateAdController::class, 'updateState'])->name('adsState.updateState');
		Route::put('/StateAds/updateSelect', [StateAdController::class, 'updateAdvertisingSelected'])->name('adsState.selected');

		//Administración de usuarios
		Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
		Route::put('users/userState/{user}', [UserController::class, 'updateState'])->name('user.updateState');
		Route::resource('/user', UserController::class)->only(['update', 'destroy']);
	});
});



