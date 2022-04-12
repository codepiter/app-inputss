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

<div class="m-4 p-4 card shadow-lg">
    <div class="row">
        <h4 class="col">{{--Añadir anuncio --}}{{__('messages.advertisements.create.title')}}</h4>
        <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary rounded float-right">{{--Regresar --}}{{__('messages.advertisements.create.button1')}}</a>
    </div>
    
    <hr class="my-3"/>

    <form action="{{ route('admin.advertising.store') }}" method="post">
        @csrf
        
        @include('inputlinks.advertising.forms.advertising_form')

        <div class="text-center">
            <button type="submit" class="btn btn-primary rounded">{{--Añadir --}}{{__('messages.advertisements.create.button2')}}</button>
        </div>
        

    </form>

    
    
</div>



@endsection