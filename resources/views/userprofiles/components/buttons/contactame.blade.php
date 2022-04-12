<div class="share">
    <ul>
          <div class="share-button1 text-center">
              <span>Contactame</span>
              <a  href="tel:+{{ $userprofile->telefono }}" ><i class="fas fa-phone"></i></a>
              <a href="{{ route('userprofiles.vcard',$userprofile->id) }}" style="text-decoration:none;" class="msg-btn" target="_blank"><i class="fas fa-address-book"></i>
              <a href="mailto:{{$userprofile->user->email}}"><i class="fas fa-envelope"></i></a>
              <a><i class="fas fa-id-card-alt" data-toggle="modal" data-target="#exampleModal" &nbsp;&nbsp;&nbsp;&nbsp></i></a>
          </div>
      </ul>
</div>