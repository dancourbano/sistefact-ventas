@extends('layouts.master')
@section('title')
Conductores

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Conductores</h3>
        </div>

        <div class="panel-footer">
            <div class="btn-toolbar" role="toolbar">
                <div class="row pull-right">
                    <br>
                    <div class="col-sm-12">

                        <a class="btn btn-success" href="{{ URL::action('DriverController@showDriver',['create',0]) }}">Agregar Conductor</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <table class="table table-striped table-hover table-responsive datatable" id="datatable-driver">
                <thead>
                    <tr>

                        <th>Id</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Automóvil</th>

                        <th>Opciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php $i = 0 ?>
                    @foreach ($driverBE as $row)
                        <?php $i++ ?>
                        <tr>

                            <td>{{ $i }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->lastName }}</td>
                            <td>{{ $row->address }}</td>
                            <td>{{ $row->identification }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->placa }}</td>

                            <td>
                                <div>
                                    <button class="btn btn-info btn-sm" onclick="editDriver( {{ $row->driverId}} )"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-warning btn-sm" onclick="deleteDriver( {{ $row->driverId}} )"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        (function($) {

            'use strict';

            var datatableInit = function() {
                $('#datatable-driver').dataTable({
                    "iDisplayLength": 10
                });
            };

            $(function() {
                datatableInit();
            });

        }).apply(this, [jQuery]);

        $(document).ready(function(){
            $('#datatable-driver>thead>tr>th:nth-child(1),#datatable-driver>tbody>tr>td:nth-child(1)')
                .css("width", "8%");
        });

        function editDriver(driverId){
            if(driverId == undefined){
                sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Conductor", "warning");
                return false;
            }


            var url = ("{{ URL::action('DriverController@showDriver',['edit','driverId']) }}").replace('driverId',driverId);


            $(location).attr('href',url);
        }

        function deleteDriver(idDriver){
            swal({
                        title: "Confirme eliminación",
                        text: "Esta seguro de eliminar este Conductor?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Si, eliminar",
                        cancelButtonText: "No, cancelar",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function(isConfirm){
                        if (isConfirm) {
                            swal({
                                        title: "Eliminado!",
                                        text: "Eliminacción realizada.",
                                        type: "success"},
                                    function(isConfirm){
                                        if(isConfirm){

                                            var url = ("{{ URL::action('DriverController@delete',['driverId']) }}").replace('driverId',idDriver);

                                            $(location).attr('href',url);
                                        }
                                    }
                            );
                        } else {
                            swal("Cancelado",
                                    "Operacion cancelada",
                                    "error");
                        } });
        }
    </script>
@stop