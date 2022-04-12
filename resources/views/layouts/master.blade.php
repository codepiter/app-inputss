<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Admin Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Soeng Souy" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{URL::to('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{URL::to('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/bootstrap/css/bootstrap.min.css')}}">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{URL::to('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/icon/icofont/css/icofont.css')}}">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/font-awesome-n.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/font-awesome.min.css')}}">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/jquery.mCustomScrollbar.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/style.css')}}">

    <!-- @ y i e l d ( ' s t y l e s ')-->
	
	@laravelPWA
	
	

	
	
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
						<!--
						<a href="index.html">
                            <img class="img-fluid" src="{{URL::to('assets/images/logo.png')}}" alt="Theme-Logo" />
                        </a>-->
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                           
						   <!--<li class="header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-red"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="{URL::to('assets/images/avatar-2.jpg')}}" alt="Generic placeholder image">

                                            <div class="media-body">
                                                <h5 class="notification-user">Soeng Souy</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>-->
							
                            <li class="user-profile header-notification">

								
								<a href="#!" class="waves-effect waves-light">

@isset(Auth::user()->userProfile->logo)
								    @if(Auth::user()->userProfile->logo)
								    <img class="img-radius" src="{{ asset('/storage/uploads'). '/'.Auth::user()->userProfile->logo}}" alt="" width="">
								     @else
								    <img src="{{asset('/assets/images/avatardefault_92824.png')}}" class="img-radius" alt="img">
								     @endif
@endisset



@isset(Auth::user()->userProfile->name)
                                    <span> {{Auth::user()->userProfile->name}}</span>
