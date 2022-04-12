@extends('layouts.master')
@section('script')

<script src="{{ asset('js/customjs.js') }}" defer></script>

<script>
  $(document).ready(function() {
    $("#video").css( "display","none" );
    $("#span").css( "display","none" );
    document.getElementById('music').style.display= "none";
    document.getElementById('span').style.display= "none";
  });

  let checkbox2 = document.getElementById('checkbox2');
  let checkbox = document.getElementById('checkbox');
  const checkPremium = document.getElementById('premium');

  $("#checkbox").on('change', function() {
    if(checkbox2.checked)
      checkbox2.checked = !checkbox2.checked;

    if (parseInt(checkPremium.value))
      checkPremium.value = 0;

    if( $(this).is(':checked') ) {				
		  $("#checkbox2").prop('checked',false);		
      document.getElementById('music').style.display= "none";
      $("#video").css( "display","block" );
		  $("#span").css( "display","block" );
		  $("#url").css( "display","none" );
		  $("#subtitle").css( "display","none" );
		  $("#subtitle").val("");
		  $("#logo").css( "display","none" );
		  $("#logo2").css( "display","none" );
		  $("#input-video").val("");
    } else {
      document.getElementById('music').style.display= "none";
		  $("#span").css( "display","none" );
      $("#url").css( "display","block" );
	    $("#video").css( "display","none" );
      $("#input-url").val("");
	    $("#input-video").val("");
		  $("#subtitle").css( "display","block" );
		  $("#logo").css( "display","block" );
		  $("#logo2").css( "display","block" );
		  $("#video-embed").val("");
    }
  });

  checkbox2.addEventListener('change', function() {
    if(checkbox.checked)
      checkbox.checked = !checkbox.checked;

    if (parseInt(checkPremium.value))
      checkPremium.value = 0;
    
    if(this.checked) {
      document.getElementById('music').style.display= "block";
      document.getElementById('span').style.display= "block";
      document.getElementById('video').style.display= "none";
      document.getElementById('url').style.display= "none";
		  document.getElementById('subtitle').style.display= "none";
      document.getElementById('logo').style.display= "none";
      document.getElementById('logo2').style.display= "none";
      document.getElementById('input-video').value = "";
      document.getElementById('input-music').value = "";
    } else {
      document.getElementById('span').style.display= "none";
      document.getElementById('url').style.display= "block";
		  document.getElementById('music').style.display= "none";
	    document.getElementById('input-url').value = "";
      document.getElementById('subtitle').style.display= "block";
		  document.getElementById('logo').style.display= "block";
		  document.getElementById('logo2').style.display= "block";
    }
  });

  $("#input-video" ).blur(function() {
	  original = $(this).val();
	  if( $("#checkbox").is(':checked') ){
		  $("#input-url").val(original);
	  }

    if (~original.indexOf("youtube.com/watch?v=")) {
      var vars = [], hash;
      var q = original.split('?')[1];
      if(q != undefined){
        q = q.split('&');
        for(var i = 0; i < q.length; i++){
          hash = q[i].split('=');
          vars.push(hash[1]);
          vars[hash[0]] = hash[1];
        }
      }
      id_youtube=vars['v'];
      link1 = "https://www.youtube.com/embed/"
      embedLink = link1+id_youtube;
      iframe = "<iframe width='425' height='250' src='"+embedLink+"' frameborder='0'></iframe>";
      $("#video-embed" ).val(iframe);
    } else if (~original.indexOf("vimeo.com/")) {
      id = original.split(/[/]+/).pop() // get video id
      embedLink = "https://player.vimeo.com/video/" + id // create embed link
      iframe = "<iframe width='425' height='250' src='"+embedLink+"' frameborder='0'></iframe>";
      $("#video-embed" ).val(iframe);
    }else if (~original.indexOf("https://youtu.be/")) {
      id = original.split(/[/]+/).pop() // get video id
      embedLink = "https://www.youtube.com/embed/" + id // create embed link
      iframe = "<iframe width='425' height='250' src='"+embedLink+"' frameborder='0'></iframe>";
      $("#video-embed" ).val(iframe);
    }
    
  });

  $("#input-music" ).blur(function() {
    original = $(this).val();
    $("#input-url").val(original);
    if (~original.indexOf("open.spotify.com/album/") || ~original.indexOf("open.spotify.com/artist/") || ~original.indexOf("open.spotify.com/track/")) {
      arrayUrl = original.split(/[/]+/);
      id = arrayUrl.pop(); // get id album, artist or track
      id = id.split("?")[0];
      type = arrayUrl.pop();
      embedLink = "https://open.spotify.com/embed/" + type + "/" + id; // create embed link
      iframe = "<iframe width='638' height='80' src='"+embedLink+"' frameborder='0' allowtransparency='true' allow='encrypted-media'></iframe>";
      $("#music-embed").val(iframe);
    }
    //alert(x);//https://vimeo.com/401102477
  });
</script>

<style>
  .img-fluid{
    max-width:60px;
    margin-bottom: 10px;
  }
  .gif{
	 max-width:100px;  
  }

  a.button {
      -webkit-appearance: button;
      -moz-appearance: button;
      appearance: button;

    background-color: cornflowerblue;
      padding-top: 15px;
      padding-bottom: 15px;
  }
</style>

@stop
@section('content')


