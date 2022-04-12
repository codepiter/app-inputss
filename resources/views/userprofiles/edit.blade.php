@extends('layouts.master')
@section('script')
<script src="{{ asset('js/customjs.js') }}" defer></script>
<style>
	.img-fluid{
		max-width:90px;
		margin-bottom: 10px;
	}
	.alineaimg{
		width: 130px;
		height: 130px;
		object-fit: cover;
	}
</style>
@stop
@section('content')
<script>
	document.addEventListener("DOMContentLoaded", function() {
		let checkbox = document.getElementById('redirectCheckbox');
		if (!checkbox.checked)
			document.getElementById('redirect_to').disabled = true;

		checkbox.addEventListener("change", function() {
			if(checkbox.checked)
				document.getElementById('redirect_to').disabled = false;
			else
				document.getElementById('redirect_to').disabled = true;
		});

		let checkbox2 = document.getElementById('redirectCheckbox2');
		if (!checkbox2.checked)
			document.getElementById('clave').disabled = true;

		checkbox2.addEventListener("change", function() {
			if(checkbox2.checked)
				document.getElementById('clave').disabled = false;
			else
				document.getElementById('clave').disabled = true;
		});

		const subs_email = document.getElementById('subs_email');
		if(subs_email.checked)
			document.getElementById('title_subs_email').style.display = "block";

		const subs_sms = document.getElementById('subs_sms');
		if(subs_sms.checked)
			document.getElementById('title_subs_sms').style.display = "block";

		subs_email.addEventListener("change", function () {
			if(subs_email.checked)
				document.getElementById('title_subs_email').style.display = "block";
			else
				document.getElementById('title_subs_email').style.display = "none";
		});

		subs_sms.addEventListener("change", function () {
			if(subs_sms.checked)
				document.getElementById('title_subs_sms').style.display = "block";
			else
				document.getElementById('title_subs_sms').style.display = "none";
		});
	});
	
	$('#mensaje_ayuda').text('20 carácteres restantes');
    $('#msg_giro').keydown(function () {
      var max = 30;
      var len = $(this).val().length;
      if (len >= max) {
          $('#mensaje_ayuda').text('Has llegado al límite');// Aquí enviamos el mensaje a mostrar          
          $('#mensaje_ayuda').addClass('text-danger');
          $('#msg_giro').addClass('is-invalid');
          $('#inputsubmit').addClass('disabled');    
          document.getElementById('inputsubmit').disabled = true;                    
      } 
      else {
          var ch = max - len;
          $('#mensaje_ayuda').text(ch + ' carácteres restantes');
          $('#mensaje_ayuda').removeClass('text-danger');            
          $('#msg_giro').removeClass('is-invalid');            
          $('#inputsubmit').removeClass('disabled');
          document.getElementById('inputsubmit').disabled = false;            
      }
  });  
  
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
</script>
   
   
@if ($errors->any())
	<div class="alert alert-danger">
    	 <strong>{{__('messages.whoops') }}</strong> {{__('messages.msg_whoops') }}.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    	</ul>
    </div>
@endif

	

	

