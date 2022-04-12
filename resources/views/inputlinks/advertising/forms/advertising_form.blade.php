<div class="form-group">
    <label class="form-label" for="advertising">{{--Nombre del proveedor: --}}{{__('messages.advertisements.create.form.label1')}}</label>
    <input class="form-control @error('advertising') is-invalid @enderror" type="text" name="advertising" id="" required autocomplete="off" maxlength="100" minlength="2" value="@if(isset($advertising) && empty(old('advertising'))){{$advertising->advertising}}@else{{old('advertising')}}@endif">
</div>

<h4>{{--Bloques de anuncios --}}</h4>

<div class="form-group">
    <label class="form-label" for="head">{{--Script del encabezado: --}}{{__('messages.advertisements.create.form.label2')}}</label>
    <textarea name="head" class="form-control @error('head') is-invalid @enderror" required autocomplete="off" maxlength="300" minlength="2">@if(isset($advertising) && empty(old('head'))){{$advertising->head}}@else{{old('head')}}@endif</textarea>
</div>

<div class="form-group">
    <label class="form-label" for="block">{{--Bloque: --}}{{__('messages.advertisements.create.form.label3')}}</label>
    {{-- <input class="form-control" type="text" name="block" id=""> --}}
    <textarea name="block" class="form-control @error('block') is-invalid @enderror" autocomplete="off" maxlength="2000" minlength="2">@if(isset($advertising) && empty(old('block'))){{$advertising->block}}@else{{old('block')}}@endif</textarea>
</div>

<div class="form-group">
    <label class="form-label" for="horizontal">{{--Banner horizontal: --}}{{__('messages.advertisements.create.form.label4')}}</label>
    {{-- <input class="form-control" type="text" name="horizontal" id=""> --}}
    <textarea name="horizontal" class="form-control @error('horizontal') is-invalid @enderror" autocomplete="off" maxlength="2000" minlength="2">@if(isset($advertising) && empty(old('horizontal'))){{$advertising->horizontal}}@else{{old('horizontal')}}@endif</textarea>
</div>

<div class="form-group">
    <label class="form-label" for="vertical">{{--Banner Vertical: --}}{{__('messages.advertisements.create.form.label5')}}</label>
    {{-- <input class="form-control" type="text" name="vertical" id=""> --}}
    <textarea name="vertical" class="form-control @error('vertical') is-invalid @enderror" autocomplete="off" maxlength="2000" minlength="2">@if(isset($advertising) && empty(old('vertical'))){{$advertising->vertical}}@else{{old('vertical')}}@endif</textarea>
</div>