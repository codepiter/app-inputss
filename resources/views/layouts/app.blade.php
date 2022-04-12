<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inputslink') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('resize', hideDivOptions);
        window.addEventListener('click', hideDivOptionsClickOutside);

        function hideDivOptions () {
            let divElem = document.getElementById('showOptions');
            divElem.style.display = "none";
        };

        function hideDivOptionsClickOutside () {
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#navbar-toggler').length && $('#showOptions').css('display')==="block")
                    document.getElementById('showOptions').style.display = "none";
            });
        };

        function showDivOptions () {
            let divElem = document.getElementById('showOptions');
            if(divElem.style.display === "none")
                divElem.style.display = "block";
            else
                divElem.style.display = "none";
        };
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


@laravelPWA

</head>
<body class="bg-login">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Input-Link') }}
                </a>
                <button onclick="showDivOptions()" id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div id="showOptions" class="Div-Options" style="display: none">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} XXX
                            </a>
                        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div> --}}
                    </li>
                    <li class="nav-item">
                        <a id="navbarDropdown" class="dropdown-item" href="{{ url('/logout') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Logout
                        </a>
                    </li>
                @endguest
            </ul>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<style>
	.bg-login{
		 background:url('/images/background/warm-save-wallpaper-dark-texture.jpg')
		no-repeat center center fixed;
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		 }
		 
	 .card{
		 background:rgba(245, 242, 242, 0.78);
	 }	 
	 .card-header{
		 background:rgba(225, 228, 232, 0.96);
		 
	 }
	.col-md-8{
		max-width:90% !important;
		padding:0px !important; 
	}

	.row{
		margin:1rem 0px !important
	}
	.container-card{
	position: relative;
    background: #000;		
	 box-shadow: 0px 35px 34px 5px rgba(0, 0, 0, 0.7);
	 padding: 0px !important;
	 border-radius: 10px;
	 max-width:95vw;
	}
	
	label, p{
		color:#fff !important;
	}
	h1{
		padding-top:1rem !important; 
		color:#fff !important;
		font-size: 1.5rem !important;	
        text-align:center;
	}
	.navbar-dark .navbar-nav .nav-link, .navbar-dark .navbar-brand  {
		color: rgba(255,255,255) !important;
		text-shadow: 2px 1px 2px black;
	}

	input{
		z-index:5;
		position:relative;
	}
	.btn-primary, .btn-link{
		z-index:3;
		position:relative;
	}
	.container-card:before{
		content: ' ';
    display: block;
    position: absolute;
	left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    opacity: 0.3;
	 border-radius: 10px;
		 background:url('/images/background/Desbloqueo.jpg');
	 background-size: cover;
	 background-position: center;
	}

    .social-buttons {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: -10px;
  padding-top:1rem;
}
.social-buttons__button {
  margin: 10px 5px 0;
}

.social-button {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  outline: none;
  width: 70px;
  height: 70px;
  text-decoration: none;
}
.social-button__inner {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: calc(70% - 2px);
  height: calc(70% - 2px);
  border-radius: 100%;
  background: #fff;
  text-align: center;
}
.social-button i,
.social-button svg {
  position: relative;
  z-index: 1;
  transition: 0.3s;
}
.social-button i {
  font-size: 28px;
}
.social-button svg {
  height: 40%;
  width: 40%;
}
.social-button::after {
  content: "";
  position: absolute;
  top: 0;
  left: 50%;
  display: block;
  width: 0;
  height: 0;
  border-radius: 100%;
  transition: 0.3s;
}
.social-button:focus, .social-button:hover {
  color: #fff!important;
}
.social-button:focus::after, .social-button:hover::after {
  width: 100%;
  height: 100%;
  margin-left: -50%;
}

.social-button--facebook {
  color: #3b5998 !important;
}
.social-button--facebook::after {
  background: #3b5998;
}
.social-button--twitter {
  color: #1da1f2 !important;
}
.social-button--twitter::after {
  background: #1da1f2;
}
.social-button--pinterest{
 color: #bd081c !important;
}
.social-button--pinterest::after {
  background: #bd081c;
}
.social-button--youtube {
 color: #ff0000 !important;
}
.social-button--youtube::after {
  background: #ff0000;
}
.social-button--instagram {
 color: #c13584 !important;
}
.social-button--instagram::after {
  background: #c13584;
}
	</style>

</body>
</html>
