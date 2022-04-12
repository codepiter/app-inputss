@extends('layouts.master')
 

@section('content')

	
<script src="{{ asset('js/modald.js') }}" defer></script>


    <style>
        .my_table td{
            border: dotted 1px rgb(73, 98, 151);
            padding: 5px;          
            }
    .my_table th{
        padding: 10px;
        background-color: rgb(90, 123, 195); 
        color: white;         
    }
    .error{
        color: red;
        border-color:red;
        font-weight: 900;
    }
    </style>
	
<!--modal-->
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal" style="padding-top: 50px !important;">
	  <div class="modal-dialog modal-md">
		<div class="modal-content">
		  <div class="modal-header">
			
			<h4 class="modal-title" id="myModalLabel">{{ __('messages.modalt') }}</h4>
		  </div>
		  <div class="modal-body">
		 {{ __('messages.modal1a') }}


		  <input type="hidden" class="form-control" id="id_item">
		  
		 </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" id="modal-btn-si">{{ __('messages.accept') }}</button>
			<button type="button" class="btn btn-primary" id="modal-btn-no">{{ __('messages.cancel') }}</button>
		  </div>
		</div>
	  </div>
	</div>
<!--fin modal-->

	
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
                                    <h4 class="sub-title">Customers</h4>

									<div class="mt-3 mb-6">

										<a class="btn btn-success"  href="{{ route('customers.create') }}"> {{__('messages.btn_8') }}
												</a>

									</div> 

				@if($exist_user == 0 )
				<div style="padding:2em; margin-top: 2em; background:#dcd9d9">
					<h3>Aún no cuenta con Clientes VIP Creados<h3>
				</div>
					@else
					 <table class="table table-bordered mt-3 table-responsive" style="background: #f5f6f8;">
						   <thead class="table-active" style="color: white;">
							<tr class="table-active" >

								<th style="width:50%;">{{ __('messages.name') }}</th>
								<th style="width:50%;">{{ __('messages.email') }}</th>
								<th style="width:50%; text-align:center;">{{ __('messages.actions') }}</th>
							</tr>
						  </thead>
						   <tbody id="tablecontents">
							@foreach ($customers as $item)

							<tr class="row1" data-id="{{ $item->id }}">

								<td>{{ $item->name }}</td>
								
								<td>
									<a class=""  href="{{ $item->slug }}" target="_blank">    {{ $item->email }}</a>
									
								</td>

								<td style="display:flex; justify-content:center;">

									@if(!$item->video)
									<a style="margin-right:5%" class="btn btn-outline-primary" href="{{ route('customers.edit',$item->id) }}" title="{{ __('messages.hover3') }}"><img src="{{URL::asset('/assets/images/edit.png')}}" alt="Edit" height="22" width="auto" height="20">
									</a>
									@endif

									<button type="button" class="btn btn-outline-danger remov-item" data-id="{{ $item->id }}"><img src="{{URL::asset('/assets/images/delete2.png')}}" alt="Supr" height="22" width="auto"></button>

								</td>
						</tr>			
							@endforeach
						</tbody>
						</table>
				@endif
  

								</div>
                           
							</div>
                            <!-- Basic Form Inputs card end -->
                        
						</div>
                   
				   </div>
                
				</div>
                <!-- Page body end -->
            
			</div>
       
		</div>
		
		
    </div>
	
@endsection