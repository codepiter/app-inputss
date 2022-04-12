@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/js/c3/c3.min.css')}}">
@endsection

@section('script')
<script type="text/javascript" src="{{URL::to('assets/js/Stadistics.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/c3/c3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/c3/d3-5.8.2.min.js')}}"></script>
<script type="text/javascript">
    InitStadistics({
        baseurl: {!!json_encode(URL::to('/'))!!},
        csrf: '{{ csrf_token() }}',
    });
</script>
@endsection

@section('content')
    <div class="container" style="padding: 5%">
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom: 10px">
            <h4 class="text-center">{{__('messages.stadistics') }}</h4>
        </div>

        <div class="table-responsive">
            <table style="max-width: 100%" class="table table-bordered table-hover">
                <thead style="text-align: center">
                    <tr class="bg-primary">
                        <th scope="col">Titulo</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Fecha Creación</th>
                        <th scope="col">Clicks</th>
                    </tr>
                </thead>
                <tbody id="bodyTableStadistics" style="text-align: center">
                    
                </tbody>
                <caption>
                    Seleccione el recuadro para ver los detalles
                </caption>
            </table>
        </div>

        <div id="tableDetails" style="display: none" class="col-xs-12 col-sm-12 col-md-12">
            <h6 id="linkSelected" class="text-center"></h6>
            <table style="max-width: 100%" class="table table-bordered table-hover">
                <thead style="text-align: center">
                    <tr class="bg-primary">
                        <th scope="col">Pais</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Fecha Creación</th>
                    </tr>
                </thead>
                <tbody id="bodyTableLink" style="text-align: center">
                </tbody>
                <caption id="totalClicksLink">
                </caption>
            </table>
            <div class="text-center">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <li id="pagination-back" class="btn btn-default">Anterior</li>
                        <li class="btn btn-primary disabled" id="pageNumber"></li>
                        <li id="pagination-next" class="btn btn-default">Siguiente</li>
                    </ul>
                </nav>
            </div>

            <div>
                <div id="chart"></div>
            </div>

            <div id="temp"></div>
        </div>
    </div>
@endsection