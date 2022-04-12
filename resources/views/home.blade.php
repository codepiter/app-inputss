@extends('layouts.master')

<style>
	.row1{
		display: flex;
		margin-right: 340px;
		margin-left: -15px;
	}
</style>

@section('script')
<script>
$( document ).ready(function() {
	prof = $('#slug').val();
	if(prof == "") {
    	$('#exampleModal').modal('toggle');
	}
});
</script>

<script>
	function check(e) {
		tecla = (document.all) ? e.keyCode : e.which;
		//Tecla de retroceso para borrar, siempre la permite
		if (tecla == 8) {
			return true;
		}
   
		// Patron de entrada, en este caso solo acepta numeros letras y espacios
		patron =/^[A-Za-z0-9\s]+$/g;
		tecla_final = String.fromCharCode(tecla);
		return patron.test(tecla_final);
	}

	function checkUrl(e) {		
		tecla = (document.all) ? e.keyCode : e.which;
		//Tecla de retroceso para borrar, siempre la permite
		if (tecla == 8) {
			return true;
		}
   
		// Patron de entrada, en este caso solo acepta numeros y letras
		let patron = new RegExp(/\w/, 'i');
		tecla_final = String.fromCharCode(tecla);
		return patron.test(tecla_final);
	}
</script>

<link rel="stylesheet" type="text/css" href="{{ asset('css/prices.css')}}">
<!-- paypal -->
<script src="https://www.paypal.com/sdk/js?client-id=ATIPQE7Y4pYDwNvQIWee54q6Q2zs80niAq1itJJohQWE1d_pE70_EdBedJ41RjXqicVpewfJAbc_NMM_&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script> 
<script>

  	paypal.Buttons({
      	style: {
          	shape: 'pill',
          	color: 'blue',
          	layout: 'vertical',
          	label: 'subscribe'
	    },
      	createSubscription: function(data, actions) {
        	return actions.subscription.create({
          	/* Creates the subscription */
          	plan_id: 'P-83U81438HC804800CMBXRF2A'
        });
    },
    
	onApprove: function(data, actions) {
      	//  alert(data.subscriptionID); // You can add optional success message for the subscriber here
		
		var tok = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:'POST',
			url: 'userprofiles/updateTypePlan',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: {
				_token : tok,
				id_subscription: data.subscriptionID,
				type_plan: 'pro',
				amount: '8'
			},
			success:function(response){
				$('#aprov').fadeIn('slow', function(){
				   $('#aprov').delay(8000).fadeOut(); 
				});
				console.log('suscripcion lista');
			}, error: function (response) {
			}
		});
      }
 	}).render('#paypal-button-container-P-83U81438HC804800CMBXRF2A'); // Renders the PayPal button
  
  	/** boton numero 2 **/
    paypal.Buttons({
      	style: {
          	shape: 'pill',
          	color: 'blue',
          	layout: 'vertical',
          	label: 'subscribe'
      	},
    	createSubscription: function(data, actions) {
        	return actions.subscription.create({
          		/* Creates the subscription */
          		plan_id: 'P-2D404523UB711783MMBXRKHQ'
        	});
    	},
      	onApprove: function(data, actions) {
       		// alert(data.subscriptionID); // You can add optional success message for the subscriber here
     
			var tok = $('meta[name="csrf-token"]').attr('content');
        	$.ajax({
            	type:'POST',
            	url: 'userprofiles/updateTypePlan',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            	data: {
					_token : tok,
                	id_subscription: data.subscriptionID,
                	type_plan: 'empresa',
                	amount: '20'
            	},
            	success:function(response){
			  		$('#aprov').fadeIn('slow', function(){
				   		$('#aprov').delay(8000).fadeOut(); 
					});

               		console.log('suscripcion lista');
            	}, error: function (response) {
        		}
   			});
	 	}
  	}).render('#paypal-button-container-P-2D404523UB711783MMBXRKHQ'); // Renders the PayPal button
  	/** Fin de boton numero 2 **/
</script>
@stop
 
@section('content')

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body" >
	
	

<input type="hidden" id="slug" value="{{ $slug }}">

<div id="modalUserProfile" >
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">{{__('messages.user_profile') }}</h5>
						<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>-->
					  </div>
					 <!-- <form action="{{ route('userprofiles.store') }}" method="POST" enctype="multipart/form-data">-->
