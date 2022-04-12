@extends('menu')



@section('scripts')
	 <!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/pedidows.js') }}" defer></script>
    <script src="{{ asset('js/search.js') }}" defer></script>
    <link href="{{ asset('css/style/menu.css') }}" rel="stylesheet">
	<link href="{{ asset ('css/style/indexmarq.css') }}" rel="stylesheet" />
	    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<style>


  .rating-group {
    display: inline-flex;
  }
  
  /* make hover effect work properly in IE */
  .rating__icon {
    pointer-events: none;
  }
  
  /* hide radio inputs */
  .rating__input {
   position: absolute !important;
   left: -9999px !important;
  }
  
  /* hide 'none' input from screenreaders */
  .rating__input--none {
    display: none
  }

  /* set icon padding and size */
  .rating__label {
    cursor: pointer;
    padding: 0 0.1em;
    font-size: 2rem;
  }
  
  /* set default star color */
  .rating__icon--star {
    color: orange;
  }

  /* if any input is checked, make its following siblings grey */
  .rating__input:checked ~ .rating__label .rating__icon--star {
    color: #ddd;
  }
  
  /* make all stars orange on rating group hover */
  .rating-group:hover .rating__label .rating__icon--star {
    color: orange;
  }

  /* make hovered input's following siblings grey on hover */
  .rating__input:hover ~ .rating__label .rating__icon--star {
    color: #ddd;
  }


</style>	
@stop


@section('main')


<div class="container-fluid" id="content-id">

<div class="ui-block-b" style="position:fixed; top:30px; right:10px; z-index:9999">
	<div class="input-group">

	  <input name="text-12" id="text-12" value="" type="text" class="textSearchvalue_h" />
	  <div class="input-group-btn">
		<button class="btn btn-default"  href="#" class="searchButtonClickText_h" type="button">Buscar</button>
	  </div>

	</div>
</div>

