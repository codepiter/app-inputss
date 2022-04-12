<div class="share">
    <ul>
          <div class="share-button text-center">
              <span>Comparteme</span>
              <a href="https://www.facebook.com/sharer.php?u=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-facebook-f"></i></a>
              <a href="https://twitter.com/intent/tweet?text=Quiero%20compartir%20esta%20herramienta,%20esta%20maginifica=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-twitter"></i></a>
              <a href="https://api.whatsapp.com/send?text=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-whatsapp"></i></a>
              <a href="https://www.linkedin.com/shareArticle?mini=true&url=AQUI_URL&title=InputsLink&summary=&source=app.inputslink.com/{{ $userprofile->slug }}" ><i class="fa fa-linkedin-in"></i></a>
              <a href="sms:?body=Hola te comparto la tarjeta de {{ $userprofile->name }} : {{ Request::url() }}" class="sms d-block d-sm-none desktop-visible"> 
                <i class="fas fa-sms"></i>
              </a>
            </div>
      </ul>
</div>


<style>
	/* // Set Defaults */
  .desktop-visible { display:none;}

  /* // Desktop and landscape tablets */
  @media (max-width: 576px) {/*768px*/

  .desktop-visible { display: block; }
  }
</style>