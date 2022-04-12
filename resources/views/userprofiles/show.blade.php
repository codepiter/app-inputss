@extends('layouts.website')
@section('head')

 <title>{{ $userprofile->name }}</title>

  <meta name="keywords" content="{{ $userprofile->name }}">
 
<meta property="og:image" content="{{ asset('storage/uploads'). '/'.$userprofile->logo}}">
<meta property="og:site_name" content="Tu Tarjeta de Presentacion">
<meta property="og:title" content="{{ $userprofile->name }}">
<meta property="og:url" content="app.inputslink.com/{{ $userprofile->slug }}">
<meta property="og:type" content="website" />
<meta property="og:description" content=" {{ $userprofile->seo}} ">
<meta name="description" content="{{ $userprofile->seo }}">


@stop


@section('script')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<a href="https://icons8.com/icon/114049/contacto-de-negocio"></a>
  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript" src="{{URL::to('assets/js/Inputslink.js')}}"></script>
<script type="text/javascript">
    InitInputslink({
        baseurl: {!!json_encode(URL::to('/'))!!},
		assetsurl: '{{ asset('storage/uploads')}}',
        csrf: '{{ csrf_token() }}',
		id: '{{ $id_user }}',
		publicInputslinks: @json($inputlinks),
		userprofile_id: '{{$userprofile->id}}',
		subs_email: '{{$userprofile->subs_email}}',
		title_subs_email: '{{$userprofile->title_subs_email}}',
		subtitle_subs_email: '{{$userprofile->subtitle_subs_email}}',
		default_subtitle_subs_email: '{{__('messages.subscription_email')}}',
		subs_sms: '{{$userprofile->subs_sms}}',
		title_subs_sms: '{{$userprofile->title_subs_sms}}',
		subtitle_subs_sms: '{{$userprofile->subtitle_subs_sms}}',
		default_subtitle_subs_sms: '{{__('messages.subscription_sms')}}',
		template: '{{$template}}',
		rounded_userprofile: '{{$userprofile->rounded}}'
    });
</script>

<script>
	function clickUrl (item) {
		event.preventDefault();
		window.CSRF_TOKEN = '{{ csrf_token() }}';
		fetch({!!json_encode(URL::to('/geolocation'))!!}, {
			method: "POST",
        	credentials: "same-origin",
        	body: JSON.stringify({
				'id_link': item.id,
			}),
        	headers: {
				'Content-Type': 'application/json',
        		'X-CSRF-TOKEN': window.CSRF_TOKEN
        	}
		}).then((response) => {
			if (response.ok) {
				window.open(`${item.url}`, '_blank'); 
			}
		});
	}
</script>
<link rel="stylesheet" href="{{asset('assets/css/inputslink.css')}}"> 


{{-- Nuevo Publicidad --}}
@include('userprofiles.components.anuncioScript')
{{-- Nuevo Publicidad --}}

@stop

@section('main')
<!--
@if(!empty($private))
  <div class="alert alert-success"> {{ $private }}</div>
@endif
 Modal -->

<input type="hidden" id="check" value="{{ $userprofile->privado }}">
<div class="modal fade" id="priv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog" role="document" style="padding-top: 15%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1"><!--Contáctame-->{{__('messages.inputslink_private') }}	</h5>
        
      </div>

      <div class="modal-body">
			<div class="modal-body">
				@csrf
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						<p>{{__('messages.send_credentials') }}</p>
					</div>
					<input type="hidden" name="id_up" id="id_up" class="form-control" value="{{ $userprofile->id }}">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>{{__('messages.email') }}</strong>
							<input type="text" name="email" id="email" class="form-control" placeholder="email@email.com">
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>{{__('messages.password') }}</strong>
							<input type="text" name="password" id="password" class="form-control" placeholder="*********">
						</div>
					</div>
					<p id="match" class="text-center">{{__('messages.not_match') }}</p>
					<input type="hidden" value="{{$userprofile->user->email}}" name="email">
					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
			
					</div>
				</div>
					
					  </div>
					  <div class="modal-footer">					
						<input type="button" id="submit" class="btn btn-primary" value="{{__('messages.send') }}">
					  </div>	
			  </div>
			
			
		</div>
    </div>
</div><div id="fade"></div>

<div id="alert-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="modal-title" class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<p id="message-alert" class="text-center"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(!$id_user)
	<div class="modal fade" id="modal_test" tabindex="-1" role="dialog" aria-labelledby="subs_emailModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><!--Inicio de Sesion-->{{__('messages.log_in') }}</h5>
				  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
				<div class="modal-body">
					  <form action="{{route('login')}}" method="post">
						<div class="modal-body">
							@csrf
						  	<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<label for="email_login">{{ __('E-Mail Address') }}</label>
                                		<input id="email_login" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<label for="password_login">{{ __('Password') }}</label>
                                		<input id="password_login" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
										@error('email')
											<span class="invalid-feedback" role="alert" style="paddind-top: 10px">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
						  	</div>
						</div>
						<div class="modal-footer">
						  	<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						  	<button type="submit" class="btn btn-primary" id="form-login"><!--Suscribirse-->{{__('messages.log_in') }}	</button>
						</div>	
					</form>  
				</div>
			</div>
		</div>
	</div>
@endif

@include('userprofiles.components.modals.subs_email')
{{-- @if ($userprofile->subs_email)
	<div class="modal fade" id="subs_emailModal" tabindex="-1" role="dialog" aria-labelledby="subs_emailModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
	  		<div class="modal-content">
				<div class="modal-header">
		  			<h5 class="modal-title" id="subs_emailModalLabel"><!--Suscripcion por email-->{{__('messages.subscription_email') }}	</h5>
		  			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
		  			</button>
				</div>
				<div class="modal-body">
		  			<form action="{{route('subscription.subscriptionEmail')}}" method="post">
						<div class="modal-body">
							@csrf
					  		<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Name:-->{{__('messages.name') }}</strong>
										<input type="text" name="name" class="form-control" placeholder="{{__('messages.name') }}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Apellido:-->{{__('messages.lastname') }}</strong>
										<input type="text" name="lastname" class="form-control" placeholder="{{__('messages.lastname') }}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Email</strong>
										<input type="email" name="email" class="form-control" placeholder="user@example.com">
									</div>
								</div>
								<input type="hidden" value="{{$userprofile->id}}" name="user_profile_id">
					  		</div>
						</div>
						<input type="hidden" value="{{$userprofile->user->email}}" name="email_owner">
						<div class="modal-footer">
						  	<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						  	<button type="submit" class="btn btn-primary" id="sub-form-email"><!--Suscribirse-->{{__('messages.subscribe') }}	</button>
						</div>	
					</form>  
				</div>
			</div>
		</div>
	</div>
@endif --}}

@include('userprofiles.components.modals.subs_sms')
{{-- @if ($userprofile->subs_sms)
	<div class="modal fade" id="subs_smsModal" tabindex="-1" role="dialog" aria-labelledby="subs_smsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
	  		<div class="modal-content">
				<div class="modal-header">
		  			<h5 class="modal-title" id="subs_smsModalLabel"><!--Suscripcion por sms-->{{__('messages.subscription_sms') }}	</h5>
		  			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
		  			</button>
				</div>
				<div class="modal-body">
		  			<form action="{{route('subscription.subscriptionSms')}}" method="post">
						<div class="modal-body">
							@csrf
					  		<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Name:-->{{__('messages.name') }}</strong>
										<input type="text" name="name" class="form-control" placeholder="{{__('messages.name') }}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Apellido:-->{{__('messages.lastname') }}</strong>
										<input type="text" name="lastname" class="form-control" placeholder="{{__('messages.lastname') }}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong><!--Phone No:-->Nº {{__('messages.phone') }}</strong>
										<input type="text" name="phone" class="form-control" placeholder="{{__('messages.phone') }}">
									</div>
								</div>
								<input type="hidden" value="{{$userprofile->id}}" name="user_profile_id">
					  		</div>
						</div>
						<input type="hidden" value="{{$userprofile->user->email}}" name="email_owner">
						<div class="modal-footer">
						  	<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						  	<button type="submit" class="btn btn-primary" id="sub-form-sms"><!--Suscribirse-->{{__('messages.subscribe') }}	</button>
						</div>	
					</form>  
				</div>
			</div>
		</div>
	</div>
@endif --}}

@include('userprofiles.components.modals.contactanos')
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel"><!--Contáctame-->{{__('messages.call_me') }}	</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		<form action="{{route('contactanos.sendemail')}}" method="post">
					<div class="modal-body">
						@csrf

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong><!--Name:-->{{__('messages.name') }}</strong>
									<input type="text" name="name" class="form-control" placeholder="{{__('messages.name') }}">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong><!--Apellido:-->{{__('messages.lastname') }}</strong>
									<input type="text" name="lastname" class="form-control" placeholder="{{__('messages.lastname') }}">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong>Email</strong>
									<input type="email" name="email" class="form-control" placeholder="user@example.com">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong><!--Phone No:-->Nº {{__('messages.phone') }}</strong>
									<input type="text" name="phone" class="form-control" placeholder="{{__('messages.phone') }}">
								</div>
							</div>
							<input type="hidden" value="{{$userprofile->id}}" name="user_profile_id">
							<input type="hidden" value="{{$userprofile->user->email}}" name="email_owner">
						</div>
					</div>
					<div class="modal-footer">
						<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						<button type="submit" class="btn btn-primary" id="sub-form"><!--Llamame-->{{__('messages.call') }}	</button>
					</div>	
				</form>		
      		</div>
    	</div>
  	</div>
</div> --}}



<div id="content-wrapper">						   

  @if($userprofile->background1)
    <header class="header header--bg" style="background-image:url('{{ asset('storage/uploads'). '/'.$userprofile->background1}}');">
   @else
    <header class="header header--bg" style="background-image:url('{{ asset('/assets/images/header-background.png')}}');">

   @endif



    <div class="container">

			  	<div class="container-img col-12 center-block">
				  <div class="content">
					  <div class="content-overlay"></div>
					  
					  @if($userprofile->logo)
					  <img class="content-image" src="{{ asset('storage/uploads'). '/'.$userprofile->logo}}">
				       @else
                       <img class="content-image" src="{{ asset('/assets/images/avatardefault_92824256.png')}}">
				      @endif

					  <div class="content-details fadeIn-left">
						<h3><!--No me muevas que me mareo-->{{ $userprofile->msg_giro }}</h3>
					  </div>
				  </div>
				</div>
	
     <div class="header__cont text-center">
        @if($userprofile->name)
		<h1 class="header__content__title" style="font-size: 30px; color: {{$userprofile->color}};">{{$userprofile->name}} </h1>

		@else
		<h1 class="header__content__title">JOHNNY D. DORSCH</h1>
        @endif
		
		<div class="header__content__sub-title">
         @if($userprofile->description)
		  <h3 style="font-size: 17px;">{{$userprofile->description}}</h3>
		 @else
		 <h3 style="font-size: 17px;">UI / UX DESIGNER / WEB DEVELOPER / PHOTOGRAPHAR</h3>
         @endif
        </div>
		
		
		
		
		
		
      </div>
