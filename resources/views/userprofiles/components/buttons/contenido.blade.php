@if ($userprofile->isPro() && $userprofile->inputLinksPro()->count() > 0)
    <div class="share" style="padding-block-end:10px;">
        <ul>
            <div class="content-button text-center">
                <span>Contenido</span>
                <a id="content-premium"><i class="fas fa-crown"></i></a>
            </div>
        </ul>
    </div>
@endif