@endisset
									<i class="ti-angle-down"></i>

									
                                </a>

								
								<ul class="show-notification profile-notification">
                                     <!--
									<li class="waves-effect waves-light">
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li>-->
									
                                    <li class="waves-effect waves-light">
                                        <a href="{{ route('editprofile') }}">
                                            <i class="ti-user"></i> <!--Perfil-->{{__('messages.profile') }}
                                        </a>
                                    </li>
                                  
								  <!--
								   <li class="waves-effect waves-light">
                                        <a href="email-inbox.html">
                                            <i class="ti-email"></i> My Messages
                                        </a>
                                    </li>-->
									
									
									
                                    <li class="waves-effect waves-light">
                                        
										
										  <a class="dropdown-item text-danger not-render" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off fa-fw"></i>&nbsp;&nbsp;&nbsp;&nbsp;<!--Salir-->{{__('messages.logout') }}
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
									</form>
										
										
										
										
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    
									
									
                                    @isset(Auth::user()->userProfile->logo)
									    @if(Auth::user()->userProfile->logo)
								            <img class="img-80 img-radius" src="{{ asset('/storage/uploads'). '/'.Auth::user()->userProfile->logo}}" alt="" width="">
									    @else
									        <img class="img-80 img-radius" src="{{URL::to('assets/images/avatardefault_92824.png')}}" alt="img">
									    @endif
                                    @endisset
                                    <div class="user-details">
                                        @isset(Auth::user()->userProfile->name)
										    <span id="more-details">{{Auth::user()->userProfile->name}}<i class="fa fa-caret-down"></i>
										    </span>
                                        @endisset
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="{{ route('editprofile') }}"><i class="ti-user"></i><!--Edite Perfil-->{{__('messages.edit_profile') }}</a>
                                           <!-- <a href="#!"><i class="ti-settings"></i>Settings</a>-->
                                           
									<a class="dropdown-item text-danger not-render" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off fa-fw"></i>&nbsp;&nbsp;&nbsp;&nbsp;<!--Salir-->{{__('messages.logout') }}
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
									</form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
							<!--<div class="p-15 p-b-0">
                                <form class="form-material">
                                    <div class="form-group form-primary">
                                        <input type="text" name="footer-email" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Friend</label>
                                    </div>
                                </form>
                            </div>-->
							
                            <div class="pcoded-navigation-label"><!--Navegación-->{{__('messages.navegation') }}</div>
                            <ul class="pcoded-item pcoded-left-item">
                                @if (Auth::user()->userProfile)
                                    <li class="active">
                                        <a href="{{ URL::to(Auth::user()->userProfile->slug) }}" class="waves-effect waves-dark" target="_blank">
                                            <span class="pcoded-micon"><i class="ti-id-badge"></i><b>D</b></span>
                                            <span class="pcoded-mtext">{{__('messages.my_inputslink') }}</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <!--<ul class="pcoded-submenu"></ul>-->
                                    </li>
                                @endif
                                <li class="@if(Route::is('home')) active @endif">
                                    <a href="{{ route('home') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <!--<ul class="pcoded-submenu"></ul>-->
                                </li>
                                
                            </ul>

                            @can('viewAny', App\Models\Ads\Advertising::class)
                                <div class="pcoded-navigation-label"><!--Opciones-->Administrador</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="@if(Route::is('admin.ads.index') || Route::is('admin.advertising.*'))active @endif">
                                        <a href="{{route('admin.ads.index')}}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-announcement"></i><b>D</b></span>
                                            <span class="pcoded-mtext"><!--Advertisements-->{{__('messages.advertisements') }}</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class="@if(Route::is('admin.user.index') || Route::is('admin.user.*'))active @endif">
                                        <a href="{{route('admin.user.index')}}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fa fa-users"></i><b>D</b></span>
                                            <span class="pcoded-mtext"><!--Users-->{{__('messages.users') }}</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            @endcan

                            <div class="pcoded-navigation-label"><!--Opciones-->{{__('messages.options') }}</div>
                            <ul class="pcoded-item pcoded-left-item">
                               <!--
							   <li class="">
                                    <a href="" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Form</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>-->
                                </li>
				
				
				              @if(Auth::user()->nimda_si==1)
							   <li class="">
                                    <a href="{{ route('userprofiles.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>IL</b></span>
                                        <span class="pcoded-mtext"><!--Users-->{{__('messages.users') }}</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
							   @endif						
								
							    <li class="pcoded-hasmenu">
                                    <a href="#" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-link"></i><b>IL</b></span>
                                        <span class="pcoded-mtext">Mis InputsLink</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="{{ route('inputlinks.index') }}" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-layers"></i><b>-></b></span>
                                                <span class="pcoded-mtext">{{__('messages.links') }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                @isset(Auth::user()->userProfile->type_plan)
                                    @if(Auth::user()->userProfile->type_plan == 'pro')
                                        <li class="">
                                            <a href="{{ route('stadistics.index') }}" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-stats-up"></i></span>
                                                <span class="pcoded-mtext">{{__('messages.stadistics') }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endif
                                @endisset
                                

                                <li class="">
                                    <a href="{{ route('codigoqrs.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>RT</b></span>
                                        <span class="pcoded-mtext">{{__('messages.qr') }}</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="pcoded-hasmenu">
                                    <a href="#" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-shopping-cart"></i><b>IL</b></span>
                                        <span class="pcoded-mtext">{{__('messages.easy_sell')}}</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="{{ route('inputlinks.comercialVideo') }}" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-layers"></i><b>-></b></span>
                                                <span class="pcoded-mtext">{{__('messages.sell_video') }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('inputlinks.comercialImage') }}" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-layers"></i><b>-></b></span>
                                                <span class="pcoded-mtext">{{__('messages.sell_image') }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                @isset(Auth::user()->userProfile->type_plan)
                                    @if(Auth::user()->userProfile->type_plan == 'pro')
                                        <li class="pcoded-hasmenu">
                                            <a href="#" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-bar-chart"></i><b>IL</b></span>
                                                <span class="pcoded-mtext">{{__('messages.my_marketing')}}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="{{ route('leads.index') }}" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>-></b></span>
                                                        <span class="pcoded-mtext">{{__('messages.my_leads') }}</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('suscription.sms') }}" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>-></b></span>
                                                        <span class="pcoded-mtext">{{__('messages.my_subscriptions_sms') }}</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('suscription.email') }}" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>-></b></span>
                                                        <span class="pcoded-mtext">{{__('messages.my_subscriptions_email') }}</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                @endisset
								
                            </ul>
                            <div class="pcoded-navigation-label"></div>
                            <ul class="pcoded-item pcoded-left-item">
                                @isset(Auth::user()->userProfile->type_plan)	
	                                @if(Auth::user()->userProfile->type_plan=='pro')
								        <li class="">
										    <a href="{{ route('customers.index') }}" class="disabled waves-effect waves-dark">
											    <span class="pcoded-micon"><i class="ti-money"></i><b>-></b></span>
											    <span class="pcoded-mtext">{{__('messages.monetize_links') }}</span>
											    <span class="pcoded-mcaret"></span>
										    </a>
									    </li>
	                                @endif
                                @endisset

                                @isset(Auth::user()->userProfile->type_plan)	
	                                @if(Auth::user()->userProfile->type_plan=='pro')
								        <li class="">
										    <a href="{{ route('customers.index') }}" class="waves-effect waves-dark">
											    <span class="pcoded-micon"><i class="ti-lock"></i><b>-></b></span>
											    <span class="pcoded-mtext">{{__('messages.vip') }}</span>
											    <span class="pcoded-mcaret"></span>
										    </a>
									    </li>
	                                @endif
                                @endisset

                                @isset(Auth::user()->userProfile->type_plan)	
	                                @if(Auth::user()->userProfile->type_plan=='pro')
								        <li class="">
										    <a href="{{ route('premium.index') }}" class="waves-effect waves-dark">
											    <span class="pcoded-micon"><i class="ti-crown"></i><b>-></b></span>
											    <span class="pcoded-mtext">{{__('messages.premium_content') }}</span>
											    <span class="pcoded-mcaret"></span>
										    </a>
									    </li>
	                                @endif
                                @endisset

                                @isset(Auth::user()->userProfile->type_plan)	
	                                @if(Auth::user()->userProfile->type_plan=='pro')
								        <li class="">
										    <a href="{{ route('customers.index') }}" class="disabled waves-effect waves-dark">
											    <span class="pcoded-micon"><i class="ti-eye"></i><b>-></b></span>
											    <span class="pcoded-mtext">{{__('messages.sensitive_content') }}</span>
											    <span class="pcoded-mcaret"></span>
										    </a>
									    </li>
	                                @endif
                                @endisset
                            </ul>
                        </div>
											
						
                    </nav>
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10"><!--Panel-Administrativo-->{{__('messages.admin_panel') }}</h5>
                                            <p class="m-b-0"><!--Bienvenido a Input-Link-->{{__('messages.welcome') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('home') }}">{{__('messages.panel') }}</a>
                                            </li>
		                                    @isset(Auth::user()->userProfile->slug)
			                                    @if(Auth::user()->userProfile->slug != "")
											        <li class="breadcrumb-item">
                                                        <a href="{{ URL::to(Auth::user()->userProfile->slug) }}"  target="_blank">{{__('messages.my_inputslink') }}</a>
											        </li>
			                                    @endif
		                                    @endisset
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						
						
                        <!-- Page-header end -->
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{URL::to('assets/js/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/js/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/js/popper.js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- waves js -->
    <script src="{{URL::to('assets/pages/waves/js/waves.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{URL::to('assets/js/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{URL::to('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- menu js -->
    <script src="{{URL::to('assets/js/pcoded.min.js')}}"></script>
    <script src="{{URL::to('assets/js/vertical/vertical-layout.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/js/script.js')}}"></script>




	<!--sort-->

	<!--sort-->
	

    @yield('script')

</body>
</html>
