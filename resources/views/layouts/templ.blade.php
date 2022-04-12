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
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
			<link rel="stylesheet" href="{{asset('css/styles.css')}}" rel="stylesheet">
		
  			<!-- Load font awesome icons -->
  			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   			<script type="text/javascript" src="{{ asset('js/qr-code-styling.js') }}"></script>
  			@laravelPWA
  	
	</head>
	<body>

  		@yield('script')  

 		@yield('main')	

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
			.website-section {
  				display: flex;
  				justify-content: space-around;
			}
  		
		  	.js-content-opacity {
    			width: 200px;
    			height: 200px;
    			background: linear-gradient(#e29587, #d66d75);
    			box-shadow: 6px 6px 0 rgba(black, 0.1);
    			transition: all .2s;
  			}

			canvas {
				margin-left:auto;
				margin-right:auto;
				width: -webkit-fill-available;
				max-width:250px;
    			padding:1%;
				border-radius:3%;
			}
			
			.transition {
  				-webkit-transition: all 500ms ease-in-out;
  				-moz-transition: all 500ms ease-in-out;
  				-ms-transition: all 500ms ease-in-out;
  				-o-transition: all 500ms ease-in-out;
			}

			.div-img {
  				display: block;
  				margin-left: auto;
  				margin-right: auto;
			}
			
			.div-img .img {
  				display: block;
  				margin-left: auto;
  				margin-right: auto;
  				width: 100%;
  				-webkit-transform: 0px 0px 1;
  				-moz-transform: 0px 0px 1;
  				-ms-transform: 0px 0px 1;
  				-o-transform: 0px 0px 1;
  				transform: 0px 0px 1;
  				transform: translate(0px, 0px) scale(1);
  				-webkit-transform: translate(0px, 0px) scale(1);
  				-moz-transform: translate(0px, 0px) scale(1);
  				-o-transform: translate(0px, 0px) scale(1);
  				-ms-transform: translate(0px, 0px) scale(1);
  				-webkit-transition: all 0s ease 0s;
  				-moz-transition: all 0s ease 0s;
  				-o-transition: all 0s ease 0s;
  				transition: all 0s ease 0s;
  				-webkit-transition: all 500ms ease-in-out;
  				-moz-transition: all 500ms ease-in-out;
  				-ms-transition: all 500ms ease-in-out;
  				-o-transition: all 500ms ease-in-out;
			}
			
			.div-img .text {
				text-shadow: 1px 1px white;
				max-width: 60%;
			    margin-left: auto;
    			margin-right: auto;	
  				opacity:0;
  				font-family: 'Open Sans';
  				position: relative;
  				z-index: -1;
  				display: block;
  				bottom: 20px;
  				width: 100%;
  				text-align: center;
  				-webkit-transform: 0px 0px 1;
  				-moz-transform: 0px 0px 1;
  				-ms-transform: 0px 0px 1;
  				-o-transform: 0px 0px 1;
  				transform: 0px 0px 1;
  				transform: translate(0px, 0px) scale(1);
  				-webkit-transform: translate(0px, 0px) scale(1);
  				-moz-transform: translate(0px, 0px) scale(1);
  				-o-transform: translate(0px, 0px) scale(1);
  				-ms-transform: translate(0px, 0px) scale(1);
  				-webkit-transition: all 0s ease 0s;
  				-moz-transition: all 0s ease 0s;
  				-o-transition: all 0s ease 0s;
  				transition: all 0s ease 0s;
  				-webkit-transition: all 500ms ease-in-out;
  				-moz-transition: all 500ms ease-in-out;
  				-ms-transition: all 500ms ease-in-out;
  				-o-transition: all 500ms ease-in-out;
			}
			
			.div-img:hover .img {
  				-webkit-transform: 0px -30px 0.5;
  				-moz-transform: 0px -30px 0.5;
  				-ms-transform: 0px -30px 0.5;
  				-o-transform: 0px -30px 0.5;
  				transform: 0px -30px 0.5;
  				transform: translate(0px, -30px) scale(0.5);
  				-webkit-transform: translate(0px, -30px) scale(0.5);
  				-moz-transform: translate(0px, -30px) scale(0.5);
  				-o-transform: translate(0px, -30px) scale(0.5);
  				-ms-transform: translate(0px, -30px) scale(0.5);
  				border-radius: 50%;
			}

			.div-img:hover .text {
				opacity:1;
  				-webkit-transform: 0px 0px 2;
  				-moz-transform: 0px 0px 2;
  				-ms-transform: 0px 0px 2;
  				-o-transform: 0px 0px 2;
  				transform: 0px 0px 2;
  				transform: translate(0px, -30px) scale(2);
  				-webkit-transform: translate(0px, -30px) scale(2);
  				-moz-transform: translate(0px, -30px) scale(2);
  				-o-transform: translate(0px, -30px) scale(2);
  				-ms-transform: translate(0px, -30px) scale(2);
			}

			/* effect-shine */
			.effect-shine:hover {
				-webkit-mask-image: linear-gradient(-75deg, rgba(0,0,0,.6) 30%, #000 50%, rgba(0,0,0,.6) 70%);
				-webkit-mask-size: 200%;
				animation: shine 2s infinite;
			}

			@-webkit-keyframes shine {
				from {
					-webkit-mask-position: 150%;
				}
			
				to {
					-webkit-mask-position: -50%;
				}
			}

			.fade-in-image {
				animation: fadeIn 5s;
				-webkit-animation: fadeIn 5s;
				-moz-animation: fadeIn 5s;
				-o-animation: fadeIn 5s;
				-ms-animation: fadeIn 5s;
			}

			@keyframes fadeIn {
				0% {opacity:0;  transform: translateY(-20px);}
				100% {opacity:1; transform: translateY(0px);}
			}

			@-moz-keyframes fadeIn {
				0% {opacity:0;  transform: translateY(-20px);}
				100% {opacity:1; transform: translateY(0px);}
			}

			@-webkit-keyframes fadeIn {
				0% {opacity:0;  transform: translateY(-20px);}
				100% {opacity:1; transform: translateY(0px);}
			}

			@-o-keyframes fadeIn {
				0% {opacity:0;  transform: translateY(-20px);}
				100% {opacity:1; transform: translateY(0px);}
			}

			@-ms-keyframes fadeIn {
				0% {opacity:0;  transform: translateY(-20px);}
				100% {opacity:1; transform: translateY(0px);}
			}

			/* Circle */
			.enlace {
				height:auto;
				position: relative;
			}

			.enlace::before {
				position: absolute;
				top: 50%;
				left: 50%;
				z-index: 2;
				display: block;
				content: '';
				width: 0;
				height: 0;
				background: rgba(255,255,255,.4);
				border-radius: 100%;
				-webkit-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
				opacity: 0;
			}

			.enlace:hover::before {
				-webkit-animation: circle .75s;
				animation: circle .75s;
			}

			@-webkit-keyframes circle {
				0% {
					opacity: 1;
				}
				40% {
					opacity: 1;
				}
				100% {
					width: 150%;
					height: 150%;
					opacity: 0;
				}
			}

			@keyframes circle {
				0% {
					opacity: 1;
				}
				40% {
					opacity: 1;
				}
				100% {
					width: 150%;
					height: 150%;
					opacity: 0;
				}
			}

			.der {
				animation: moveToRight 2s ease-in-out;
			}

			@keyframes moveToRight {
				0% {
					transform: translateX(-120px);
				}
				100% {
					transform: translateX(0px);
				}
			}

			.izq {
				animation: moveToLeft 2s ease-in-out;
			}

			@keyframes moveToLeft {
				0% {
					transform: translateX(120px);
				}
				100% {
					transform: translateX(0px);
				}
			}
		</style>
	</body>
</html>  