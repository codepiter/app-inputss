@extends('layouts.master')
@section('script')

<script src="{{ asset('js/customjs.js') }}" defer></script>
<script>

$(document).ready(function() {
	$("#span").css( "display","none" );
	url = $("#input-url").val();
	video = $("#input-video").val(); 
	 	 
	if((video != "")) {
		$("#checkbox").prop("checked", true);
		$("#video").css( "display","block" ); 
		$("#url").css( "display","none" ); 
		$("#subtitle").css( "display","none" );
		$("#subtitle").val("");
		$("#logos").css( "display","none" );
		$("#logo2").css( "display","none" );
	} else {
		$("#video").css( "display","none" );
		$("#input-video").val("");
		$("#video-embed").val("");
		
	}
});

$("#checkbox").on( 'change', function() {
    if( $(this).is(':checked') ) {				
        $("#video").css( "display","block" );
		$("#span").css( "display","block" );
		$("#url").css( "display","none" );
		$("#subtitle").css( "display","none" );
		$("#subtitle").val("");
		$("#logos").css( "display","none" );
		$("#logo2").css( "display","none" );
		$("#logo").val("");
		$("#logo-pre").val("");
		$("#input-video").val("");
    } else {
		$("#span").css( "display","none" );
      	$("#url").css( "display","block" );
	    $("#video").css( "display","none" );
      	$("#input-url").val("");
	  	$("#input-video").val("");
		$("#subtitle").css( "display","block" );
		$("#logos").css( "display","block" );
		$("#logo2").css( "display","block" );
		$("#video-embed").val("");
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
    } else if (~original.indexOf("open.spotify.com/album/") || ~original.indexOf("open.spotify.com/artist/") || ~original.indexOf("open.spotify.com/track/")) {
      arrayUrl = original.split(/[/]+/);
      id = arrayUrl.pop(); // get id album, artist or track
      type = arrayUrl.pop();
      embedLink = "https://open.spotify.com/" + type + "/" + id; // create embed link
		  iframe = "<iframe width='425' height='250' src='"+embedLink+"' frameborder='0'></iframe>";
      console.log(iframe);
      $("#video-embed" ).val(iframe);
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

</style>
@stop

@section('content')
   
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
	
	
	
<div class="container" style="padding:5%">
 <div class="card">
   <div class="card-block">  
         
   <form action="{{ route('inputlinks.update', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
		<div class="row" >
			<div class="col-xs-12 col-sm-12 col-md-6" >
				<label><input type="checkbox" id="checkbox" value="video"> {{__('messages.video_incrustado') }}</label>
			</div>
		</div>
		
        <div class="col-xs-12 col-sm-12 col-md-12"  id="url">
            <div class="form-group">
                <strong>{{__('messages.url') }}:</strong>
                <input type="text" id="input-url" name="url" value="{{ $data->url }}" class="form-control" placeholder="Url">
            </div>
        </div>
			
		<div class="col-xs-12 col-sm-12 col-md-12" id="video">
            <div class="form-group">
                <strong>Video:</strong>
                <input type="text" id="input-video" class="form-control" name="url_comercial" value="{{ $data->url_comercial }}"placeholder="https://www.youtube.com/watch?v=XXXXXXXXXXX">
				<input type="hidden" id="video-embed" class="form-control" name="video" value="{{ $data->video }}">
            </div>
        </div>
			
        <div class="col-xs-12 col-sm-12 col-md-12" id="title">
            <div class="form-group">
            	<strong>{{__('messages.title') }}:</strong>
				<span id="span">{{__('messages.no_reflejado') }}</span>
                <input type="text" name="title" value="{{ $data->title }}" class="form-control" placeholder="Title">
            </div>
        </div>
		
		<div class="col-xs-12 col-sm-12 col-md-12" id="subtitle">
        	<div class="form-group">
            	<strong>{{__('messages.subtitle') }}:</strong>
                <input type="text" name="subtitle" maxlength="150" value="{{ $data->subtitle }}" class="form-control" placeholder="Sub-title">
            </div>
        </div>
		  
		<div class="col-xs-12 col-sm-12 col-md-12  " id="logos">
			<div class="row">	
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group text-center">	
						<strong>Logo:</strong><br>
						@if($data->logo)
							<img src="{{ asset( '/storage/uploads').'/'.$data->logo}}" alt="" style="max-height: 150px; margin-top: 15px;margin-bottom: 15px;">
						@else
							<img class="img-80 img-radius" src="{{URL::to('assets/images/avatardefault_92824.png')}}" alt="img">
						@endif
						<br>
					<!--expandido-->
					 <strong>{{__('messages.expanded') }}</strong>
						<br>
						@if($data->expanded=='on')
							<input name="expanded" class="form-control" checked data-toggle="toggle" data-on="Actief" data-off="Inactief" data-onstyle="success" data-offstyle="danger" type="checkbox">
						@else	
							<input name="expanded" class="form-control" data-toggle="toggle" data-on="Actief" data-off="Inactief" data-onstyle="success" data-offstyle="danger" type="checkbox">
						@endif
					<!--fin-expandido-->
					</div>
				</div>

			</div>
			
            <div class="row text-center" >
            	<div class="col-lg-3 col-md-6 col-xs-6">
					<img class="img-fluid logofac" src="{{ asset('storage'). '/uploads/rrss/facebookx.png'}}">
				</div>
				<div class="col-lg-3 col-md-6 col-xs-6">
				  	<img class="img-fluid logoins" src="{{ asset('storage'). '/uploads/rrss/instagramx.png'}}">
				</div>
				<div class="col-lg-3 col-md-6 col-xs-6">
				  	<img class="img-fluid logotwi" src="{{ asset('storage'). '/uploads/rrss/twitterx.png'}}">
				</div>
				<div class="col-lg-3 col-md-6 col-xs-6">
				  	<img class="img-fluid logoyou" src="{{ asset('storage'). '/uploads/rrss/youtube.png'}}">
				</div>
				<div class="col-lg-3 col-md-6 col-xs-6">
				  	<img class="img-fluid logolin" src="{{ asset('storage'). '/uploads/rrss/linkedinx.png'}}">
				</div>
				<div class="col-lg-3 col-md-6 col-xs-6">
				  	<img class="img-fluid logopin" src="{{ asset('storage'). '/uploads/rrss/pinterest.png'}}">
				</div>
				<div class="col-lg-3 col-md-6 col-xs-6">
				  	<img class="img-fluid logowha" src="{{ asset('storage'). '/uploads/rrss/whatsapp2.png'}}">
				</div>
				<div class="col-lg-3 col-md-6 col-xs-6">
				  	<img class="img-fluid logodri" src="{{ asset('storage'). '/uploads/rrss/dribbblex.png'}}">
				</div>
            </div>
				  <!--gif-->
			@if(Auth::user()->userProfile->type_plan=='pro')
	  			<div class="row" style="margin-top:25px">
					<strong style="margin-left: auto; margin-right: auto;">{{__('messages.gif') }}</strong>
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
			<input type="file" name="logo" id="logo" class="form-control">
			<input type="hidden" name="logo-pre" id="logo-pre" class="form-control">
			<br>
			<br>
        </div>

		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>{{__('messages.premium_content') }}</strong>
				<select id="premium" name="is_premium" class="form-control">
					@if($data->is_premium)
						<option value="0">No</option>
						<option selected value="1">Si</option>
					@else
						<option value="0">No</option>
						<option value="1">Si</option>
					@endif
				</select>
			</div>
		</div>

		<div class="invisible">
            <div class="form-group">
                <strong>POSICION:</strong>
                <input type="text" name="position" maxlength="150" value="{{ $data->position }}" class="form-control">
            </div>
        </div>

		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><!--Submit-->{{__('messages.btn_6') }}</button>
        </div>
    </form>
   </div>
  </div>
</div>
@endsection