@if (session('varsesion'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error en carga!</strong> {{ session('varsesion') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
	


<div class="container" style="padding:5%">
 <div class="card">
   <div class="card-block"> 
    <form action="{{ route('userprofiles.update',$user_profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
   
  @if($user_profile->type_plan=='pro')
   <div class="col-xs-12 col-sm-12 col-md-6  ">
	   <div class="form-group">
			<strong><!--Slug:-->{{__('messages.slug') }}</strong>
			<input type="text" name="slug" onkeypress="return check(event)" value="{{ $user_profile->slug }}" class="form-control" placeholder="{{__('messages.slug') }}">
		</div>
   </div>
   @endif
   
       <div class="col-xs-12 col-sm-12 col-md-12  ">
        	<div class="row" >
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="form-group">
						<strong><!--Name:-->{{__('messages.name') }}</strong>

						<input type="text" name="name" value="{{ $user_profile->name }}" class="form-control" placeholder="{{__('messages.name') }}">

					</div>
				</div>

				@if($user_profile->type_plan=='pro')
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<strong><!--Color:-->Color del texto del Nombre</strong>
							<input type="color" name="color" value="{{ $user_profile->color }}" class="form-control" placeholder="Color" style="height:35px">
						</div>
					</div>
					
					
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<strong><!--template:-->Plantilla</strong>
							<input type="number" name="templ" value="{{ $user_profile->templ }}" class="form-control" placeholder="Plantilla" min="1" max="2">
						</div>
					</div>
					
				@endif
			</div>
		</div>
		
		

        <div class="col-xs-12 col-sm-12 col-md-12">
        	<div class="form-group">
            	<strong><!--Description:-->{{__('messages.description') }}</strong>
                <textarea class="form-control" style="height:130px" name="description"  placeholder="Description ">{{ $user_profile->description }}
				</textarea>
            </div>
        </div>
			 
		<div class="col-xs-12 col-sm-12 col-md-12">
        	<div class="form-group">
                <strong><!--seo:-->{{__('messages.seo') }}</strong>
                <textarea class="form-control" style="height:75px" name="seo" placeholder="SEO" maxlength="250">{{ $user_profile->seo }}
				</textarea>
            </div>
        </div>


		<div class="col-xs-12 col-sm-12 col-md-12  ">
			<div class="row">	



		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="form-group">
				<strong>{{__('messages.privado') }}</strong>
				@if($user_profile->privado=='on')
					<input name="privado" class="form-control" checked data-toggle="toggle" data-on="Actief" data-off="Inactief" data-onstyle="success" data-offstyle="danger" type="checkbox" id="redirectCheckbox2">
				@else	
					<input id="redirectCheckbox2" name="privado" class="form-control" type="checkbox">
				@endif
			</div>
		</div>
				
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="form-group">
				<strong>{{__('messages.clave') }}</strong>
				<input id="clave" type="text" name="clave" value="{{ $cadenaDesencriptada }}" class="form-control" style="height:35px" placeholder="Ingrese clave para privatizar su inputslink" required>
			</div>
		</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
						<strong><!--Documento de Identidad:-->{{__('messages.identification_document') }}</strong>
						<input type="text" name="personid" onkeypress="return check(event)" value="{{ $user_profile->personid }}" class="form-control" placeholder="Documento de Identidad">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
						<strong><!--Teléfono:-->{{__('messages.phone') }}</strong>
						<input type="text" name="telefono" onkeypress="return check(event)" value="{{ $user_profile->telefono }}" class="form-control" placeholder="Teléfono">
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
					  <strong>{{__('messages.redirect') }}</strong>
						@if($user_profile->redirect==1)
							<input id="redirectCheckbox" name="redirect" class="form-control" checked type="checkbox">
						@else	
							<input id="redirectCheckbox" name="redirect" class="form-control" type="checkbox">
						@endif
					</div>
				</div>
				
				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
						<strong>{{__('messages.redirect_to') }}</strong>
						<input id="redirect_to" type="text" name="redirect_to" value="{{ $user_profile->redirect_to }}" class="form-control" style="height:35px" placeholder="https://linkedin.com">
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
						<strong><!--Color de Fuente :-->{{__('messages.color_fuente') }}</strong>
						<input type="color" name="color_fuente" value="{{ $user_profile->color_fuente }}" class="form-control" style="height:35px" placeholder="Documento de Identidad">
					</div>
				</div>
				
				<!--<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
						<strong></strong>
						 <input type="text" name="contactame" value="" class="form-control" placeholder="Teléfono">
					</div>
				</div>-->

				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
					  <strong>{{__('messages.show_contactame') }}</strong>
						<br>
						@if($user_profile->contactame=='on')
							<input name="contactame" class="form-control" checked data-toggle="toggle" data-on="Actief" data-off="Inactief" data-onstyle="success" data-offstyle="danger" type="checkbox">
						@else	
							<input name="contactame" class="form-control" data-toggle="toggle" data-on="Actief" data-off="Inactief" data-onstyle="success" data-offstyle="danger" type="checkbox">
						@endif
					</div>
				</div>

				@if($user_profile->type_plan=='pro')
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong><!--Suscripcion-->{{__('messages.subscriptions') }}</strong>

							<div class="form-group">
								<div class="form-check form-check-inline">
									@if ($user_profile->subs_email)
										<input type="checkbox" class="form-check-input" id="subs_email" name="subs_email" checked>
									@else
										<input type="checkbox" class="form-check-input" id="subs_email" name="subs_email">
									@endif
									<label class="form-check-label" for="subs_email">{{__('messages.subscription_email')}}</label>
								</div>
								<div class="form-check form-check-inline">
									@if ($user_profile->subs_sms)
										<input type="checkbox" class="form-check-input" id="subs_sms" name="subs_sms" checked>
									@else
										<input type="checkbox" class="form-check-input" id="subs_sms" name="subs_sms">	
									@endif
									<label class="form-check-label" for="subs_sms">{{__('messages.subscription_sms')}}</label>
								</div>
							</div>
							<div class="row">
								<div id="title_subs_email" style="display: none" class="col-xs-12 col-sm-12 col-md-6">
									<div class="form-group">
										<strong>{{__('messages.title_subs_email') }}</strong>
										<input type="text" name="title_subs_email" value="{{ $user_profile->title_subs_email }}" class="form-control" style="height:35px" placeholder="{{__('messages.subscription_email')}}">
									</div>
									<div class="form-group">
										<strong>{{__('messages.subtitle_subs_email') }}</strong>
										<input type="text" name="subtitle_subs_email" value="{{ $user_profile->subtitle_subs_email }}" class="form-control" style="height:35px" placeholder="Click aqui para suscribirse por correo">
									</div>
								</div>
								<div id="title_subs_sms" style="display: none" class="col-xs-12 col-sm-12 col-md-6">
									<div class="form-group">
										<strong>{{__('messages.title_subs_sms') }}</strong>
										<input type="text" name="title_subs_sms" value="{{ $user_profile->title_subs_sms }}" class="form-control" style="height:35px" placeholder="{{__('messages.subscription_sms')}}">
									</div>
									<div class="form-group">
										<strong>{{__('messages.subtitle_subs_sms') }}</strong>
										<input type="text" name="subtitle_subs_sms" value="{{ $user_profile->subtitle_subs_sms }}" class="form-control" style="height:35px" placeholder="Click aqui para suscribirse por sms">
									</div>
								</div>
							</div>
						</div>	
					</div>
				@endif

				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<div class="form-group">
						<strong><h4><!--Logo:-->{{__('messages.logo') }}</h4></strong><br>
						@if($user_profile->logo)
							<img src="{{ asset( '/storage/uploads').'/'.$user_profile->logo}}" alt="" style="max-height: 150px; margin-top: 15px;margin-bottom: 15px;">
						@else
							<img class="img-80 img-radius" src="{{URL::to('assets/images/avatardefault_92824.png')}}" alt="img">
						@endif
						<input type="file" name="logo" class="form-control">
					</div>
				</div><hr>

				<div class="col-xs-12 col-sm-12 col-md-12 text-center my-3">
					<div class="form-group">
						<strong><h4 class="pb-3"><!--Logo Title:-->{{__('messages.logo_title') }}</h4></strong><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6">
								@if($user_profile->logo_title)
									<img src="{{ asset( '/storage/uploads').'/'.$user_profile->logo_title}}" alt="" style="max-height: 150px; margin-top: 15px;margin-bottom: 15px;">
								@else
									<img class="img-80 img-radius" src="{{URL::to('assets/images/avatardefault_92824.png')}}" alt="img">
								@endif
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								@if ($user_profile->isPro())
									<input type="checkbox" name="show_logo_title" id="show_logo_title" value="{{ $user_profile->show_logo_title }}" @if ($user_profile->show_logo_title) checked @endif>
									<label for="show_logo_title">{{--Mostrar logo titulo--}}{{__('messages.show_logo_title')}}</label>
								@endif
								<input type="file" name="logo_title" class="form-control">
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-xs-12 col-sm-12 col-md-12 text-center" id="logo">
					<strong><h4><!--Background:-->{{__('messages.background') }}</h4></strong><br>
						<div class="row text-center" >
							<div class="col-lg-3 col-md-3 col-xs-6">
								<img class="alineaimg img-fluid back8" src="{{ asset('storage'). '/uploads/background/back8.jpeg'}}" >
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid back1" src="{{ asset('storage'). '/uploads/background/back1.jpeg'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid back6" src="{{ asset('storage'). '/uploads/background/back6.jpeg'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid back5" src="{{ asset('storage'). '/uploads/background/back5.jpeg'}}">
							</div>
							
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid back2" src="{{ asset('storage'). '/uploads/background/back2.jpg'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid back3" src="{{ asset('storage'). '/uploads/background/back3.jpg'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid back4" src="{{ asset('storage'). '/uploads/background/back4.jpg'}}">
							</div>
							
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid back7" src="{{ asset('storage'). '/uploads/background/back7.jpeg'}}">
							</div>
						</div>
						
					 @if($user_profile->type_plan=='pro')
							  <br><strong><!--Background gif:--><h4>{{__('messages.gif_background') }}</h4></strong><br>
						<div class="row text-center">
							<div class="col-lg-3 col-md-3 col-xs-6">
								<img class="alineaimg img-fluid gif1" src="{{ asset('storage'). '/uploads/background/1.gif'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid gif2" src="{{ asset('storage'). '/uploads/background/2.gif'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid gif3" src="{{ asset('storage'). '/uploads/background/3.gif'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid gif4" src="{{ asset('storage'). '/uploads/background/4.gif'}}">
							</div>
							
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid gif5" src="{{ asset('storage'). '/uploads/background/5.gif'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid gif6" src="{{ asset('storage'). '/uploads/background/6.gif'}}">
							</div>
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid gif7" src="{{ asset('storage'). '/uploads/background/7.gif'}}">
							</div>
							
							<div class="col-lg-3 col-md-3 col-xs-6">
							  	<img class="alineaimg img-fluid gif8" src="{{ asset('storage'). '/uploads/background/8.gif'}}">
							</div>
						</div>
					@endif
						
						
					</div>
					
					@if($user_profile->type_plan=='pro')
						<div class="col-xs-12 col-sm-12 col-md-12 text-center">
							<div class="form-group">
							
								@if($user_profile->background1)
									<img src="{{ asset( '/storage/uploads').'/'.$user_profile->background1}}" alt="" style="max-height: 150px; margin-top: 15px;margin-bottom: 15px;">
								@else
							  		<img class="img-80 img-radius" src="{{URL::to('assets/images/avatardefault_92824.png')}}" alt="img">
								@endif
								<input type="file" name="background1"  class="form-control" >
							</div>
						</div>
					@endif
					<input type="hidden" name="back-pre" id="back-pre" class="form-control">
					
	
					<div class="col-xs-12 col-sm-12 col-md-12">
                		<div class="form-group">
                    		<strong><!--msg_giro:-->{{__('messages.msg_giro') }}</strong>
                    		<textarea style="height: 50px;" maxlength="30" class="form-control" style="height:150px" id="msg_giro" name="msg_giro" >{{ $user_profile->msg_giro }}
							</textarea>
							<!--<span class="help-block">
  								<p id="mensaje_ayuda" class="help-block">Cuerpo del mensaje de alerta</p>
							</span>-->
                		</div>
             		</div>
			 
			 		@if($user_profile->type_plan=='free')
			 			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
							<div class="form-group">
								<strong><h4>{{__('messages.loyal_friend') }}</h4></strong><br>
							</div>		
						</div>		
			 		@endif
			 
			  		@if($user_profile->type_plan=='pro')
			 			
			 
			 			<div class="col-xl-6 col-sm-6 col-md-6">
							<div class="form-group" style="text-align: left;">
								<strong >{{__('messages.msg_inputslink') }}:</strong>
								<select class ="form-control" id="titulo_amigo" name="titulo_amigo">

									<option value="{{__('messages.recommend_it') }}" 	@if($user_profile->titulo_amigo=='Te los recomiendo') selected @endif >{{__('messages.recommend_it') }}</option>
									
									<option value="{{__('messages.loyal_friend') }}" @if($user_profile->titulo_amigo=='Amigo Fiel') selected @endif>{{__('messages.loyal_friend') }}</option>

								</select>
							</div>
						</div>
			 		@endif

					<div class="col-xs-12 col-sm-12 col-md-12">
                		<div class="form-group">
                    		<strong><!--Amigo 1:-->{{__('messages.friend_1') }}</strong>
                    		<input type="text" name="friend_1" value="{{ $user_profile->friend_1 }}" class="form-control" placeholder="MI AMIG@">
                		</div>
            		</div>
			
					<div class="col-xs-12 col-sm-12 col-md-12">
                		<div class="form-group">
                    		<strong><!--Amigo 2:-->{{__('messages.friend_2') }}</strong>
                    		<input type="text" name="friend_2" value="{{ $user_profile->friend_2 }}" class="form-control" placeholder="Mi AMIG@">
                		</div>
            		</div>
			 
            	</div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            	<button type="submit" class="btn btn-primary"><!--Submit-->{{__('messages.btn_6') }}</button>
            </div>
        </div>
    </form>
   </div>
  </div>
</div>
@endsection