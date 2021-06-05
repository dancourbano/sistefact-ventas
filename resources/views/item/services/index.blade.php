@extends('layouts.master')
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Servicios</h3>
    </div>



    <div class="panel-body">

        <div class="btn-toolbar" role="toolbar">
            <div class="row pull-right">
                <div class="col-sm-offset-6 col-sm-6">
                    <a class="btn btn-success btn-sm" href="{{ URL::action('ServiceController@create') }}" >Agregar Servicio</a>
                </div>
            </div>
        </div>

        <br>
        
        <table class="table table-bordered table-striped mb-none" id="datatableServices">
            <thead>
            <tr>
                <th>id</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>

            <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->itemId }}</td>
                <td>{{ $service->descripcion }}</td>
                <td>{{ $service->basePrice }}</td>
                <td>{{ $service->status }}</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editService( {{$service->itemId}} )"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteService({{$service->itemId}})"><i class="fa fa-trash-o"></i></button>
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
            $('#datatableServices').dataTable();
        };

        $(function() {
            datatableInit();
        });

        $('#datatableServices tr').each(function() {
            $(this).find("td").eq(3).html(showStatus($(this).find("td").eq(3).html()));
        });

    }).apply(this, [jQuery]);

    function showStatus(status){
        switch(status){
            case '1':  return 'Activo'; break;
            case '0':  return 'Inactivo'; break;
        }

    }

    function editService(serviceId){
        if(serviceId == undefined){
            sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Servicio", "warning");
            return false;
        }
        var url = ("{{ URL::action('ServiceController@edit',['serviceId']) }}").replace('serviceId',serviceId);
        $(location).attr('href',url);
    }

    function deleteService(serviceId){
            swal({
                    title: "Confirme eliminación",
                    text: "Esta seguro de eliminar este servicio?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "No, cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false },
                function(isConfirm){
                    if (isConfirm) {
                        console.log("presionado");
                        var url1 = ("{{ URL::action('ItemController@getIfItemIsUsed',['serviceId']) }}").replace('serviceId',serviceId);
                        $.ajax({
                            url: url1,
                            dataType: 'json',
                            async:'false',
                            type: 'GET',
                            success: function(data) {
                                var serviceIsUsed = data;

                                console.log(data);

                                if(serviceIsUsed){

                                    swal({
                                        title: "No es posible eliminar el servicio!",
                                        text: "Existen facturas o paquetes registrados con el servicio.",
                                        type: "warning"
                                    });

                                } else {
                                    swal({
                                            title: "Eliminado!",
                                            text: "Servicio eliminado con éxito.",
                                            type: "success"},
                                        function(isConfirm2){
                                            if(isConfirm2){
                                                var url = ("{{ URL::action('ServiceController@delete',['serviceId']) }}").replace('serviceId',serviceId);
                                                $(location).attr('href',url);
                                            }
                                        }
                                    );
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(jqXHR.responseJSON.error.message);
                            }
                        });

                    } else {
                        swal("Cancelado",
                            "Eliminación cancelada",
                            "error");
                    } });
        }
</script>
@stop