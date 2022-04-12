@extends('layouts.master')
 

@section('content')

	<!-- sort-->
	
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
   
    <script type="text/javascript">
      $(function () {

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('inputlinks/sort') }}",
                data: {
              position: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>
	
	
	
	<!--fin sort-->
<script src="{{ asset('js/modal.js') }}" defer></script>


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
                                    <h4 class="sub-title">InputsLink</h4>

									<div class="mt-3 mb-6">

										<!-- Genere Nuevo Input-Links  -->
										@if($link == 1 )
											@if((count($cant)) >= 12 && ($plan == "free"))

											@else
												<a class="btn btn-warning text-dark"  href="{{ route('inputlinks.create') }}"> {{__('messages.btn_1') }}
												</a>
											@endif
											
										@else
											<a class="btn btn-warning text-dark"  href="{{ route('inputlinks.create') }}"> {{__('messages.btn_1') }}
											</a>
										
										@endif
										
										
										
										 <!-- Ir a Input-Links  -->
										@if($link == 1 )
										<a class="btn btn-primary"  href="{{$url_link->userProfile->pathb()}}" target="_blank">{{__('messages.btn_2') }}</a>
										
										@endif
									</div> 

				@if($link == 0 )
				<div style="padding:2em; margin-top: 2em; background:#dcd9d9">
					<h3>Aún no cuenta con Inputslinks creados<h3>
				</div>
					@else
					 <table class="table table-bordered mt-3 table-responsive" style="background: #f5f6f8;">
						   <thead class="bg-warning text-dark">
							<tr class="" >
								<th width="30px">#</th>
								<th style="width:5%;">{{ __('messages.logo') }}</th>
								<th style="">{{ __('messages.title') }}</th>
								<th style="">{{ __('messages.url') }}</th>
								<th style="width:50%; text-align:center;">{{ __('messages.actions') }}</th>
							</tr>
						  </thead>
						   <tbody id="tablecontents">
							@foreach ($inputlinks as $item)

							<tr class="row1" data-id="{{ $item->id }}">
								 <td class="pl-3"><i class="fa fa-sort"></i></td>
								
								@if($item->video)
									
										<td><img src="{{ asset('storage/uploads/rrss'). '/'.'play-player.png'}}" alt="" width="50"></td>
								
								@elseif($item->comercial2 == "on")
										<td>
											<img src="{{ asset('storage/uploads/rrss'). '/'.'image.png'}}" alt="" width="50">
										</td>
								@elseif($item->music)
									<td>
									<img src="{{ asset('storage/uploads/rrss'). '/'.'spotify.png'}}" alt="" width="50"></td>  

								@else
									<td><img src="{{ asset('storage/uploads'). '/'.$item->logo}}" alt="" width="50"></td>
								@endif
						
								<td>{{ $item->title }}</td>
								
								
								<td>
									<a class=""  href="{{ $item->slug }}" target="_blank">    {{ $item->url }}</a>
									
								</td>

								<td style="display:flex; justify-content:center;">

									@if($item->video && $item->comercial == "on")
										<a style="margin-right:5%" class="btn btn-outline-primary" href="{{ route('inputlinks.edit',$item->id) }}" title="{{ __('messages.hover3') }}"><img src="{{URL::asset('/assets/images/edit.png')}}" alt="Edit" height="22" width="auto" height="20"></a>

									@elseif($item->img_comercial && $item->comercial2 == "on")
										<a style="margin-right:5%" class="btn btn-outline-primary" href="{{ route('inputlinks.edit',$item->id) }}" title="{{ __('messages.hover3') }}"><img src="{{URL::asset('/assets/images/edit.png')}}" alt="Edit" height="22" width="auto" height="20"></a>

									@elseif(!$item->video && !$item->music)
										<a style="margin-right:5%" class="btn btn-outline-primary" href="{{ route('inputlinks.edit',$item->id) }}" title="{{ __('messages.hover3') }}"><img src="{{URL::asset('/assets/images/edit.png')}}" alt="Edit" height="22" width="auto" height="20"></a>

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
@section('script')
    <!-- library js validate -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>

    <script type="text/javascript">
		$("input:checkbox").on('click', function()
		{
			var $box = $(this);
			if ($box.is(":checked"))
			{
				var group = "input:checkbox[class='" + $box.attr("class") + "']";
				$(group).prop("checked", false);
				$box.prop("checked", true);
			}
			else
			{
				$box.prop("checked", false);
			}
		});

    </script>

    <!-- alert blink text -->
    <script>
        function blink_text()
        {
            $('#message_error').fadeOut(700);
            $('#message_error').fadeIn(700);
        }
        setInterval(blink_text,1000);
    </script>
    <!-- script validate form -->

    <!-- script validate form -->
    <script>
        $('#validate').validate({
            reles: {
                'status_checkbox[]': {
					required :true,
					minlength:5,
				}
               
            },
            messages: {
                'status_checkbox[]' : "Please check all file*",
            },
            errorPlacement: function (error, element)
            {
                if(element.attr("name") == "status_checkbox[]")
                {
                    $('#message_error').empty();error.appendTo('#message_error')
                }
                else
                {
                    error.insertAfter(element);
                }
            }

        });
    </script>

@endsection

