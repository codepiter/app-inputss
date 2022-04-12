@extends('layouts.templ')
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


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>





<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<a href="https://icons8.com/icon/114049/contacto-de-negocio"></a>
 

	
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
					<h5 class="modal-title"><!--Contáctame-->{{__('messages.log_in') }}</h5>
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
		  			<h5 class="modal-title" id="subs_emailModalLabel"><!--Contáctame-->{{__('messages.subscription_email') }}	</h5>
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
		  			<h5 class="modal-title" id="subs_smsModalLabel"><!--Contáctame-->{{__('messages.subscription_sms') }}	</h5>
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
        <h5 class="modal-title" id="exampleModalLabel"><!--Contáctame-->{{__('messages.contact_me') }}	</h5>
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
										<strong><!--Phone No:-->Nº {{__('messages.phone') }}</strong>
										<input type="text" name="phone" class="form-control" placeholder="{{__('messages.phone') }}">
									</div>
								</div>
								<input type="hidden" value="{{$userprofile->user->email}}" name="email">
								<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						<!--<button type="submit" class="btn btn-primary">Submit</button>-->
								</div>
					</div>
						   
					
					  </div>
					  <div class="modal-footer">
						<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						<button type="submit" class="btn btn-primary" id="sub-form"><!--Llamame-->{{__('messages.btn_5') }}	</button>
					  </div>	
					  </form>
					
      </div>
    </div>
  </div>
</div> --}}



<div id="content-wrapper ">						   

   @if($userprofile->background1)
    <div class="header header--bg" style="background-image:url('{{ asset('storage/uploads'). '/'.$userprofile->background1}}');">
   @else
    <div class="header header--bg" style="background-image:url('{{ asset('/assets/images/header-background.png')}}');">
   @endif
