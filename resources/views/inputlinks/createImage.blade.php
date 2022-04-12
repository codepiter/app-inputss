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
                <div class="sub-title"><h4>{{__('messages.sell_image') }}</h4></div>
   
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
	                  <div class="col-xs-12 col-sm-12 col-md-12"  id="imgcomercial" >
                      <div class="form-group">
                        <strong>{{__('messages.img_comercial') }}:</strong>
			                  <input type="file" name="img_comercial" id="img_comercial" class="form-control" placeholder="Logo">
			                  <input type="hidden" class="form-control" name="comercial2" value="on">
                      </div>
                    </div>
	                  <div class="col-xs-12 col-sm-12 col-md-12"  id="paypal" >
                      <div class="form-group">
                        <strong>{{__('messages.paypal_button') }}:</strong>
	                      <textarea class="form-control" name="paypal_button" id="paypal_button"  rows="3" maxlength="22350"></textarea>
                      </div>
                    </div>	

                    <div class="col-xs-12 col-sm-12 col-md-12" id="title">
                      <div class="form-group">
                        <strong><!--title:--> {{__('messages.title') }}</strong>
                        <span id="span">{{__('messages.no_reflejado') }}</span>
                        <input type="text" name="title" class="form-control" placeholder="{{__('messages.title') }}">
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