<div class="center">
	<ul>
		@include('userprofiles.components.buttons.contactame')
    	{{-- <div class="share">
			<ul>
	  			<div class="share-button1 text-center">
	  				<span>Contactame</span>
	  				<a  href="tel:+{{ $userprofile->telefono }}" ><i class="fas fa-phone"></i></a>
	  				<a href="{{ route('userprofiles.vcard',$userprofile->id) }}" style="text-decoration:none;" class="msg-btn" target="_blank"><i class="fas fa-address-book"></i>
	  				<a href="mailto:{{$userprofile->user->email}}"><i class="fas fa-envelope"></i></a>
	  				<a><i class="fas fa-id-card-alt" data-toggle="modal" data-target="#exampleModal" &nbsp;&nbsp;&nbsp;&nbsp></i></a>
	  			</div>
	  		</ul>
		</div> --}}

		@include('userprofiles.components.buttons.comparteme')
		{{-- <div class="share">
			<ul>
	  			<div class="share-button text-center">
	  				<span>Comparteme</span>
	  				<a href="https://www.facebook.com/sharer.php?u=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-facebook-f"></i></a>
	  				<a href="https://twitter.com/intent/tweet?text=Quiero%20compartir%20esta%20herramienta,%20esta%20maginifica=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-twitter"></i></a>
	  				<a href="https://api.whatsapp.com/send?text=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-whatsapp"></i></a>
	  				<a href="https://www.linkedin.com/shareArticle?mini=true&url=AQUI_URL&title=InputsLink&summary=&source=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-linkedin-in"></i></a>
	  			</div>
	  		</ul>
		</div> --}}
	</ul>
</div>


<!--
      <div class="icon-bare text-center">
	   <ul>

		  <li class="phone">
			<a  href="tel:+{{ $userprofile->telefono }}" ><i class="fas fa-phone"></i></a>
		  </li>
          <li class="address"> 	 
			<a href="{{ route('userprofiles.vcard',$userprofile->id) }}" style="text-decoration:none;" class="msg-btn" target="_blank"><i class="fas fa-address-book"></i> 	
			</a>
		  </li>
          <li class="mail">	 
			<a href="mailto:{{$userprofile->user->email}}"><i class="fas fa-envelope"></i></a>
		  </li>

		  @if($userprofile->contactame=='on')
          <li class="contactame">
		  <img src="https://img.icons8.com/ios-filled/50/ffffff/moleskine.png" data-toggle="modal" data-target="#exampleModal" &nbsp;&nbsp;&nbsp;&nbsp>
		  </li>
		  @endif
		  
		  <div class="share-button">
		  
		  <span>Comparteme</span>
		  <a href="https://www.facebook.com/sharer.php?u=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-facebook-f"></i></a>
<li><a href="https://www.facebook.com/sharer.php?u=app.inputslink.com/{{ $userprofile->slug }}" target="_blank" class="facebook"><i  class="fab fa-facebook-f"></i></a></li>
		  <a href="https://twitter.com/intent/tweet?text=Quiero%20compartir%20esta%20herramienta,%20esta%20maginifica=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-twitter"></i></a>
<li><a href="https://twitter.com/intent/tweet?text=Quiero%20compartir%20esta%20herramienta,%20esta%20maginifica=app.inputslink.com/{{ $userprofile->slug }}" target="_blank" class="twitter"><i  class="fab fa-twitter"></i></a></li>	
		  <a href="https://api.whatsapp.com/send?text=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fab fa-whatsapp"></i></a>
<li><a href="https://api.whatsapp.com/send?text=app.inputslink.com/{{ $userprofile->slug }}" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a></li>
		  <a href="https://www.linkedin.com/shareArticle?mini=true&url=AQUI_URL&title=InputsLink&summary=&source=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fab fa-linkedin-in"></i></a>
<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=AQUI_URL&title=InputsLink&summary=&source=app.inputslink.com/{{ $userprofile->slug }}" target="_black" class="linkedin"><i  class="fab fa-linkedin-in"></i></a></li>
		  <a href="sms:?body=Hola te comparto l tarjeta de {{ $userprofile->name }} : {{ Request::url() }}" class="sms"><i class="fas fa-sms"></i></a>
