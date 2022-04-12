@if ($userprofile->subs_sms)
	<div class="modal fade" id="subs_smsModal" tabindex="-1" role="dialog" aria-labelledby="subs_smsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
	  		<div class="modal-content">
				<div class="modal-header" style="text-align: center">
		  			<h5 class="modal-title w-100 text-center" id="subs_smsModalLabel"><!--Suscripcion por sms-->{{__('messages.subscription_sms') }}	</h5>
		  			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
		  			</button>
				</div>
				<div class="modal-body">
		  			<form action="{{route('subscription.subscriptionSms')}}" method="post">
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
										<strong><!--Phone No:-->Nº {{__('messages.phone') }}</strong>
										<input type="text" name="phone" class="form-control" placeholder="{{__('messages.phone') }}">
									</div>
								</div>
								<input type="hidden" value="{{$userprofile->id}}" name="user_profile_id">
					  		</div>
						</div>
						<input type="hidden" value="{{$userprofile->user->email}}" name="email_owner">
						<div class="modal-footer justify-content-center" style="text-align: center">
						  	<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						  	<button type="submit" class="btn btn-primary" id="sub-form-sms"><!--Suscribirse-->{{__('messages.subscribe') }}	</button>
						</div>	
					</form>  
				</div>
			</div>
		</div>
	</div>
@endif