<script>
  function goBack() {
    window.history.back();
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
   
   
   
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                             <!-- Basic Form Inputs card start -->
                             <div class="card">
                                <div class="card-block">
                                     <div class="sub-title"><h4>{{__('messages.add_new') }}</h4></div>

   
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><i class="fa fa-thumbs-up" aria-hidden="true"></i></strong> {{ session('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif   
   
<form action="{{ route('inputlinks.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
  <div class="row">

	
		<div class="col-xs-12 col-sm-12 col-md-6">
			<label><input type="checkbox" id="checkbox" value="video"> {{__('messages.video_incrustado') }}</label>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6">  
			<label ><input type="checkbox" id="checkbox2" value="music"> {{__('messages.spotify_link') }}</label>
		</div>	
    
    <div class="col-xs-12 col-sm-12 col-md-12"  id="url" >
      <div class="form-group">
        <strong>Url:</strong>
        <input type="text" id="input-url" name="url" class="form-control" placeholder="https://facebook.com/">
      </div>
    </div>

		<div class="col-xs-12 col-sm-12 col-md-12" id="video">
      <div class="form-group">
        <strong><!--Order:-->Video:</strong>
        <input type="text" id="input-video" name="url_comercial"  class="form-control" placeholder="https://www.youtube.com/watch?v=XXXXXXXXXXX">
				<input type="hidden" id="video-embed" class="form-control" name="video">
      </div>	
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" id="music">
      <div class="form-group">
        <strong><!--Order:-->Spotify:</strong>
        <input type="text" id="input-music"  class="form-control" placeholder="https://open.spotify.com/album/XXXXXXXXXXXXX?si=XXXXXXXXXXXXX">
        <input type="hidden" id="music-embed" class="form-control" name="music">
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" id="title">
      <div class="form-group">
        <strong><!--title:--> {{__('messages.title') }}</strong>
        <span id="span">{{__('messages.no_reflejado') }}</span>
        <input type="text" name="title" class="form-control" placeholder="{{__('messages.title') }}">
      </div>
    </div>
		
    <div class="col-xs-12 col-sm-12 col-md-12" id="subtitle">
      <div class="form-group">
        <strong><!--subtitle:-->{{__('messages.subtitle') }}</strong>
        <input type="text" name="subtitle" maxlength="150" class="form-control" placeholder="{{__('messages.subtitle') }}">
      </div>
    </div>

		<div class="col-xs-12 col-sm-12 col-md-12" id="logo">
      <strong><!--logo:-->{{__('messages.logo') }}</strong>
      <!--img-->
      <div class="row text-center">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid logofac" src="{{ asset('storage'). '/uploads/rrss/facebookx.png'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid logoins" src="{{ asset('storage'). '/uploads/rrss/instagramx.png'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid logotwi" src="{{ asset('storage'). '/uploads/rrss/twitterx.png'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid logoyou" src="{{ asset('storage'). '/uploads/rrss/youtube.png'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid logolin" src="{{ asset('storage'). '/uploads/rrss/linkedinx.png'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid logopin" src="{{ asset('storage'). '/uploads/rrss/pinterest.png'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid logowha" src="{{ asset('storage'). '/uploads/rrss/whatsapp2.png'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid logodri" src="{{ asset('storage'). '/uploads/rrss/dribbblex.png'}}">
        </div>
      </div>
	  
	  <!--gif-->
	@if(Auth::user()->userProfile->type_plan=='pro')
	  <div class="row" style="margin-top:25px">
		<strong style="margin-left: auto; margin-right: auto;"><h5>{{__('messages.gif') }}</h5></strong>
	  </div>
	  <div class="row text-center">
	  
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid instagif gif" src="{{ asset('storage'). '/uploads/rrss/instagram.gif'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid youtgif gif" src="{{ asset('storage'). '/uploads/rrss/youtube.gif'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid whatsgif gif" src="{{ asset('storage'). '/uploads/rrss/whatsapp.gif'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid twitgif gif" src="{{ asset('storage'). '/uploads/rrss/twiter.gif'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid tikgif  gif" src="{{ asset('storage'). '/uploads/rrss/tiktok.gif'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid telegif gif" src="{{ asset('storage'). '/uploads/rrss/telegram.gif'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid skygif gif" src="{{ asset('storage'). '/uploads/rrss/skype.gif'}}">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
          <img class="img-fluid linkegif gif" src="{{ asset('storage'). '/uploads/rrss/linkedin.gif'}}">
        </div>
      </div>
	@endif 
    </div>
		
    <div class="col-xs-12 col-sm-12 col-md-12" id="logo2">
      <div class="form-group">
        <strong><!--logo:-->{{__('messages.custom_logo') }}</strong>
        <input type="file" name="logo" id="logo" class="form-control" placeholder="Logo">
        <input type="hidden" name="logo-pre" id="logo-pre" class="form-control">
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>{{__('messages.premium_content') }}</strong>
        <select id="premium" name="is_premium" class="form-control">
          <option value="0">No</option>
          <option value="1">Si</option>
        </select>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
      <button type="submit" class="btn btn-primary"><!--Submit-->{{__('messages.btn_6') }} </button>
      <a href="{{ route('inputlinks.index') }}" class="btn btn-primary"><!--back-->{{__('messages.btn_7') }}</a>
		</div>
  </div> 
</form>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection