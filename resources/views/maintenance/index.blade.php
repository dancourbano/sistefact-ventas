@extends('layouts.master')
@section('title')
Mantenimientos
@stop
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Mantenimientos</h3>
    </div>

    <div class="panel-body">
        <div class="btn-toolbar" role="toolbar">
            <div class="row">
                <form id="form-filter-maintenance" action="" method="get" class="form-horizontal">
                    <div class="container-fluid">
                        <div class="row">
                            <label class="col-md-3 control-label">Fecha </label>
                            <div class="col-md-5">
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                    <input type="text" class="form-control" name="startDate" id="startDate" value="<?php echo date("Y"); ?>-01-01">
                                    <span class="input-group-addon">hasta</span>
                                    <input type="text" class="form-control" name="endDate" id="endDate" value="<?php echo date("Y-m-d");?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a  class="btn btn-info btn-sm" onclick="filterMaintenance()" >Filtrar Mantenimientos</a>
                            </div>
                        </div>
                        <br>
                    </div>
                </form>
            </div>
        </div>


        <table class="table table-bordered table-striped mb-none" id="datatableMaintenances">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Estado</th>
                    <th>Detalle</th>
                    <th>Fecha de mantenimiento</th>
                    <th>Placa del vehículo</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>
            @foreach($maintenances as $maintenance)
                <tr>
                    <td>{{ $maintenance->maintenanceId }}</td>
                    <td>{{ $maintenance->status }}</td>
                    <td>{{ $maintenance->detail }}</td>
                    <td>{{ $maintenance->maintenanceDate }}</td>
                    <td>{{ $maintenance->placa }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="editMaintenance( {{$maintenance->maintenanceId}} )"><i class="fa fa-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteMaintenance({{$maintenance->maintenanceId}})"><i class="fa fa-trash-o"></i></button>
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

        $('#datatableMaintenances tr').each(function() {
            $(this).find("td").eq(1).html(showStatus($(this).find("td").eq(1).html()));
        });


    }).apply(this, [jQuery]);

    $(document).ready(function(){
        datatableMaintenances = $('#datatableMaintenances').DataTable({



        });
        $('#datatableMaintenances>thead>tr>th:nth-child(1),#datatableMaintenances>tbody>tr>td:nth-child(1)')
                .css("width", "2%");

    });
    $('#datatableMaintenances>thead>tr>th:nth-child(3),#datatableMaintenances>tbody>tr>td:nth-child(3)')
            .css("width", "52%");
    $('.input-daterange input').datepicker({
            orientation: "auto"
        });

    function showStatus(status){
        switch(status){
            case '0':  return '<label class="label label-danger">No atendido</label>'; break;
            case '1':  return '<label class="label label-success">Atendido</label>'; break;
        }
    }

    function editMaintenance(maintenanceId){
        if(maintenanceId == undefined){
            sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Mantenimiento", "warning");
            return false;
        }
        var url = ("{{ URL::action('MaintenanceController@edit',['maintenanceId']) }}").replace('maintenanceId',maintenanceId);
        $(location).attr('href',url);
    }

    function deleteMaintenance(maintenanceId){
        swal({
                title: "Confirme eliminación",
                text: "Esta seguro de eliminar este mantenimiento?",
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
                            text: "Mantenimiento eliminado con éxito.",
                            type: "success"},
                            function(isConfirm){
                                if(isConfirm){
                                    var url = ("{{ URL::action('MaintenanceController@delete',['maintenanceId']) }}").replace('maintenanceId',maintenanceId);
                                    $(location).attr('href',url);
                                }
                            }
                        );
                    } else {
                        swal("Cancelado",
                            "Eliminación cancelada",
                            "error");
                    } 
                }
        );
    }

    function filterMaintenance() {
        var url = "{{ URL::action('MaintenanceController@filterMaintenance1') }}";

        $.ajax({
            url : url,
            type : 'post',
            data: readFormValues(document.forms['form-filter-maintenance']),
            dataType : 'json',
            success : function(data) {

                datatableMaintenances.clear().draw();
                    var i=0;

                    for(i in data){
                        datatableMaintenances.row.add( [
                            data[i].maintenanceId,
                            data[i].status,
                            data[i].detail,
                            data[i].maintenanceDate,
                            data[i].placa,
                            "<button class='btn btn-info btn-sm' onclick='editMaintenance("+data[i].maintenanceId+")'><i class='fa fa-pencil'></i></button> <button class='btn btn-danger btn-sm' onclick='deleteMaintenance("+data[i].maintenanceId+")'><i class='fa fa-trash-o'></i></button>"
                        ] );

                    }

                datatableMaintenances.draw();

                $('#datatableMaintenances tr').each(function() {
                    $(this).find("td").eq(1).html(showStatus($(this).find("td").eq(1).html()));
                });


            },
            error : function(xhr, status) {
            }
        });

    }
</script>
@stop