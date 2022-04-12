@extends('layouts.master')

@section('styles')
    <style>
        .button-edit {
            margin-right: 0px; 
        }

        .button-delete {
            margin-left: 0px;
        }
        
        @media screen and (min-width: 992px) {
            .button-edit {
                margin-right: 5px;
            }

            .button-delete {
                margin-left: 5px;
            }
        }

        .status-active {
            font-weight:bold;
            color:green;
        }
        .status-inactive {
            font-weight:bold;
            color:red;
        }
    </style>
@endsection

@section('script')
<script type="text/javascript" src="{{URL::to('assets/js/Premium.js')}}"></script>
<script type="text/javascript">
    InitPremium({
        baseurl: {!!json_encode(URL::to('/'))!!},
        csrf: '{{ csrf_token() }}',
    });
</script>
@endsection

@section('content')
    <div class="container" style="padding: 5%">

        <div id="add_email" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Añadir a la lista de acceso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="email_add">{{ __('E-Mail Address') }}</label>
                                    <input id="email_add" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" id="button_add" class="btn btn-success">
                            <i class = "ti ti-save"></i>
                            <span>Añadir</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="update_email" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_list" name="id_list">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="email_update">{{ __('E-Mail Address') }}</label>
                                    <input id="email_update" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="status">{{ __('messages.status') }}</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" id="button_update" class="btn btn-success">
                            <i class = "ti ti-save"></i>
                            <span>Guardar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="alert-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal-title" class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <p id="message-alert" class="text-center"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom: 10px">
            <h4 class="text-center">{{__('messages.premium_content') }}</h4>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
            <button class="btn btn-success" data-toggle="modal" data-target="#add_email">
                <i class="ti ti-plus"></i>
                <span>Añadir Email</span>
            </button>
        </div>
        
        <div id="tableDetails" class="col-xs-12 col-sm-12 col-md-12">
            <h6 id="white_list" class="text-center"></h6>
            <table style="max-width: 100%" class="table table-bordered table-hover">
                <thead style="text-align: center">
                    <tr class="bg-primary">
                        <th scope="col">{{__ ('messages.email') }}</th>
                        <th scope="col">{{__ ('messages.status') }}</th>
                        <th scope="col">{{__ ('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="bodyTableList" style="text-align: center">
                </tbody>
                <caption id="totalList">
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
    </div>
@endsection