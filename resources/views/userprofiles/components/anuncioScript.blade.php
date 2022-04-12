@if (isset($status_ad))
	@if ($status_ad->active)
		@if (!empty($status_ad->advertising->head))
			{!!$status_ad->advertising->head!!}
		@endif
	@endif
@endif