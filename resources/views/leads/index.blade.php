@extends('layouts.master')
@section('script')
<script type="text/javascript" src="{{URL::to('assets/js/Leads.js')}}"></script>
<script type="text/javascript">
    InitLeads({
        baseurl: {!!json_encode(URL::to('/'))!!},
        csrf: '{{ csrf_token() }}',
    });
</script>

@stop

@section('content')

<div class="container" style="padding:5%">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h6 class="text-center">{{__('messages.my_leads') }}</h6>
        <div class="table-responsive">
            <table style="max-width: 100%" class="table table-bordered table-hover">
                <thead style="text-align: center">
                    <tr class="bg-primary">
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Fecha contacto</th>
                    </tr>
                </thead>
                <tbody id="bodyTableLeads" style="text-align: center">
                </tbody>
                <caption id="totalLeads"> 
                </caption>
            </table>
        </div>
        <div class="text-center">
            <nav aria-label="Pagination">
                <ul class="pagination">
                    <li id="pagination-back" class="btn btn-default">Anterior</li>
                    <li class="btn btn-primary disabled" id="pageNumber"></li>
                    <li id="pagination-next" class="btn btn-default">Siguiente</li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection