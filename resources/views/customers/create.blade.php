@extends('layouts.master')
@section('script')

<script src="{{ asset('js/customjs.js') }}" defer></script>

<style>
.img-fluid{
	max-width:60px;
	margin-bottom: 10px;
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
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
                                     <h4 class="sub-title">{{__('messages.add_customer') }}</h4>
   
   
   
   
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><i class="fa fa-thumbs-up" aria-hidden="true"></i></strong> {{ session('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if (session('repeated'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error en carga!</strong> {{ session('repeated') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
   
   
   
   
   
<form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
     <div class="row">

		
		
		
		 <div class="col-xs-12 col-sm-12 col-md-12" id="subtitle">
            <div class="form-group">
                <strong><!--Name:-->{{__('messages.name') }}</strong>
                <input type="text" name="name" maxlength="150" class="form-control" placeholder="{{__('messages.name') }}">
            </div>
        </div>
		
		 <div class="col-xs-12 col-sm-12 col-md-12" id="subtitle">
            <div class="form-group">
                <strong><!--email:-->{{__('messages.email') }}</strong>
                <input type="email" name="email" maxlength="150" class="form-control" placeholder="{{__('messages.email') }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		
         <button type="submit" class="btn btn-primary"><!--Submit-->{{__('messages.btn_6') }} </button>
        

		
		<a href="{{ route('customers.index') }}" class="btn btn-primary"><!--back-->{{__('messages.btn_7') }}</a>

		
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