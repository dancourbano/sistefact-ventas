@extends('layouts.master')
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Paquetes</h3>
    </div>

    <div class="panel-body">

        <div class="btn-toolbar" role="toolbar">
            <div class="row pull-right">
                <div class=" col-sm-12">
                    <a class="btn btn-success btn-sm" href="{{ URL::action('PackageController@create') }}" >      Agregar Paquete
                    </a>
                </div>
                <br>
            </div>
        </div>

        <br>
        
        <table class="table table-bordered table-striped mb-none" id="datatablePackages">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Servicios</th>
                    <th>Productos</th>
                    <th>Creación</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>
            @foreach($packages as $package)
            <tr>
                <td>{{ $package->packageId }}</td>
                <td>{{ $package->name }}</td>
                <td>{{ $package->basePrice }}</td>
                <td>{{ $package->servicios }}</td>
                <td>{{ $package->productos }}</td>
                <td>{{ $package->createdDate }}</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editPackage({{$package->packageId}})"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deletePackage({{$package->packageId}})"><i class="fa fa-trash-o"></i></button>
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
            $('#datatablePackages').dataTable();
        };

        $(function() {
            datatableInit();
        });


    }).apply(this, [jQuery]);

    function editPackage(packageId){
        if(packageId == undefined){
            sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Paquete", "warning");
            return false;
        }
        var url = ("{{ URL::action('PackageController@edit',['packageId']) }}").replace('packageId',packageId);
        $(location).attr('href',url);
    }

    function deletePackage(packageId){
    
            swal({
                    title: "Confirme eliminación",
                    text: "Esta seguro de eliminar este paquete?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "No, cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false },
                function(isConfirm){
                    if (isConfirm) {

                        $.ajax({
                            url: ("{{URL::action('PackageController@getIfPackageIsUsed',['packageId'])}}").replace('packageId',packageId),
                            dataType: 'json',
                            async:'false',
                            type: 'GET',
                            success: function(data) {
                                var packageIsUsed = data;

                                if(packageIsUsed){

                                    swal({
                                        title: "No es posible eliminar el paquete!",
                                        text: "Existen facturas registradas con el paquete.",
                                        type: "warning"
                                    });

                                } else {
                                    swal({
                                            title: "Eliminado!",
                                            text: "Paquete eliminado con éxito.",
                                            type: "success"},
                                        function(isConfirm2){
                                            if(isConfirm2){
                                                var url = ("{{URL::action('PackageController@delete',['packageId'])}}").replace('packageId',packageId) ;
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