@extends('layouts.master')
@section('title')
Movimientos
@stop
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Movimientos</h3>
    </div>

    <div class="panel-body">



        <div class="btn-toolbar" role="toolbar">
            <div class="row">

                <form id="form-filter-movement" action="" method="get" class="form-horizontal">
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
                                    <a  class="btn btn-info btn-sm" onclick="filterMovements()" >Filtrar Movimientos</a>
                                </div>
                 
                        </div>

                        <div class="row">
                            <div class="col-md-4 pull-right">
                                <a class="btn btn-success btn-sm" href="{{ URL::action('MovementController@create') }}" >
                                    Agregar Movimiento
                                </a>
                            </div>
                        </div>
                        <br>
                    
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped mb-none" id="datatableMovements">
            <thead>
            <tr>
                <th>id</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Concepto</th>
                <th>Responsable</th>
                <th>Fecha</th>
                <th>Opciones</th>
            </tr>
            </thead>

            <tbody>
            @foreach($movements as $movement)
            <tr>
                <td>{{ $movement->movementId }}</td>
                <td>{{ $movement->type }}</td>
                <td>{{ $movement->quantity }}</td>
                <td>{{ $movement->concept }}</td>
                <td>{{ $movement->sender }}</td>
                <td>{{ $movement->createdDate }}</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editMovement({{$movement->movementId}})"><i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteMovement({{$movement->movementId}})"><i class="fa fa-trash-o"></i>
                    </button>
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

    var datatableMovements;

    (function($) {

        'use strict';

        $('#datatableMovements tr').each(function() {
            $(this).find("td").eq(1).html(showType($(this).find("td").eq(1).html()));
        });


    }).apply(this, [jQuery]);

    $(document).ready(function(){
        datatableMovements = $('#datatableMovements').DataTable({});
    });

    function showType(type){
        switch(type){
            case '1': return 'Ingreso'; break;
            case '2': return 'Egreso'; break;
            case '3': return 'Préstamo'; break;
        }

    }

    function editMovement(movementId){
        if(movementId == undefined){
            sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Movimiento", "warning");
            return false;
        }
        var url = ("{{ URL::action('MovementController@edit',['movementId']) }}").replace('movementId',movementId);
        $(location).attr('href',url);
    }

    function deleteMovement(movementId){
        swal({
                title: "Confirme eliminación",
                text: "Esta seguro de eliminar este movimiento?",
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
                            text: "Movimiento eliminado con éxito.",
                            type: "success"},
                        function(isConfirm){
                            if(isConfirm){
                                var url = (" {{ URL::action('MovementController@delete',['movementId']) }} ").replace('movementId',movementId);
                                $(location).attr('href',url);
                            }
                        }
                    );
                } else {
                    swal("Cancelado",
                        "Eliminación cancelada",
                        "error");
                } });
    }

    $('.input-daterange input').datepicker({
            orientation: "auto"
        });

    function filterMovements() {
        var url = "{{ URL::action('MovementController@filterMovement') }}";

        $.ajax({
            url : url,
            type : 'get',
            data: readFormValues(document.forms['form-filter-movement']),
            dataType : 'json',

            success : function(data) {

                datatableMovements.clear().draw();
                    var i=0;
                    for(i in data){
                        datatableMovements.row.add( [
                            data[i].movementId,
                            data[i].type,
                            data[i].concept,
                            data[i].sender,
                            data[i].createdDate,
                            "<button class='btn btn-info btn-sm' onclick='editMovement("+data[i].movementId+")'><i class='fa fa-pencil'></i></a> <button class='btn btn-danger btn-sm' onclick='deleteMovement("+data[i].movementId+")'><i class='fa fa-trash-o'></i></button>"
                        ] );

                    }


                datatableMovements.draw();

                $('#datatableMovements tr').each(function() {
                    $(this).find("td").eq(1).html(showType($(this).find("td").eq(1).html()));
                });                

            },
            error : function(xhr, status) {
            }
        });

    }

</script>
@stop