@isset($id_user_p)
@if($id_user_p)
					  <form action="{{ route('userprofiles.update',$id_user_p) }}" method="POST" enctype="multipart/form-data">
					  <div class="modal-body">
		  
					@if (session('varsesion'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Error en carga!</strong> {{ session('varsesion') }}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif
										  
							@csrf
						  	@method('PUT')
							 <div class="row">
							   
							   
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Input Link Nombre:</strong>
										<input type="text" name="slug" onkeypress="return checkUrl(event)" class="form-control" placeholder="Ingrese aca el nombre que aparecera en su url Ejm: carritos">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Name:-->{{__('messages.name') }}</strong>
										<input type="text" name="name" onkeypress="return check(event)" class="form-control" placeholder="Name">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Description:-->{{__('messages.description') }}</strong>
										<input type="text" name="description" class="form-control" placeholder="Description/Position">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>{{__('messages.identification_document') }}</strong>
										<input type="text" name="personid" class="form-control" placeholder="Documento de Identificación">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Teléfono:-->{{__('messages.phone') }}</strong>
										<input type="text" name="telefono" class="form-control" placeholder="telefono">
									</div>
								</div>
								
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Logo:-->{{__('messages.logo') }}</strong>
										  <input type="file" name="logo" class="form-control" placeholder="Logo">
									</div>
								</div>
								

								<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						<!--<button type="submit" class="btn btn-primary">Submit</button>-->
								</div>
							</div>
						   
					  </div>
					  <div class="modal-footer">
						<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						<button type="submit" class="btn btn-primary" id="sub-form"><!--Submit-->{{__('messages.btn_6') }}</button>
					  </div>	
					  </form>
@endif
@endisset

					</div>
				  </div>
				</div>

</div>

        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                
                    <div id="aprov" style="display:none" class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>{{__('messages.success_pay') }}</strong>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>

                        <div class="row">
                            <!-- sale card start -->

                             <div class="col-md-4">
                               <a href="{{ route('inputlinks.index') }}" >
							   <div class="card text-center order-visitor-card">
                                    <div class="card-block">
                                        <h6 class="m-b-0">Inputslink</h6>
                                        <h4 class="m-t-15 m-b-15"><i class="fa fa-link m-r-15 text-c-red"></i>  @isset($cantidad) 
										{{$cantidad}}   
										@endisset
										</h4>
                                        <!--<p class="m-b-0">48% From Last 24 Hours</p>-->
                                    </div>
                                </div>
								</a>
                            </div>
                            <div class="col-md-4">
                               <a href="{{ route('codigoqrs.index') }}" >
								<div class="card text-center order-visitor-card">
                                    <div class="card-block">
                                        <h6 class="m-b-0">QR Style's</h6> 
                                        <h4 class="m-t-15 m-b-15"><i class="fa fa-qrcode m-r-15 text-c-green"></i>QR Con Estilo</h4>
                                        <!--<p class="m-b-0">36% From Last 6 Months</p>-->
                                    </div>
                                </div>
							  </a>
                            </div>

	@isset($slug)
		@if($slug != "")

							 <div class="col-md-4">
								<a href="{{ URL::to($slug) }}" target="_blank">
								<div class="card text-center order-visitor-card">
                                    <div class="card-block">
                                        <h6 class="m-b-0">{{__('messages.my_presentation') }}</h6> 
                                        <h4 class="m-t-15 m-b-15"><i class="fa fa-address-card-o m-r-15 text-c-blue"></i>{{__('messages.my_inputslink') }}</h4>
                                        <!--<p class="m-b-0">36% From Last 6 Months</p>-->
                                    </div>
                                </div>
							  </a>
                            </div>
		@endif
	@endisset


                            <!-- sale card end -->
                        </div>
                   
					
					
							 @if(Auth::user()->nimda_si==0)
							<div class="row" style="padding: 15px;">
								<div class="col-md-4 col-sm-6">
									<div class="pricingTable">
										<div class="pricingTable-header">
											<span class="heading">
												Free
											</span>
										</div>
										<div class="pricing-plans">
											<span class="price-value"><i class="fa fa-usd"></i><span>0</span></span>
											<span class="subtitle">Plan Free</span>
										</div>
										<div class="pricingContent">
											<ul>
												<li><b>12</b> Enlaces</li>
												<li>Código QR</li>
												<li>Vínculos de video</li>
												<li>Iconos sociales </li>
												<li>Imagen y Descripción</li>
												<li>Temas prediseñados </li>
												<li>Amigo Fiel  </li>
												<li>Soporte y Apoyo  </li>
											</ul>
										</div><!-- /  CONTENT BOX-->

										<div class="pricingTable-sign-up"><!-- BUTTON BOX-->
										@isset($plan_actual)
											@if($plan_actual == "free")
												<h3>Plan Actual</h3>
											@endif
										@endisset
										
										
										
										
										</div><!-- BUTTON BOX-->
									</div>
								</div>

								<div class="col-md-4 col-sm-6">
									<div class="pricingTable">
										<div class="pricingTable-header">
											<span class="heading">
											   Pro
											</span>
										</div>
										<div class="pricing-plans">
											<span class="price-value"><i class="fa fa-usd"></i><span>8</span></span>
											<span class="subtitle">Plan Pro</span>
										</div>
										<div class="pricingContent">
											<ul>
												<li>Enlaces Ilimitados</li>
												<li>Código QR</li>
												<li>Vínculos de video</li>
												<li>Iconos sociales </li>
												<li>Imagen y Descripción</li>
												<li>Temas prediseñados </li>
												<li>Amigo Fiel  </li>
												<li>Enlaces para Compartir  </li>
												<li>Enlace prioritario   </li>
												<li>Suscripción por correo electrónico al boletín  </li>
												<li>Enlace SMS  </li>
												<li>Eliminar el logotipo de inputslink </li>
												<li>Vínculos de apoyo  </li>
												<li>Soporte y Apoyo  </li>
											</ul>
										</div><!-- /  CONTENT BOX-->

										<div class="pricingTable-sign-up"><!-- BUTTON BOX-->
									@if(isset($plan_actual))
										@if($plan_actual == "pro")
											<h3>Plan Actual</h3>
											
										@else
									
											<div id="paypal-button-container-P-83U81438HC804800CMBXRF2A"></div>
										@endif					
									@else
									
										<div id="paypal-button-container-P-83U81438HC804800CMBXRF2A"></div>
									@endif										
											
										</div><!-- BUTTON BOX-->
									</div>
								</div>


							</div>
						
 
		                     @endif
			          
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>
@endsection
