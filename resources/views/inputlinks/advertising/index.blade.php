@extends('layouts.master')
 

@section('content')

@if ($errors->any())
    <div class="mx-3 mt-3 alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="mx-3 mt-3 alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="m-3 p-4 card shadow shadow-lg">
    <div class="card-header row">
        <h3 class="col">{{__('messages.advertisements')}}</h3>
        <a href="{{ route('admin.advertising.create') }}" class="btn btn-primary rounded">Añadir anuncio</a>
    </div>
    
    
    <hr/>

    
    <div class="mt-3 card-block row">

        <div class="col-6">
            
            <div class="form-group text-center">
                <label class="fs-3">{{__('messages.advertisements.index.form.state.text1')}}: " {{__('messages.advertisements.index.form.state.text2')}} 
                    @if (isset($status_ad))
                        @if ($status_ad->active)
                            {{__('messages.advertisements.index.form.state.value1')}}
                        @else
                            {{__('messages.advertisements.index.form.state.value2')}}
                        @endif
                    @else
                        {{__('messages.advertisements.index.form.state.value3')}}
                    @endif
                    "
                </label>

                <br>
                <div class="d-flex justify-content-center">
                    <form action="{{ route('admin.adsState.updateState') }}" method="get">
                        
                        <button class="btn btn-primary align-self-center rounded" @if (!isset($status_ad)) disabled @endif>
                        @if (isset($status_ad))
                            @if ($status_ad->active)
                                {{__('messages.advertisements.index.form.state.button2')}}
                            @else
                                {{__('messages.advertisements.index.form.state.button1')}}
                            @endif
                        @else
                            {{__('messages.advertisements.index.form.state.button3')}}
                        @endif
                    </button>
                    </form>
                    
                </div>
                
            </div>         
            
        </div>

        <div class="col-6">
            <form action="{{ route('admin.adsState.selected') }}" method="post">
                @csrf
                @method('put')
                <label>{{-- Selecionar proovedor: --}}{{__('messages.advertisements.index.form.select.text')}}</label>

                <select name="selectAds" class="form-control my-2">
                    @if (isset($advertisementsSelect) && isset($status_ad))
                        @foreach ($advertisementsSelect as $advertising)
                            <option  value="{{ $advertising->id }}"
                            {{-- @if($advertising->id == 1) disabled @endif --}}
                            @if($status_ad->advertisements_id == $advertising->id) selected @endif>
                                {{$advertising->advertising}}
                            </option>
                        @endforeach
                    @else
                        <option disabled>{{-- No hay publicidad --}}{{__('messages.advertisements.index.form.select.option')}}</option>
                    @endif
                </select>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary rounded">{{-- Cambiar --}}{{__('messages.advertisements.index.form.select.button')}}</button>
                </div>
            </form>
            
            
        </div>

    </div>
    <hr/>

    

    <h4 class="mt-2 mb-3">{{-- Anuncios registrados --}}{{__('messages.advertisements.index.table.title')}}</h4>

    <table id="table-advertisements" class="table table-sm table-responsive"">
        <thead>
            <tr class="text-center">
                <th>{{-- Proveedor --}}{{ __('messages.advertisements.index.table.thead1') }}</th>
                <th>{{-- Script --}}{{ __('messages.advertisements.index.table.thead2') }}</th>
                <th>{{-- Bloque --}}{{ __('messages.advertisements.index.table.thead3') }}</th>
                <th>{{-- Banner Horizontal --}}{{ __('messages.advertisements.index.table.thead4') }}</th>
                <th>{{-- Banner Vertical --}}{{ __('messages.advertisements.index.table.thead5') }}</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                
            </tr>
            @if (isset($advertisements))
                @foreach ($advertisements as $advertising)
                    {{-- <tr @if($status_ad->advertisements_id == $advertising->id) class="table-info" @endif> --}}

                        @if ($status_ad->advertisements_id == $advertising->id)
                            @if ($status_ad->active)
                                <tr class="table-info">
                            @else
                                <tr class="table-secondary">
                            @endif
                        @else
                            <tr>
                        @endif

                        <td>{{ $advertising->advertising }}</td>
                        <td class="text-center">
                            @if (!empty($advertising->head))
                            <i class="fa fa-check fa-2x"></i>
                            @else
                            <i class="fa fa-times fa-2x"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if (!empty($advertising->block))
                            <i class="fa fa-check fa-2x"></i>
                            @else
                            <i class="fa fa-times fa-2x"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if (!empty($advertising->horizontal))
                            <i class="fa fa-check fa-2x"></i>
                            @else
                            <i class="fa fa-times fa-2x"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if (!empty($advertising->vertical))
                            <i class="fa fa-check fa-2x"></i>
                            @else
                            <i class="fa fa-times fa-2x"></i>
                            @endif
                        </td>
                        <td>
                            @if ($advertising->id != 1)
                                <a href="{{ route('admin.advertising.edit', $advertising) }}" class="btn btn-secondary btn-sm rounded">{{-- Editar --}}{{__('messages.advertisements.index.table.button1')}}</a>
                            @endif 
                        </td>
                        <td>
                            @if ($advertising->id != 1)
                                {{-- <a href="{{ route('admin.advertising.destroy', $advertising) }}" class="btn btn-danger btn-sm rounded">Eliminar</a> --}}
                                <form action="{{ route('admin.advertising.destroy', $advertising) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm rounded">{{-- Eliminar --}}{{__('messages.advertisements.index.table.button2')}}</button>
                                </form>
                            @endif 
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{{-- No hay anuncios --}}{{__('messages.advertisements.index.table.td')}}</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if (isset($advertisements))
        <div class="d-flex justify-content-center">
            {{$advertisements->links()}}
        </div>
    @endif

</div>
@endsection


@section('script')
    <!-- Sweetalert.css -->
    <script src="{{URL::to('assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script>
        /* Script para detectar el evento submit de un form y se detiene el envio,
            se muestra un modal para confirmar la acción, si este se confirma se procese a enviar el form.  */
        let confirmForm = false;
        $("#table-advertisements form").submit(function(event){
            if(confirmForm == false){
                event.preventDefault();
                Swal.fire({
                    title: '{{__('messages.tools.modalConfirm.title')}}',
                    text: '{{__('messages.tools.modalConfirm.ads.text1')}}',
                    icon: 'warning',
                    confirmButtonColor: '#448aff',
                    confirmButtonText: '{{__('messages.tools.modalConfirm.button.confirm')}}',
                    showCancelButton: true,
                    cancelButtonText: '{{__('messages.tools.modalConfirm.button.cancel')}}',
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