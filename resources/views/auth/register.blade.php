@extends('layouts.app')
<script src="https://kit.fontawesome.com/24ba6f9918.js" crossorigin="anonymous"></script>

@section('content')
 <div class="row justify-content-center">
    <div class="col-md-8">
		<div class="card-body container-card">
					<h1>Registrarse</h1>
				<h1>¡Cree una cuenta gratis!</h1>
				<p class="text-center">Siempre libre no es necesario realizar ningún pago</p>	
				<div class="social-buttons">
							<a href="https://www.facebook.com/bussweOficial/" target="blank_" class="social-buttons__button social-button social-button--facebook">
								<span class="social-button__inner">
									<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
								</span>
							</a>

							<a href="https://www.instagram.com/bussweoficial/" target="blank_" class="social-buttons__button social-button social-button--instagram">
							<span class="social-button__inner">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
							</span>
							</a>

							<a href="https://www.youtube.com/channel/UC_79IZMRLUpevrIfJr-v_sQ" target="blank_" class="social-buttons__button social-button social-button--youtube">
							<span class="social-button__inner">
							<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
							</span>
							</a>

							</div>
							<form method="POST" action="{{ route('register') }}"  style="padding-bottom: 20px;" name="formulario">
								@csrf

								<div class="form-group row">
									<div class="col-md-8  mx-auto">
									<label for="email">{{ __('E-Mail Address') }}</label>
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>

								<div class="form-group row">
								
									<div class="col-md-8  mx-auto">
									<label for="password" >{{ __('Password') }}</label>
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									

										<div class="col-md-8  mx-auto">
										<label for="password-confirm" >{{ __('Confirm Password') }}</label>
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
										<br>
										<input type="checkbox" value="1" name="check" onclick="javascript:validar(this);"><p>Al crear una cuenta, acepta nuestros <u>Términos y condiciones</u> y nuestras <u>Políticas de privacidad</p></u>
									</div>
								</div>

		
		
								<div style="text-align: center;">
										<button type="submit" class="btn btn-primary"  name="boton" disabled>
											{{ __('Register') }}
										</button>
									 <a class="btn-link" href="{{ route('login') }}">¿Ya tienes una cuenta?</a>
								</div>
							</form>
						
					
				</div>
			</div>
        </div>
    </div>
</div>


<script>
function validar(obj){
	var d = document.formulario;
	if(obj.checked==true){
		d.boton.disabled = false;
	}else{
		d.boton.disabled= true;
	}
}
</script>


@endsection