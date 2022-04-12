@extends('layouts.master')
 

@section('content')

@include('inputlinks.users.alertStatus')

<div class="card m-3 p-3">
    <div class="card-header">
        <h3>{{-- Lista de Usuarios --}}{{__('messages.users.index.title1')}}</h3>
    </div>
    <div class="card-block">

        <h4>{{-- Administradores --}}{{__('messages.users.index.title2')}}</h4>
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>E-Mail</th>
                        <th>{{-- Nivel Usuario --}}{{__('messages.users.index.table.thead1')}}</th>
                        {{-- <th>Estado</th> --}}
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @if ($admins->count() > 0)
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->typeUser->type }}</td>
                                {{-- <td>
                                    <form action="{{route('admin.user.updateState', $admin)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-sm btn-secondary rounded">
                                            @if ($admin->status)
                                            Deshabilitar
                                            @else
                                            Habilitar
                                            @endif
                                        </button>
                                    </form>   
                                </td> --}}

                                @if ($admin->id == Auth::user()->id)
                                    <td>                                    
                                        <form action="{{route('admin.user.update', $admin)}}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-sm btn-warning rounded">
                                                @if ($admin->user_type_id == 2)
                                                    {{-- Ascender --}} {{__('messages.users.index.table.level1')}}
                                                @else
                                                    {{-- Descender --}} {{__('messages.users.index.table.level2')}}
                                                @endif
                                            </button>
                                        </form>                                        
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.user.destroy', $admin) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger rounded">{{--Eliminar--}}{{__('messages.advertisements.index.table.button2')}}</button>
                                        </form>
                                    </td>
                                @else
                                    <td colspan="2"></td>
                                @endif
                                
                            </tr>
                        @endforeach
                    @else
                        <td colspan="4">
                            {{-- No hay usuarios --}} {{__('messages.users.index.table.td')}}
                        </td>
                    @endif
                    
                </tbody>
            </table>
            @if (isset($admins))
                <div class="d-flex justify-content-center">
                    {{$admins->links()}}
                </div>
            @endif
        </div>


        <h4>Clientes</h4>
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>E-Mail</th>
                        <th>{{-- Nivel Usuario --}}{{__('messages.users.index.table.thead1')}}</th>
                        {{-- <th>Estado</th> --}}
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->typeUser->type }}</td>
                                {{-- <td>
                                    <form action="{{route('admin.user.updateState', $user)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-sm btn-secondary rounded">
                                            @if ($user->status)
                                            Deshabilitar
                                            @else
                                            Habilitar
                                            @endif
                                        </button>
                                    </form> 
                                </td> --}}
                                <td> 

                                    @if (!empty($user->email_verified_at))
                                        <form action="{{route('admin.user.update', $user)}}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-sm btn-warning rounded">
                                                @if ($user->user_type_id == 2)
                                                    {{-- Ascender --}} {{__('messages.users.index.table.level1')}}
                                                @else
                                                    {{-- Descender --}} {{__('messages.users.index.table.level2')}}
                                                @endif
                                            </button>
                                        </form>
                                    @else
                                        {{-- Por verificar E-Mail --}} {{__('messages.users.index.table.td2')}}
                                    @endif
                                    
                                </td>
                                <td>
                                    <form action="{{ route('admin.user.destroy', $user) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger rounded">{{--Eliminar--}}{{__('messages.advertisements.index.table.button2')}}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="5">
                            {{-- No hay usuarios --}} {{__('messages.users.index.table.td')}}
                        </td>
                    @endif
                </tbody>
            </table>
            @if (isset($users))
                <div class="d-flex justify-content-center">
                    {{$users->links()}}
                </div>
            @endif
        </div>
        
    </div>
</div>

@endsection

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
                let button = $(this).find(":submit").text().trim().toLowerCase();
                let text = '';
                if(button == 'ascender' || button == 'ascend'){
                    text = 'ascenderá';
                }else if (button == 'descender' || button == 'descend'){
                    text = 'descendará';
                }else{
                    text = 'eliminará';
                }

                if(text != ''){
                    Swal.fire({
                        title: '{{__("messages.tools.modalConfirm.title")}}',
                        text: '',//"Se '+text+' el usuario"
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
                }else{
                    console.log('Texto de botones no validos');
                }

                
            }
        })
    </script>    
@endsection