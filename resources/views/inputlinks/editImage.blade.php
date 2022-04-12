@extends('layouts.master')
@section('script')

<script src="{{ asset('js/customjs.js') }}" defer></script>
<script>

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
    <div class="sub-title"><h4>{{__('messages.edit_sell_image') }}</h4></div>
         
   <form action="{{ route('inputlinks.update', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
	
		<div class="col-xs-12 col-sm-12 col-md-12"  id="imgcomercial" >
            <div class="form-group text-center">
                @if($data->img_comercial)
                    <img src="{{ asset( '/storage/uploads').'/'.$data->img_comercial}}" alt="" style="max-width: 150px; margin-top: 15px;margin-bottom: 15px; margin-left:auto; margin-right:auto">
                @else
                    <img src="{{ asset('storage/uploads/rrss'). '/'.'image.png'}}" alt="" width="50">
                @endif
            </div>
            <div class="form-group">						
                <strong>{{__('messages.img_comercial') }}:</strong>
                <input type="file" name="img_comercial" id="img_comercial" class="form-control" >
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12"  id="paypal" >
            <div class="form-group">
                <strong>{{__('messages.paypal_button') }}:</strong>
                <textarea class="form-control" name="paypal_button" value="{{ $data->paypal_button }}"  id="paypal_button"  rows="3" maxlength="22350">{{ $data->paypal_button }}</textarea>
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