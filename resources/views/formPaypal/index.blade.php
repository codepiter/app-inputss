@extends('layouts.mm2')

@section('scripts')

<style>
html{
	background: aliceblue;
}
body{
    font-family: 'Open Sans', sans-serif;
    text-align:center;
  }
.btn-payment{
    background-color:#0070ba;
    padding:13px 24px;
    color:white;
    text-decoration: none;
    border-radius: 0.25rem;
  }
  
input[type=radio]{
	width: 1.5em;
    height: 2em;
	-webkit-appearance: radio;
	
}

.img-tarjeta{
	max-height:200px;
}

.form-check-label {
    margin-left: 1rem;
}

.form-check {
    display: flex;
    justify-content: left;
    align-items: center;
    padding: 2em;
}


html { font-size: 1rem; }

@media (min-width: 576px) {
    html { font-size: 0.80rem; }
}
@media (min-width: 768px) {
    html { font-size: 0.90rem; }
}
@media (min-width: 992px) {
    html { font-size: 1rem; }
}
@media (min-width: 1200px) {
    html { font-size: 1.15rem; }
}
</style>

<script>

	$('#monto_sus').html("00.00$");
    $('#monto_tot').html("00.00$");
    $('#pay_empre').css("display", "none");
    $('#pay_empre').prop("readOnly", "true");
	
	$('.btnp1').css("display", "none");
	$('.btnp2').css("display", "none");
			
			
	$('input:radio[name="suscripcion"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'empresa') {
            $('#monto_sus').html("8.99$");
            $('#monto_tot').html("8.99$");
			$('#pay_empre').css("display", "block");
			$('#pay_empre').prop("readOnly", "false");
			$('#pay_person').css("display", "none");
			$('#pay_person').prop("readOnly", "true");
			
			$('#img-emp').attr('src', '/assets/images/logow.png');
			$('#img-per').attr('src', '/assets/images/inputslinkbyn.jpg');
			$('#img-gts').attr('src', '/assets/images/inputslinkbyn.jpg');
			
			
			$('.btnp1').css("display", "block");
			$('.btnp2').css("display", "none");
			$('#pay_free').css("display", "none");
			
			
		
        }
		
		if ($(this).is(':checked') && $(this).val() == 'persona') {
			$('#monto_sus').html("8.99$");
            $('#monto_tot').html("8.99$");
			$('#pay_empre').css("display", "none");
			$('#pay_empre').prop("readOnly", "true");
			$('#pay_person').css("display", "block");
			$('#pay_person').prop("readOnly", "false");
			
			$('#img-per').attr('src', '/assets/images/logow.png');
			$('#img-emp').attr('src', '/assets/images/inputslinkbyn.jpg');
			$('#img-gts').attr('src', '/assets/images/inputslinkbyn.jpg');
			
			
			$('.btnp1').css("display", "none");
			$('.btnp2').css("display", "block");
			$('#pay_free').css("display", "none");
			
			
		}
		
		if ($(this).is(':checked') && $(this).val() == 'gratis') {
			$('#monto_sus').html("00.00$");
            $('#monto_tot').html("00.00$");
			$('#pay_empre').css("display", "none");
			$('#pay_empre').prop("readOnly", "true");
			$('#pay_person').css("display", "block");
			$('#pay_person').prop("readOnly", "false");
			
			$('#img-gts').attr('src', '/assets/images/logow.png');
			$('#img-per').attr('src', '/assets/images/inputslinkbyn.jpg');
			$('#img-emp').attr('src', '/assets/images/inputslinkbyn.jpg');
			
			$('.btnp1').css("display", "none");
			$('.btnp2').css("display", "none");
			$('#pay_free').css("display", "block");
			

		}
    });

	$('.btn-invitado').click(function(){
		$('#exampleModal').modal();
	});	
	
	$('#pers').click(function(){
		$('#type_card').val("persona");
	});	
	
	$('#empr').click(function(){
		$('#type_card').val("empresa");
	});	
	
	$('#grat').click(function(){
		$('#type_card').val("gratis");
	});	


	$('#btnAgregar').click(function(){
			ObjEvento=recolectarDatosGUI("POST");
			
			EnviarInformation('',ObjEvento);
		
				  $('#codig').val("");

		});
		
		function recolectarDatosGUI(method){
			nuevoEvento={
					codig:$('#codig').val(),
					type_card:$('#type_card').val(),
					'_token':$("meta[name='csrf-token']").attr("content"),
					'_method':method
			}
			return (nuevoEvento);
		}

</script>
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
			url: 'userprofiles/insertTypePlan',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: {
				_token : tok,
				id_subscription: data.subscriptionID,
				type_plan: 'pro',
				amount: '8'
			},
			success:function(response){
				location.reload();
				
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
            	url: 'userprofiles/insertTypePlan',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            	data: {
					_token : tok,
                	id_subscription: data.subscriptionID,
                	type_plan: 'empresa',
                	amount: '20'
            	},
            	success:function(response){
					location.reload();
			  		
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
	
	
	/*free*/
	
	$('#pay_free').click(function(){	
		var tok = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:'POST',
			url: 'userprofiles/insertTypePlan',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: {
				_token : tok,
				type_plan: 'free',
			},
			success:function(response){
				location.reload();
				
				$('#aprov').fadeIn('slow', function(){
				   $('#aprov').delay(8000).fadeOut(); 
				});
				console.log('suscripcion lista');
			}, error: function (response) {
			}
		})
	});
		
