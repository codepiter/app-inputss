@extends('layouts.master')
@section('script')

<script src="{{ asset('js/customjs.js') }}" defer></script>
<script>

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
    <div class="sub-title"><h4>{{__('messages.edit_sell_video') }}</h4></div>
         
   <form action="{{ route('inputlinks.update', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
        <div class="col-xs-12 col-sm-12 col-md-12"  id="paypal" >
            <div class="form-group">
                <strong>{{__('messages.paypal_button') }}:</strong>
                <textarea class="form-control" name="paypal_button" value="{{ $data->paypal_button }}"  id="paypal_button"  rows="3" maxlength="22350">{{ $data->paypal_button }}</textarea>
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