<!DOCTYPE HTML>
<!--
	Minimaxing by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license 
	(html5up.net/license)
-->
<html style="background:aliceblue;">
<head>
		<title>InputsLink</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		
		 <!-- CSRF Token -->

		
		
		<meta name="csrf-token" content="{{ csrf_token() }}">
 
		<link rel="stylesheet" href="{{ asset ('css/formpaypal/style/indexmarq.css') }}" />
		<link rel="stylesheet" href="{{ asset ('css/formpaypal/minimax/main2.css') }}" />

<script src="{{ asset('css/formpaypal/carrousel/font-awesome.min.css') }}"></script>


		<script src="{{ asset('js/formpaypal/fontawesome/all.js') }}" defer></script>
		<script src="{{ asset('js/formpaypal/minimax/jquery.min.js') }}"></script>

<script src="{{ asset('js/formpaypal/afi/popper.min.js') }}"></script>
<script src="{{ asset('js/formpaypal/afi/bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/formpaypal/afi/bootstrap.min.css') }}" />






 @laravelPWA
</head>
<body>
<div id="page-wrapper">

		 
	<div id="header-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12" id="header">
				<!-- Header and left menu -->
				
					
				</div>
			</div>
		</div>
	</div><!-- Fin Header and left menu -->


	<div id="wrapper">
	 <div class="container">	
	  @yield('content')
	  @yield ('scripts')
	 </div> 	
	</div> 	
						
				
</div> 	
	


<footer>
<div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <a class="nav-link dashboard admin" href="#" aria-expanded="true" >	
				<span class="content">Términos & Condiciones</span>
			</a>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <a class="nav-link dashboard admin" href="#" aria-expanded="true">
				<span class="content">Política de Privacidad</span>
			</a>
          </div>
        </div>
      </div>
</footer>



 	<!-- Scripts minimax -->
     <!--Minimax-->
			
			<script src="{{ asset('js/minimax/browser.min.js') }}"></script>
			<script src="{{ asset('js/minimax/breakpoints.min.js') }}"></script>
			<script src="{{ asset('js/minimax/util.js') }}"></script>
			<script src="{{ asset('js/minimax/main.js') }}"></script>
	<!--Fin Minimax-->
	
	
	<script>
	
	$("#log").click( function(){
		event.preventDefault(); document.getElementById('logout-form').submit();  
	});
	
	$(document).ready(function(){
			
		$(".nav-user").append($(".li-user"));
		$(".nav-noti").append($(".li-noti"));
		
		$('.dropdown-toggle').dropdown()
		$('.collaps').collapse()
	}); 

	


	
	</script>
	</body>

	

	
</html>