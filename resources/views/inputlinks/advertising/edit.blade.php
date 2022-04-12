@extends('layouts.master')


@section('content')

@if ($errors->any())
    <div class="mx-3 mt-3 alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="mx-3 mt-3 alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="m-4 p-4 card shadow-lg">
    <div class="card-header row">
        <h4 class="col">{{-- Editar anuncio --}}{{ __('messages.advertisements.edit.title') }}</h4>
        <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary rounded float-right">{{-- Regresar --}}{{ __('messages.advertisements.create.button1') }}</a>
    </div>
    <hr class="my-3"/>

    <form id="ads_edit_form" action="{{ route('admin.advertising.update', $advertising) }}" method="post">
        @csrf
        @method('put')
        
        @include('inputlinks.advertising.forms.advertising_form')

        <div class="text-center">
            <button type="submit" class="btn btn-primary rounded">{{-- Cambiar --}}{{ __('messages.advertisements.edit.button2') }}</button>
        </div>
        
        
    </form>

    
    
</div>

{{-- <div class="modal fade" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mobtn" data-dismiss="modal" id="buttonCancel">Close</button>
                <button type="button" class="btn btn-primary mobtn" id="buttonConfirm">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection
{{-- 
@section('script')
<script>
    /*let form;
    let formConfirm = false;
    $("form").submit(function(e){
        console.log("Validacion "+$(this).validate().checkForm());
        if(!formConfirm){
            e.preventDefault();
            console.log('submit intercepted '+$(this).attr('action'));
            form = $(this);
        }
        return;
    });
    $('#buttonConfirm').click(function(){
        console.log('Confirm variable '+$(form).attr('id'));
        formConfirm = true;
        form.submit();
    });
    $('#buttonCancel').click(function(){
        console.log('Cancel variable '+$(form).attr('id'));
        formConfirm = false;
        form = null;
    });*/
</script> 
@endsection--}}

@section('script')
    <!-- Sweetalert.css -->
    <script src="{{URL::to('assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script>
        /* Script para detectar el evento submit de un form y se detiene el envio,
            se muestra un modal para confirmar la acción, si este se confirma se procese a enviar el form.  */
        let confirmForm = false;
        $("form").submit(function(event){
            if(confirmForm == false){
                event.preventDefault();
                Swal.fire({
                    title: '{{__("messages.tools.modalConfirm.title")}}',
                    text: '{{__("messages.tools.modalConfirm.ads.text2")}}',
                    icon: 'warning',
                    confirmButtonColor: '#448aff',
                    confirmButtonText: '{{__("messages.tools.modalConfirm.button.confirm")}}',
                    showCancelButton: true,
                    cancelButtonText: '{{__("messages.tools.modalConfirm.button.cancel")}}',
                }).then((result) => {
                    if (result.isConfirmed) {
                        confirmForm = true;
                        //console.log('Enviando Form');
                        $(this).submit();
                    }else{
                        confirmForm = false;
                    }
                    //console.log('Resultado '+result.isConfirmed);
                    //console.log('confirmForm '+confirmForm);
                })
            }
        })
    </script>    
@endsection