@extends('layouts.master')
 

@section('content')

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
                                    <h4 class="sub-title">Users</h4>

									<div class="row seacrh-header">
										<div class="col-lg-4 offset-lg-4 offset-sm-3 col-sm-6 offset-sm-1 col-xs-12">
											<div class="form-material">
												<div class="md-group-add-on form-group form-primary">
													
													<span class="md-add-on-file">
														<button type="button" class="btn btn-outline-primary waves-effect waves-light" onclick="searchUsers()">
														<i class="fa fa-search"></i>
													</button>
													</span>
													<div class="md-input-file">
														<input type="text" name="search" id="input_search" class="md-form-control md-form-file form-control" placeholder="{{__('messages.input_text_search')}}" maxlength="300">
														<span class="form-bar"></span>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="mt-3 mb-6">

										<!-- Genere Nuevo Input-Links  
										<a class="btn btn-success"  href="{{ route('userprofiles.create') }}"> {{__('messages.btn_1') }}
										</a>
										
										-->
										
										
										
									</div> 

				@if(!$userprofiles)
				<div style="padding:2em; margin-top: 2em; background:#dcd9d9">
					<h3>Aún no existen perfiles de usuarios creados<h3>
				</div>
					@else
					<div class=" mt-3 table-responsive">
						<table class="table table-bordered" style="background: #f5f6f8;">
						   <thead class="bg-warning text-dark">
							<tr class="" >
								<th style="">{{ __('messages.logo') }}</th>
								<th style="">{{ __('messages.name') }}</th>
								<th style="">{{ __('messages.url') }}</th>
								<th style="">{{ __('messages.type_plan') }}</th>
								<th>{{ __('messages.options') }}</th>
							</tr>
						  </thead>
							<tbody id="tablecontents">
								@foreach ($userprofiles as $item)

								<tr class="row1" data-id="{{ $item->id }}">
									
									<td>
										
										@if($item->logo)
										<img src="{{ asset('storage/uploads'). '/'.$item->logo}}" alt="" width="50">
										@else
											<img src="{{URL::to('assets/images/avatardefault_92824.png')}}" alt="" width="50">
										@endif
									</td>
									<td>{{ $item->name }}</td>
									<td> <a class=""  href="{{ $item->slug }}" target="_blank">    https://app.inputslink.com/{{ $item->slug }}</a></td>
									<td>{{ $item->type_plan }}</td>
									<td style="display:flex; justify-content:center;">
									

										<button type="button" class="btn btn-outline-danger remov-item" data-id="{{ $item->id }}"><img src="{{URL::asset('/assets/images/delete2.png')}}" alt="Supr" height="22" width="auto"></button>

									</td>
								</tr>			
								@endforeach
							</tbody>
						</table>
					 	{!! $userprofiles->links() !!} 
					</div>
					 
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

	<script>
		// Funcion, verifica si el input text esta vacio o no para realizar una consultar,
		// las valores mas cercanos o todos los existentes.
		function searchUsers(){
			let inputSearch = $('#input_search').val();

			let newContentTable = '<tr><td colspan="5" class="text-center">Searching...</td></tr>';
			$("#tablecontents").html(newContentTable);

			let url = "userprofiles/search/"+inputSearch;
			if (inputSearch.length == 0) {
				url = "{{ route('userProfiles.searchall') }}";
			}
			//console.log('URL => 'url);

			$.ajax(
			{
				url: url,
				type: 'get',
				error: function (){
					newContentTable = '<tr><td colspan="5" class="text-center">Error</td></tr>';
					$("#tablecontents").html(newContentTable);
				},
				success: function (content){
					//console.log("Respuesta del server.");
					createContentTable(content);
				}
			});
		}

		// Con la información obtenida en Json, se convierte en un array y los datos se colocan en
		// sus etiquetas html para ser mostradas en el table.
		function createContentTable(jsonContent) {
			const assetURL = "{{ asset('storage/uploads'). '/'}}";
			const assetDeleteURL = "{{URL::asset('/assets/images/delete2.png')}}";
			const assetURLDefault = "{{URL::to('assets/images/avatardefault_92824.png')}}";
			let items = JSON.parse(jsonContent);
			let newContentTable = '';
			
			if (items.length > 0) {
				//console.log('Mostrando contenido');
				newContentTable = '';
				items.forEach(element => {
					//console.log('ID '+element['id']+', nombre '+element['name']+', slug '+element['slug']);
					newContentTable += '<tr class="row1" data-id="'+ element["id"] +'">';

					if (element['logo'] == '') {
						newContentTable += '<td><img src="'+assetURLDefault+'" alt="" width="50"></td>';
					}else{
						newContentTable += '<td><img src="'+assetURL+element["logo"]+'" alt="" width="50"></td>';
					}
					
					newContentTable += '<td>'+element["name"]+'</td>';
					newContentTable += '<td> <a class=""  href="'+element["slug"]+'" target="_blank">    https://app.inputslink.com/'+element["slug"]+'</a></td>';
					newContentTable += '<td>'+element["type_plan"]+'</td>';
						newContentTable += '<td style="display:flex; justify-content:center;">';
						newContentTable += '<button type="button" class="btn btn-outline-danger remov-item" data-id="'+element['id']+'"><img src="'+assetDeleteURL+'" alt="Supr" height="22" width="auto"></button>';
						newContentTable += '</td>';
					newContentTable += '</tr>';
				});

				//console.log('Resultado : \n'+newContentTable);
			}else{
				newContentTable = '<tr><td colspan="5" class="text-center">No hay usuarios</td></tr>';
				//console.log('No hay contenido');
			}
			$("#tablecontents").html(newContentTable);
		}

	</script>

@endsection