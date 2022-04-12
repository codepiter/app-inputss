<style>
    .img-fluid {
        max-width: 100%;
        height: auto;
        margin-bottom: 16px;
    }
</style>
@if ($userprofile->type_plan == 'free' || $userprofile->isProWithLogoTitle())
    <div class="img-fluid mb-3" style="text-align:center">
    @if ($userprofile->type_plan == 'free')
        <img style="max-width: 25rem;" src="{{ asset('images/icons'). '/'.'logo_final.png' }}">
    @else
        <img style="max-width: 25rem;" src="{{ asset('storage/uploads'). '/'.$userprofile->logo_title }}">
    @endif
    </div>
@endif
	