@extends('menu')

@section('scripts')
	 <!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/pedidows.js') }}" defer></script>
    <link href="{{ asset('css/style/menu.css') }}" rel="stylesheet">
	    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	
@stop


@section('main')


<div class="container-fluid">


<!-- Modal resumen-->
<div style="display:none" class="modal fade" id="resumen" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="ModalLabel1" >Resumen de su pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

	
			<div class="div-pedido">

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
		
		<div class="transbox" style="background: rgba(255, 255, 255, 0.2)">
		
		<div class="row" style="text-align: center;" >
			<div class="col-md-12">
			<img class="img-fluid" src="{{ asset('storage'). '/'.$menu->logo }}"  width="{{ $menu->size_logo }}">
				<p style="text-align: center; font-weight: bold; font-family: {{ $menu->letra_font_rest }}; color: {{ $menu->color_font_rest }};" class="text-responsive">{{ $menu->restaurant }}</p>
			</div>
		</div>

<br>
		
		<div class="text-responsiveb col-md-8" >{{ __('messages.msg_central') }}</div>
<br>
		
		<div style="text-align: center;">
		 {!!QrCode::size(250)->generate("https://menu-online.dcabecera.com/menus/$menu->slug") !!}
		</div>

<br>

		<div class="row" style="text-align: center; padding:1%">
			<a class="btn btn-success" href="/menus/{{ $menu->slug }}" title="Ver Mi Menú Online" target="_blank" style="margin-left: auto; margin-right: auto; background: black;
border: 1px solid white;"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp; {{ __('messages.su_menu2') }}</a>
			

		</div>
		
<br>

		<div class="row" style="text-align: center; padding:1%">
			<a class="btn btn-success" href="/pages/{{ $menu->slug }}" title="Ver Mi Menú Online" target="_blank" style="margin-left: auto; margin-right: auto; background: black;
border: 1px solid white;"><i class="fa fa-cutlery" aria-hidden="true"></i>&nbsp; {{ __('messages.go_to_website') }}</a>
		</div>

<br>	








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













		</div>	

	</div>
	</div>
	
</div>
</div>


@endsection