<!-- Modal confirmacion-->
<div class="modal fade" id="confirmaritem" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="display:none">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="ModalLabel" >{{ __('messages.sure') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

		<form id="Invitado">
			<div class="form-row">
				<div class="form-group col-md-8" style="margin-left: auto; margin-right: auto;">
					 <input  readOnly id="lab-pedido" style="border:none; width: -webkit-fill-available;">			
					 <input type="hidden"  id="plat" style="border:none">			
					 <input type="hidden"   id="cant" style="border:none">			
					 <input type="hidden"   id="precio" style="border:none">			
				</div>
			</div>
		</form>
			

		</div>
      <div class="modal-footer">
	  		 
			<button type="button" class="btn btn-primary" id="modal-btn-si">{{ __('messages.accept') }}</button>
			<button type="button" class="btn btn-primary" id="modal-btn-no">{{ __('messages.cancel') }}</button>

      </div>
    </div>
  </div>
</div>


<!-- Modal resumen-->
<div style="display:none" class="modal fade" id="resumen" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="ModalLabel1" >{{ __('messages.res_order') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

	
			<div class="div-pedido">

			</div>
	
			

		</div>
      <div class="modal-footer">
	  		 
			<a href="tel:+{{ $menu->whatsapp }}" type="button" class="btn btn-outline-primary" id="">{{ __('messages.call') }}&nbsp;<img src="{{URL::asset('/img/telefono2.png')}}" alt="Llamar" width="30" ></a>
			
			<button type="button" class="btn btn-outline-primary" id="modal-btn-sis">{{ __('messages.sms') }}&nbsp;<img src="{{URL::asset('/img/sms.png')}}" alt="Sms" width="30"></button>
			
			<button type="button" class="btn btn-outline-primary" id="modal-btn-sia">{{ __('messages.whatsapp') }}&nbsp;<img src="{{URL::asset('/img/whatsapp2.png')}}" alt="Whatsapp" width="30"></button>
			
			<button type="button" class="btn btn-outline-danger" id="modal-btn-noa">{{ __('messages.cancel') }}&nbsp;</button>

      </div>
    </div>
  </div>
</div>


<!-- Modal Comment-->
<div style="display:none" class="modal fade" id="comentar" tabindex="-1" role="dialog" aria-labelledby="ModalLabelcom" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="ModalLabelcom" >{{ __('messages.your_comment') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

		<div class="row">

			<div class="container">
				<h3>{{ __('messages.send_comment') }}</h3>


				
				<div class="row">
				
					<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				
					<input class="form-control" name="menu_id" id="menu_id" type="hidden" value="{{ $menu->id }}">
					
					<input type="hidden" value="{{$menu->currency->Symbol}}"id="ty-currency">

					
					  <div class="col-md-8 mx-auto">
							<div class="form-group" style="margin-top: 10px;">
								<h4><strong>{{ __('messages.email') }}:</strong></h4>
							 <input class="form-control" name="email" id="mail" type="text">
							</div>
						</div>

						<div class="col-md-8 mx-auto">
							<div class="form-group" style="margin-top: 10px;">
								<h4><strong>{{ __('messages.name') }}:</strong></h4>
							 <input class="form-control" name="name" id="nam" type="text">
							</div>
						</div>

					   
				</div>

				<div class="row rating-group">
				
					<input disabled checked class="rating__input rating__input--none" name="rating" id="rating3-none" value="0" type="radio">
					<label aria-label="1 star" class="rating__label" for="rating3-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
					<input class="rating__input" name="rating" id="rating3-1" value="1" type="radio">
					<label aria-label="2 stars" class="rating__label" for="rating3-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
					<input class="rating__input" name="rating" id="rating3-2" value="2" type="radio">
					<label aria-label="3 stars" class="rating__label" for="rating3-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
					<input class="rating__input" name="rating" id="rating3-3" value="3" type="radio">
					<label aria-label="4 stars" class="rating__label" for="rating3-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
					<input class="rating__input" name="rating" id="rating3-4" value="4" type="radio">
					<label aria-label="5 stars" class="rating__label" for="rating3-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
					<input class="rating__input" name="rating" id="rating3-5" value="5" type="radio">
				</div>

				<div class="row">
					<div class="col-md-8 mx-auto">
						<label><h4><strong>{{ __('messages.commentary') }}:</strong></h4></label><br>
						<textarea name="comment" style="width: -webkit-fill-available; text-align:justify" id="come">
						</textarea>
					</div>
				</div>

	
			</div>


			</div>
			

		</div>
      <div class="modal-footer">
	  		 
			<button type="button" class="btn btn-primary" id="si-comment">{{ __('messages.accept') }}</button>
			<button type="button" class="btn btn-primary" id="no-comment">{{ __('messages.cancel') }}</button>

      </div>
    </div>
  </div>
</div>


<!-- Modal Comment Thank-->
<div style="display:none" class="modal fade" id="thank" tabindex="-1" role="dialog" aria-labelledby="ModalLabelth" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="ModalLabelth" >{{ __('messages.thank') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

		<div class="row">

			<div class="container">
				<h3>{{ __('messages.thank_your_comment') }}</h3>
	
			</div>


			</div>
			

		</div>

    </div>
  </div>
</div>



	<div>
	


		@if($menu->fondo)
			<div class="bg" style="background-image:url('{{ asset('storage'). '/'.$menu->fondo}}');">
		@else
			<div class="bg">
		@endif
		

		
				
		<div style="text-align:end;background: rgba(255, 255, 255, 0.2)">
			<div class="dropdown">
			  <button class="dropbtn"><img src="{{URL::asset('/img/logo/traducir.png')}}" alt="Ver" height="22" width="auto"  ></button>
			  <div class="dropdown-content">
				<a href="{{ url('locale/en') }}"> EN - <img src="{{URL::asset('/img/flags/unitedstates_flags_flag_8833.png')}}" alt="Edit"  width="auto" height="20"></a>
				<a href="{{ url('locale/fr') }}">FR - <img src="{{URL::asset('/img/flags/france_flags_flag_8995.png')}}" alt="Edit"  width="auto" height="20"></a>
				<a href="{{ url('locale/es') }}">ES - <img src="{{URL::asset('/img/flags/Spain_flags_flag_8858.png')}}" alt="Edit" width="auto" height="20"></a>
				<a href="{{ url('locale/it') }}">IT - <img src="{{URL::asset('/img/flags/Italy_29749.png')}}" alt="Edit"  width="auto" height="20"></a>
				<a href="{{ url('locale/pt_BR') }}">PT - <img src="{{URL::asset('/img/flags/brazil.png')}}" alt="Edit" width="auto" height="20"></a>
				<a href="{{ url('locale/zh_CN') }}">CN - <img src="{{URL::asset('/img/flags/FlagChineseFlag_banderadechina_6561.png')}}" alt="Edit" width="auto" height="20"></a>
			
			  </div>
			</div>
		</div>




		<div class="transbox" style="background: rgba(255, 255, 255, 0.2)">
		
		<div class="row" style="text-align: center;" >
			<div class="col-md-12">
			<img class="img-fluid" src="{{ asset('storage'). '/'.$menu->logo }}"  width="{{ $menu->size_logo }}" style="max-width:20vw">
				<p style="text-align: center; font-weight: bold; font-family: {{ $menu->letra_font_rest }}; color: {{ $menu->color_font_rest }}; font-size: {{ $menu->sze_font_rest }}">{{ $menu->restaurant }}</p>
			</div>
		</div>



		@foreach ($categorias as $cat) 

		

			<?php $idx = 1; ?>

		@foreach ($tabbed_menus as $item)
		

			
		@if(($cat->id) == ($item->category_id))
					
		@if(($idx) == 1)
			<div class="row" style="text-align: center;" >
				<div class="col-md-12">
				@if($cat->name_c)
					<p style="text-align: center; font-weight: bold; font-family: {{ $menu->letra_title }}; color: {{ $menu->color_font_title}}; font-size: {{ $menu->size_font_title }}">{{ $cat->name_c }} </p>
				@endif
	
				</div>
			</div>
		@endif
		
					<?php 
						$idx++; 
						if($idx%2 == 0){
					?>
					
						<div class="row item" >

							<div class="col-md-3">
								<img class="img-fluid" style="margin: 10px; border-radius: {{$menu->forma}};" src="{{ asset('storage'). '/'.$item->photo1 }}" >
							</div>
							<div class="col-md-6" >
								<div class="col-md-12 title" style="text-align: center; font-weight: bold; font-family: {{ $menu->letra_title }}; color: {{ $menu->color_font_title }}; font-size: {{ $menu->size_font_title }}">
									{{ $item->title }} 
									
								</div>
								<div class="col-md-12" style="text-align: center; font-weight: bold; font-family: {{ $menu->letra_descr }}; color: {{ $menu->color_font_descr }}; font-size: {{ $menu->size_font_descr }}">
									{{ $item->description }}
								</div>	
							</div>
							<div class="col-md-3 precio" style="text-transform:Uppercase; text-align: center; align-self: center; font-weight: bold; font-family: {{ $menu->letra_price }}; color: {{ $menu->color_font_price }}; font-size: {{ $menu->size_font_price }}">
								{{ $item->price }} {{$item->menu->currency->Symbol}}
							</div>
							
							<div class="product-overlay" >							
								<div class="vcenter">
									<div class="centrize">
										<ul class="list-unstyled list-group">
											<li>
												
													<input type="text" value="1" name="quantity"  class="cantidad number"/><br>
													<input type="hidden" name="product" class="producto" value="{{ $item->title }}">
													<input type="hidden" name="pric" class="pric" value="{{ $item->price }}">
													<br>&nbsp;
													<button id="add-to-cart-btn" type="button" class="btn btn-warning pedido" data-toggle="modal" data-target="#cart-modal"> <i class="fa fa-cart-plus"></i> {{ __('messages.add_list') }}</button><br>&nbsp;
											
											</li>
											
											
										</ul>
									</div>
								</div>
							</div>
						</div>	
						
					<?php 
					 }else{
					?>
					
						<div class="row item" >
							<div class="col-md-3 precio" style="text-transform:Uppercase; text-align: center;  align-self: center; font-weight: bold; font-family: {{ $menu->letra_price }}; color: {{ $menu->color_font_price }}; font-size: {{ $menu->size_font_price }}">
								{{ $item->price }} {{$item->menu->currency->Symbol}}
							</div>
							<div class="col-md-6" >
								<div class="col-md-12 title" style="text-align: center; font-weight: bold; font-family: {{ $menu->letra_title }}; color: {{ $menu->color_font_title }}; font-size: {{ $menu->size_font_title }}">
									{{ $item->title }}
									
								</div>
								<div class="col-md-12" style="text-align: center; font-weight: bold; font-family: {{ $menu->letra_descr }}; color: {{ $menu->color_font_descr }}; font-size: {{ $menu->size_font_descr }}">
									{{ $item->description }}
								</div>	
								
							</div>

							<div class="col-md-3">
								<img style="margin: 10px; border-radius: {{$menu->forma}};" class="img-fluid" src="{{ asset('storage'). '/'.$item->photo1 }}" >
							</div>
							
							<div class="product-overlay" >							
								<div class="vcenter">
									<div class="centrize">
										<ul class="list-unstyled list-group">
											<li>
												
													<input type="text"  name="quantity"  class="cantidad number" value="1"/><br>
													<input type="hidden" name="product" class="producto" value="{{ $item->title }}">
													<input type="hidden" name="pric" class="pric" value="{{ $item->price }}">
													<br>&nbsp;
													<button id="add-to-cart-btn" type="button" class="btn btn-warning pedido" data-toggle="modal" data-target="#cart-modal"> <i class="fa fa-cart-plus"></i> {{ __('messages.add_list') }}</button><br>&nbsp;
											
											</li>
							
											
										</ul>
									</div>
								</div>
							</div>
							

						</div>
					
					<?php 
						}
					?>
					
			
				@endif

			@endforeach
		
		
		@endforeach
		
	
		
		<div class="row">
			<!--
			<div class="col-md-6">
			</div>-->
			
			
			<div class="col-md-12" style="text-align: right;  font-weight: bold; font-family: {{ $menu->letra_font_add }}; color: {{ $menu->color_font_add }}; font-size: {{ $menu->sze_font_add }}">
				
				
				
				
				
				
				
				
				
				
				
				
				
				<div class="contenedor">
				  <div class="animacion" >  {{ $menu->address }} </div>
				</div>
				
		











		
				
				
				<input type="hidden" value="{{ $menu->whatsapp }}" id="tlf">
				<input type="hidden" value="{{ $menu->restaurant }}" id="rest">
			</div>
		</div>
		<br><div class="row">
		<button type="button" class="btn btn-warning" id="ws" style="margin-left: auto; margin-right: auto;"> <i class="fa fa-cart-plus"></i>&nbsp; {{ __('messages.send_order') }}</button>

		
		<a href="" class="btn  btn-warning" id="sms" style="display:none"></a>
		</div>	
		
		
		
		
		
		<br>
	           <strong>
				<p class="recom" style="text-align: -webkit-center;">{{ __('messages.recommend_me') }}</p>
			   </strong>


	<div class="col-md-12">
			  <div class="rs" style="text-align: -webkit-center;">
						 
						 <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fthefush.com%2F&amp;src=sdkpreparse" target="_blank">
						 <img src="{{URL::asset('/img/facebookx.png')}}" style="width: 50px;"></a>&nbsp;
						 
						 <a href="https://api.whatsapp.com/send?text=hola%20te%20comparto%20este%20menu%20del%20restaurant{{ $menu->restaurant }} :%20{{ Request::url() }}" target="_blank">
						 <img src="{{URL::asset('/img/whatsapp2.png')}}" style="width: 50px;"></a>&nbsp;
					 


					 <a href="sms:?body=Hola te comparto este menu esta genial del restaurant {{ $menu->restaurant }}: {{ Request::url() }}">
					      <img src="{{URL::asset('/img/sms.png')}}" style="width: 50px;">
					 </a>&nbsp;


				 </div>
				
		</div>
		

		
		
		
				
		@if($menu->url_map)
		<br><div style="text-align: center;">
		{!! $menu->url_map !!}
		</div>
		@endif
		
			
			<div class="row mx-auto">
				<button type="button" class="btn btn-warning" id="comment" style="margin-left: auto; margin-right: auto;"> <i class="fa fa-comment"></i>&nbsp; {{ __('messages.leave_com') }}</button>
		
			</div>
		</div>	

	</div>
	</div>
	
</div>
</div>


@endsection