<li class="sms-li" ><a href="sms:?body=Hola te comparto l tarjeta de {{ $userprofile->name }} : {{ Request::url() }}" class="sms"><i class="fas fa-sms"></i></a></li>
		  </div>
  
	  </ul>
      </div>
    </div>

	-->
	
	<div class="container skill__container--narrow">
      
		<div  style="margin-left:15%;margin-right:15%; margin-top: auto;">
			<div class="row" >
				@include('userprofiles.components.buttons.contenido')
				{{-- <div class="share" style="padding-block-end:10px;">
					<ul>
						<div class="content-button text-center">
							<span>Contenido</span>
							<a id="content-premium"><i class="fas fa-crown"></i></a>
							<!--fas fa unlock-alt-->
							<!--<a id="sensible"><i class="fas fa-eye-slash"></i></a> Puede servir para contenido sensible-->
						</div>
					</ul>
				</div> --}}
			</div>
		</div>
	  
	  	<div id="sortable" class="page-section" style="margin-left:15%;margin-right:15%; margin-top: auto; margin-bottom: 0px">
		@if ($userprofile->subs_email)
			<div class="row thumbnail ui-state-default" data-toggle="modal" data-target="#subs_emailModal">
				<div class="col-md-2 col-xs-2 text-center" style="">
					<img style="max-width: 5rem;" src="{{ asset('storage/uploads/rrss/email.png')}}" alt="">
				</div>
				@if ($userprofile->title_subs_email)
					<div class="col-xs-10 col-md-10" style="">   
						<h4 class="skill__single-part__title" style="font-size: 16px;">{{$userprofile->title_subs_email}}</h4>
						<h5 class="">{{$userprofile->subtitle_subs_email}}</h5>
					</div>
				@else
					<div class="col-xs-10 col-md-10" style="">   
						<h4 class="skill__single-part__title" style="font-size: 16px;">{{__('messages.subscription_email')}}</h4>
						<h5 class="">Click aqui para suscribirse por correo</h5>
					</div>
				@endif
			</div>
		@endif

		@if ($userprofile->subs_sms)
			<div class="row thumbnail ui-state-default" data-toggle="modal" data-target="#subs_smsModal">
				<div class="col-md-2 col-xs-2 text-center" style="">
					<img style="max-width: 5rem;" src="{{ asset('storage/uploads/rrss/sms.png')}}" alt="">
				</div>
				@if ($userprofile->title_subs_email)
					<div class="col-xs-10 col-md-10" style="">   
						<h4 class="skill__single-part__title" style="font-size: 16px;">{{$userprofile->title_subs_sms}}</h4>
						<h5 class="">{{$userprofile->subtitle_subs_sms}}</h5>
					</div>
				@else
					<div class="col-xs-10 col-md-10" style="">   
						<h4 class="skill__single-part__title" style="font-size: 16px;">{{__('messages.subscription_sms')}}</h4>
						<h5 class="">Click aqui para suscribirse por sms</h5>
					</div>
				@endif
			</div>
		@endif


			@foreach ($inputlinks as $item)
			    @if($item->video)

				   @if($item->comercial == 'on')
						<div class="row vid" style="margin-bottom:0px">					  
							  {!! $item->video !!}
						
						</div>
						  
						<div class="paypal-button-video">
							
							{!! $item->paypal_button !!}
							
						</div>
					@else
						<div class="row vid">
										  
							  {!! $item->video !!}
							 
						</div>
					@endif

				@elseif($item->music)
			   
			    <div class="row music">
								  
					  {!! $item->music !!}
					 
				</div>
				@elseif($item->comercial2 == 'on')
				
					<div class="row imgcom" style="margin-bottom:0px">					  
						 <img style="" src="{{ asset('storage/uploads'). '/'.$item->img_comercial}}" alt="">
						
					</div>
					  
					<div class="paypal-button-img">
						
						{!! $item->paypal_button !!}
						
					</div>
				
				@else
				<a onclick="clickUrl({{json_encode($item)}})" href="{{ $item->url }}" target="_blank">
				  
					<div class="row thumbnail ui-state-default" 
					@if($userprofile->rounded=='on') 
					style="border-radius: 40px;"
					@endif
					>
							 <div class="col-md-2 col-xs-2 text-center" style="">
								<img style="max-width: 5rem" src="{{ asset('storage/uploads'). '/'.$item->logo}}" alt="">
							  </div>
							  <div class="col-xs-10 col-md-10" style="">
								
								 <h4 class="skill__single-part__title" style="font-size: 16px;">{{ $item->title }}</h4>
								  <h5 class="">{{ $item->subtitle }}</h5>
							  </div>
					</div>
				 </a>

				@endif

			@endforeach
      </div>


	 @if($img_f1 || $img_f2)
		 <!--{{__('messages.friends') }}-->
	  <h3 class="header__content__sub-title" style="color:white">Mis Amigos	</h3>
	 @endif
	 
	  <div class="row text-center" style="margin-bottom:15px">
	  @if($img_f1)
		
			<a href="{{$userprofile->friend_1}}" target="_blank"><div class="content-friend" style="display:inline-block; margin:5px">
				<img class="content-image" src="{{ asset('storage/uploads'). '/'.$img_f1}}">
			</div></a>
		
	  @endif
	  @if($img_f2)
		
			<a href="{{$userprofile->friend_2}}" target="_blank"><div class="content-friend" style="display:inline-block; margin:5px">
				<img class="content-image" src="{{ asset('storage/uploads'). '/'.$img_f2}}">
			</div></a>
		
	  @endif
	  </div>
	  
	  
	  
	 <div id="canvas"  style="text-align:center; margin-bottom: 10px"></div>
	 @if($data)
	 <div>
		 <input type="hidden" id="url" value="{{ $data->url }}">
		 <input type="hidden" id="width" value="{{ $data->width }}">
		 <input type="hidden" id="height" value="{{ $data->height }}">
		 <input type="hidden" id="color" value="{{ $data->color }}">
		 <input type="hidden" id="typedots" value="{{ $data->typedots }}">
		 <input type="hidden" id="background" value="{{ $data->background }}">
		 <input type="hidden" id="qrImage" value="{{ $data->image }}">
	 </div>
	@endif
	
	
	
	{{-- @if($userprofile->type_plan=='free')
		<div class="img-fluid" style="text-align:center">
		 <img style="max-width: 25rem;" src="{{ asset('images/icons'). '/'.'logo_final.png' }}">
		</div>
	@endif --}}
	@include('userprofiles.components.logo_title')

    </div>
	

	{{-- Nuevo Publicidad --}}
	@include('userprofiles.components.anuncio')
	{{-- Nuevo Publicidad --}}
	

	
	<div class="container-fluid foot-c">  
	 <div class="col-md-12" style="padding-left:5%; padding-right:5%;">
      <div class="col-md-4 text-left ">
		  <p class="footer__paragraph"><!--Contact-->{{__('messages.contact') }}<br></p>
		  <p class="footer__paragraph">Telf:1(786)431-3099<br></p>
		  <p class="footer__paragraph">Email:info@inputslink.com<br></p>
		
      </div>
	  <div class="col-md-4 text-center ">
		
			<ul class="icon-foot">
			  
			  <li><a href="https://www.youtube.com/channel/UC_79IZMRLUpevrIfJr-v_sQ"><i class="fab fa-youtube"></i></a></li>
			  <li><a href="https://www.facebook.com/bussweOficial/"><i class="flaticon-facebook-letter-logo"></i></a></li>
			  <li><a href="https://twitter.com/bussweoficial"><i class="flaticon-twitter-logo"></i></a></li>
			  
			</ul>
			
			<br>
			<p class="footer__paragraph text-left"><!--Solicita tu Inputslink Pruébala-->{{__('messages.request') }}<br>
			<!--Pide tu versión Free y comienza hoy mismo-->  {{__('messages.order') }} <a href="https://app.inputslink.com/register"> {{__('messages.here') }}</a></p>
	  </div>
	  <div class="col-md-4 text-left " ><br>
		<p class="footer__paragraph">
			<a href="#" style="color:black"> Legal & Confianza</a>
		</p>
		<p class="footer__paragraph">
			<a href="#" style="color:black"> Política</a>
		</p>
		<p class="footer__paragraph">
			<a href="#" style="color:black"> Términos y Condiciones</a>
		</p>
			
	  </div>
  
    </div> 

    </div>
	
  </header>
</div>


@endsection