</script>
@endsection

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <title>Payment</title>
</head>

<body>

@if (session('messagedcal'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Alerta!</strong> {{ session('messagedcal') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if (session('messagedgif'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Alerta!</strong> {{ session('messagedgif') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if (session('messagecust'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Alerta!</strong> {{ session('messagecust') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif





<div class="wrapper">

</div>
 
 <div class="row">
	 <div class="col-md-8 col-sm-12">
	 <div style="padding:15px">
		<strong>Seleccione su suscripcion</strong></div>
		<div class="card" style>
			<div class="card-body">
			
			

			<div class="row">
				 <div class="col-sm-5 col-md-5">
					<div class="form-check">
						 <input class="form-check-input" type="radio" name="suscripcion" id="rad_gratis" value="gratis" checked>
							<label class="form-check-label" for="rad_gratis">

								<img id="img-gts" src="{{URL::asset('/assets/images/logow.png')}}" class="img-fluid" >

						</label>
					</div>
				 </div>

				 <div class="col-sm-7 col-md-7" style="display: flex; justify-content: center; align-items: center;">
					<p><strong>Free</strong><br>Edición limitada está disponible inmediatamente para los primeros 5.000 suscriptores que se registren en <a href="https://app.inputslink.com">app.inputslink.com/</a>

					</p>
				 </div>
				 
			 </div>	
			
			

			 <div class="row">
				 <div class="col-sm-5 col-md-5">
					<div class="form-check">
						 <input class="form-check-input" type="radio" name="suscripcion" id="rad_persona" value="persona" >
							<label class="form-check-label" for="rad_persona">

								<img id="img-per" src="{{URL::asset('/assets/images/inputslinkbyn.jpg')}}" class="img-fluid" >

						</label>
					</div>
				 </div>

				 <div class="col-sm-7 col-md-7" style="display: flex; justify-content: center; align-items: center;">
					<p><strong>VIP</strong><br>Accede a beneficios que las funciones mejoradas te van a dar, conecta en linea de una manera genial.

					</p>
				 </div>
				 
			 </div>	

			 
			 <div class="row">
				 <div class="col-sm-5 col-md-5">
					<div class="form-check">
					    <input class="form-check-input" type="radio" name="suscripcion" id="rad_empresa" value="empresa">
						<label class="form-check-label" for="rad_empresa">

					<img id="img-emp" src="{{URL::asset('/assets/images/inputslinkbyn.jpg')}}" class="img-fluid" >
					
					  </label>
					
					</div>
				 </div>

				  <div class="col-sm-7 col-md-7" style="display: flex; justify-content: center; align-items: center;">
					<p><strong>ORO (Muy Pronto)</strong><br>Es usted una empresa y necesita mas herramientas o eres agencia que está interesada en administrar múltiples inputss? esto es para ti.

					</p>
				 </div>
				 
			 </div>

			</div>

			
		  </div>
		  
	 </div>

	 
	 <div class="col-md-4 col-sm-12">
	 	 <div style="padding:15px">
		<strong>Resumen del Pedido</strong></div>
		  <div class="card" style="border:none; background:transparent;">
  
			<div class="card-body">
			  <p class="card-text" style="text-align:justify;">Esta a punto de ingresar al Mundo de Inputslink, se cargara a su cuenta el monto de la suscripcion que usted escoja.</p>

			</div>
			<div class="card-footer row" style="background:none">
				<div class="col-6"> Suscripcion: </div>
				<div class="col-6"><strong id="monto_sus"></strong></div>
			</div>			
			<div class="card-footer row">
				<div class="col-6"><strong style="color:#007bff"> Total a Pagar: </strong></div>
				<div class="col-6"><strong id="monto_tot"></strong></div>
			</div>
			<div class="card-footer row" style="margin-left: auto; margin-right: auto;background: none; border: none;">
				<a href="{{ url('#') }}" class="btn-payment" id="pay_free" style="background-color: #0071c1 !important; border-radius: 25px; width:180px; padding: 6px 24px;">Free</a>
				
				
				
				<div class="btnp1" id="paypal-button-container-P-83U81438HC804800CMBXRF2A"></div>
				<div class="btnp2" id="paypal-button-container-P-2D404523UB711783MMBXRKHQ"></div>
				
			
			
			</div>
		
			<div class="row">
			
			  <div class="col"><br>
				<div class="collapse multi-collapse" id="multiCollapseExample1">
					<a href="#" class="btn-invitado btn-payment" id="pers" style="background-color: #0071c1 !important;">Personal</a>
				</div>
			  </div>
			  <div class="col"><br>
				<div class="collapse multi-collapse" id="multiCollapseExample2">
					<a href="#" class="btn-invitado btn-payment" id="empr" style="background-color: #0071c1 !important;">Empresarial</a>
				</div>
			  </div>
			    <div class="col"><br>
				<div class="collapse multi-collapse" id="multiCollapseExample3">
					<a href="#" class="btn-invitado btn-payment" id="grat" style="background-color: #0071c1 !important;">Graterol</a>
				 
				</div>
			  </div>
			  
			  
			</div>


		  </div>
		
	 </div>
	 
 </div>
 
 <br>
 

</body>
</html>

@endsection