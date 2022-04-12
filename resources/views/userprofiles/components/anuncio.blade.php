@if (isset($status_ad))
    {{-- Funcion en php para verificar si el contenido a mostrar es un URL, sino es html --}}
    @php
        function isValidURL($url)
        {
            if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){

                //print_r("Not valide URL"); 
                return false;

            }else{

                //print_r("valide URL");
                return true;

            }
        }
    @endphp

        {{-- Verifica si los anuncios estan activos para mostrar la sección del html --}}
    @if ($status_ad->active)
        <style>
            /* Vista principal de contenedor */
            .banner-base{
                display: flex; flex-direction: column; align-items: center;
                
                background-color:#ffffff87;
                margin-bottom: 5px;
                padding: 20px;
            }
            /* Contenedor de los anuncios/contenido que se muestre en su interior, para que no se 
            estire la vista */
            .banner-ads1{
                max-height: 500px; overflow: auto;
                max-width: 1050px;
                padding-block: 10px;
                /* background-color: lightskyblue; */
            }
        </style>
        <div class="container text-center banner-base">
        {{-- <div class="container-fluid text-center align-center" style="height: auto; padding-top:10px; padding-bottom:10px; background-color:#ffffff87;"> --}}
            <label>Publicidad</label><br>
            
            {{-- Verifica el campo, si esta vacio no se muestra la sección --}}
            @if (!empty($status_ad->advertising->horizontal))
                
                @if (isValidURL($status_ad->advertising->horizontal))
                    <iframe src="{{$status_ad->advertising->horizontal}}" frameborder="0" style="max-height: 300px;"></iframe>
                @else
                <div class="banner-ads1">
                    {!!$status_ad->advertising->horizontal!!}
                </div>						
                @endif

            @endif
            @if(!empty($status_ad->advertising->horizontal) && !empty($status_ad->advertising->block))
                <br>
            @endif
            @if (!empty($status_ad->advertising->block))
                
                @if (isValidURL($status_ad->advertising->block))
                    <iframe src="{{$status_ad->advertising->block}}" frameborder="0" style="max-height: 300px;"></iframe>
                @else
                <div class="banner-ads1">
                    {!!$status_ad->advertising->block!!}
                </div>
                @endif

            @endif
        </div><br>
    @endif
@endif