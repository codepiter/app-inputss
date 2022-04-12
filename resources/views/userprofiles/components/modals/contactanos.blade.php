<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header" style="text-align: center;">
        		<h5 class="modal-title w-100 text-center" id="exampleModalLabel" style="font-size:20px;" ><!--Contáctame-->{{__('messages.call_me') }}	</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		<form action="{{route('contactanos.sendemail')}}" method="post">
					<div class="modal-body">
						@csrf

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong><!--Name:-->{{__('messages.name') }}</strong>
									<input type="text" name="name" class="form-control" placeholder="{{__('messages.name') }}">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong><!--Apellido:-->{{__('messages.lastname') }}</strong>
									<input type="text" name="lastname" class="form-control" placeholder="{{__('messages.lastname') }}">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong>Email</strong>
									<input type="email" name="email" class="form-control" placeholder="user@example.com">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong><!--Phone No:-->Nº {{__('messages.phone') }}</strong>
									<input type="text" name="phone" class="form-control" placeholder="{{__('messages.phone') }}">
								</div>
							</div>
							<input type="hidden" value="{{$userprofile->id}}" name="user_profile_id">
							<input type="hidden" value="{{$userprofile->user->email}}" name="email_owner">
						</div>
					</div>
					<div class="modal-footer justify-content-center" style="text-align: center">
						<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						<button type="submit" class="btn btn-primary" id="sub-form"><!--Llamame-->{{__('messages.contact_me') }}	</button>
					</div>	
				</form>		
      		</div>
    	</div>
  	</div>
</div>