<div class="container">




	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-12 col-md-8 fade-in-image">
		 <div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-6 ">
			<div class="container-img col-12 center-block">
			  <div class="contents">
				 <div class="content-overlay"></div>
				  
				  @if($userprofile->logo)
					  <div class="div-img" >
						 <img class="img rounded-circle w-75" src="{{ asset('storage/uploads'). '/'.$userprofile->logo}}">
						<div class="text">{{ $userprofile->msg_giro }}</div>
					  </div>
			
				   @else
					   <div class="div-img" >
						 <img class=" rounded-circle w-75" src="{{ asset('/assets/images/avatardefault_92824256.png')}}">
						<div class="text">{{ $userprofile->msg_giro }}</div>
					  </div>
				   
				  @endif

			  </div>
			</div>
			

  
  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-6 d-flex align-items-center">
				 <div class="mx-auto">
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
						@include('userprofiles.components.buttons.contenido')
						{{-- <div class="share" style="padding-block-end:10px;">
							<ul>
								<div class="content-button text-center">
									<span>Contenido</span>
									<a id="content-premium"><i class="fas fa-crown"></i></a>
									
								</div>
							</ul>
						 </div> --}}
					</ul>
				 </div>
		 
			
		 
		  </div>
		 </div>
		</div>
	</div>



	<div class="presentation fade-in-image row justify-content-center text-center pb-5">
		<div class="col-xs-12 col-sm-12 col-md-8">
			@if($userprofile->name)
				<h1 class="header__content__title text-uppercase fadeInUp effect-shine" style="font-size: 36px; color: {{$userprofile->color}};">{{$userprofile->name}} </h1>

			@else
				<h1 class="header__content__title text-uppercase">JOHNNY D. DORSCH</h1>
			@endif
			
		
			 @if($userprofile->description)
				<h3 style="font-size: 17px;">{{$userprofile->description}}</h3>
			 @else
				<h3 style="font-size: 17px;">UI / UX DESIGNER / WEB DEVELOPER / PHOTOGRAPHAR</h3>
			 @endif
		</div>
	</div>


	
	<div class=" row justify-content-center mx-auto">

	  <div id="sortable" class="col-xs-12 col-sm-12 col-md-8" >
		@if ($userprofile->subs_email)
			<div class="fade-in-image enlace row mx-auto thumbnail ui-state-default text-center p-0" data-toggle="modal" data-target="#subs_emailModal" >
				<div class="col-md-12 col-xs-12 text-center border-bottom border-dark p-0" style="">
					<img style="max-width: 5rem;" src="{{ asset('storage/uploads/rrss/email.png')}}" alt="">
				</div>
				@if ($userprofile->title_subs_email)
					<div class="col-xs-12 col-md-12" style="">   
						<h4 class="skill__single-part__title" style="font-size: 16px;">{{$userprofile->title_subs_email}}</h4>
						<h5 class="">{{$userprofile->subtitle_subs_email}}</h5>
					</div>
				@else
					<div class="col-xs-12 col-md-12" >   
						<h4 class="skill__single-part__title" style="font-size: 16px;">{{__('messages.subscription_email')}}</h4>
						<h5 class="">Click aqui para suscribirse por correo</h5>
					</div>
				@endif
			</div>
		@endif

		@if ($userprofile->subs_sms)
			<div class="fade-in-image enlace row mx-auto thumbnail ui-state-default text-center p-0" data-toggle="modal" data-target="#subs_smsModal" >
				<div class="col-md-12 col-xs-12 text-center border-bottom border-dark p-0" style="">
					<img style="max-width: 5rem;" src="{{ asset('storage/uploads/rrss/sms.png')}}" alt="">
				</div>
				@if ($userprofile->title_subs_email)
					<div class="col-xs-12 col-md-12" style="">   
						<h4 class="skill__single-part__title" style="font-size: 16px;">{{$userprofile->title_subs_sms}}</h4>
						<h5 class="">{{$userprofile->subtitle_subs_sms}}</h5>
					</div>
				@else
					<div class="col-xs-12 col-md-12" style="">   
						<h4 class="skill__single-part__title" style="font-size: 16px;">{{__('messages.subscription_sms')}}</h4>
						<h5 class="">Click aqui para suscribirse por sms</h5>
					</div>
				@endif
			</div>
		@endif



		<?php $idx = 1; ?>
			@foreach ($inputlinks as $item)
			    @if($item->video)
					@if($item->comercial == 'on')
						<div class="@if($idx%2 == 0) der @else izq @endif row vid justify-content-center fade-in-image enlace" style="margin-bottom:0px" >					  
							{!! $item->video !!}			
						</div>
						  
						<div class="@if($idx%2 == 0) der @else izq @endif paypal-button-video enlace fade-in-image justify-content-center">						
							{!! $item->paypal_button !!}						
						</div>
					@else
						<div class="@if($idx%2 == 0) der @else izq @endif row vid justify-content-center fade-in-image enlace">									  
							{!! $item->video !!}	 
						</div>
					@endif

				@elseif($item->music)
			   
			    <div class="@if($idx%2 == 0) der @else izq @endif row fade-in-image music enlace justify-content-center">
								  
					  {!! $item->music !!}
					 
				</div>
				@elseif($item->comercial2 == 'on')
				
					<div class="@if($idx%2 == 0) der @else izq @endif row fade-in-image imgcom mx-auto justify-content-center" style="margin-bottom:0px">					  
						 <img class="w-100" src="{{ asset('storage/uploads'). '/'.$item->img_comercial}}" alt="">
						
					</div>
					  
					<div class=" @if($idx%2 == 0) der @else izq @endif fade-in-image paypal-button-img justify-content-center">
						
						{!! $item->paypal_button !!}
						
					</div>
				
				@else
				<a onclick="clickUrl({{json_encode($item)}})" href="{{ $item->url }}" target="_blank">
				  
					<div class="@if($idx%2 == 0) der @else izq @endif tag row p-0 fade-in-image thumbnail ui-state-default mx-auto justify-content-center enlace"
					@if($userprofile->rounded=='on') style="border-radius: 40px;" @endif >
						 <div class="col-md-12 col-xs-12 text-center justify-content-center border-bottom border-dark  @if($item->expanded=='on') p-0 @else py-5 @endif" style="">
							<img  
								@if($item->expanded=='on') style="width: 100%; max-height: 250px; object-fit: cover; 
									@if($userprofile->rounded=='on') border-top-left-radius: 40px; border-top-right-radius: 40px;
									@else  border-top-left-radius: 14px; border-top-right-radius: 14px; 
									@endif"
								@else style="max-width: 5rem; 
									@if($userprofile->rounded=='on') border-top-left-radius: 40px; border-top-right-radius: 40px;
									@else  border-top-left-radius: 14px; border-top-right-radius: 14px; 
									@endif" 
								@endif 
							src="{{ asset('storage/uploads'). '/'.$item->logo}}" alt="">
						 </div>
						 <div class="col-xs-12 col-md-12 justify-content-center text-center" style="">
							<h4 class="skill__single-part__title" style="font-size: 16px;">{{ $item->title }}</h4>
							<h5 class="">{{ $item->subtitle }}</h5>
						  </div>
					</div>
				 </a>

				@endif

	<?php 
			++$idx;
			?>
			@endforeach
      </div>


	<div class="col-xs-12 col-sm-12 col-md-8 text-center justify-content-center" style="margin-bottom:15px">
	 @if($img_f1 || $img_f2)
		 <!--{{__('messages.friends') }}-->
	 
			<h3 class="header__content__sub-title" style="color:white">{{$userprofile->titulo_amigo}}</h3><br>
	
	 @endif
	 
		<div class="col-xs-12 col-md-12 justify-content-center text-center" style="margin-bottom:15px">
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
	  </div>
	  
	  
	<div class="col-xs-12 col-md-12 text-center justify-content-center mx-auto" style="margin-bottom:15px">
	 <div id="canvas"  style="text-align:center"></div>
	  </div>
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

	
	<div class="container-fluid  foot-c">  
	 <div class="row" style="padding-left:5%; padding-right:5%;">
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
	
  </div>
		
		
</div>
</div>




		
@endsection
