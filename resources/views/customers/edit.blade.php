@extends('layouts.master')
@section('script')

<script src="{{ asset('js/customjs.js') }}" defer></script>

<style>
.img-fluid{
	max-width:60px;
	margin-bottom: 10px;
}
</style>
@stop

@section('content')
   
    @if ($errors->any())

<div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	
	
	
<div class="container" style="padding:5%">
   
         
   <form action="{{ route('customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')
   
			<div class="col-xs-12 col-sm-12 col-md-12" >
				<label><h5>{{__('messages.title_edit') }}<h5></label>
			</div>

			
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('messages.name') }}:</strong>
                    <input type="text" name="name" value="{{ $customer->name }}" class="form-control" placeholder="{{__('messages.name') }}">
                </div>
            </div>
			 <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('messages.email') }}:</strong>
                    <input type="text" name="email" maxlength="150" value="{{ $customer->email }}" class="form-control" placeholder="{{__('messages.email') }}">
                </div>
            </div>

             <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary"><!--Submit-->{{__('messages.btn_6') }}</button>
            </div>

    </form>
</div>
@endsection