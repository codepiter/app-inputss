<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
  		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1" />
  		<!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">
  		@yield('head')

  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"rel="stylesheet">
  		<link rel="stylesheet" href="{{asset('assets/fonts/flat-icon/flaticon.css')}}"rel="stylesheet">
  		<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}"rel="stylesheet">
  		<link rel="stylesheet" href="{{asset('css/styles.css')}}" rel="stylesheet">
  		<!-- Load font awesome icons -->
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   		<script src="{{ asset('js/qr-code-styling.js') }}"></script>
  		@laravelPWA
	</head>
	<body>
  		@yield('script')  
 		@yield('main')
  		
		<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
		<script type="text/javascript">
			url = document.getElementById("url");
		  	width = document.getElementById("width");
		  	height = document.getElementById("height");
		  	color = document.getElementById("color");
		  	typedots = document.getElementById("typedots");
		  	background = document.getElementById("background");	  
		  	qrImage = document.getElementById('qrImage');
		
			if(qrImage.value == "") {
				image="";
			} else {
				path="/storage/uploads/";
				img = qrImage.value;	
				image = path+img;
			}
				
			const qrCode = new QRCodeStyling({
				width: 350,
				height: 350,
				margin:150,
				data: url.value,
				image: image,
				dotsOptions: {
					color: color.value,
					type: typedots.value
				},
				backgroundOptions: {
					color: background.value,
				},	
				imageOptions: {
					crossOrigin: "anonymous",
					margin: 5
				},
			});

			x=qrCode.append(document.getElementById("canvas"));
			canv = document.querySelector('#canvas canvas');
		 
		  	if(background.value != "") {
			  	canv.style.backgroundColor = background.value;
		  	}
		</script>
	
		<script>
			$( document ).ready(function() {
	
				$(".modal").on("contextmenu",function(e){
					return false;
				});
				$("#match").css('display', 'none');
		
				if($('#check').val() == "on"){
					$("#priv").modal('show');
					$("#priv").css('background','black');
				} else {
					$("#priv").modal('hide');
					$("#priv").css('background','#00000000');
					$("#fade").css('background', '#00000000');
					$("#fade").css('display', 'none');
				}		

				$('#submit').on('click', function(){
					var tok = $('meta[name="csrf-token"]').attr('content');
					var email = $('#email').val();
					var password = $('#password').val();
					var id_up = $('#id_up').val();
					$.ajax({
						type:'POST',
						url: '/userprofiles/verifyPrivate',
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						data: {
							_token : tok,
							email: email,
							password: password,
							id_up: id_up,
						},
						success:function(response){
							if(response == 1){
								$("#priv").modal('hide');
								$("#fade").css('background', '#00000000');
								$("#fade").css('display', 'none');			   
							} else {
								$("#priv").modal('show');
								$('#password').val("");
								$('#email').val("");
								$("#match").css('display', 'block');
								$("#match").css('color', 'red');
							}
						}, error: function (response) {
						}
					});
				});
			});
		</script>
		<style type="text/css">
			canvas {
				margin-left:auto;
				margin-right:auto;
				width: -webkit-fill-available;
				max-width:250px;
    			padding:1%;
				border-radius:3%;
			}
		</style>
	</body>
</html>  