@extends('layouts.master')
@section('title')
Servicios
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            @if ($action == "create")
            Registrar nuevo servicio
            @else
            Editar servicio
            @endif
        </h3>
    </div>
    <div class="panel-body">
        <form id="form-service" name="form-service" action="" method="post" class="form-horizontal cmxform">
            <fieldset>
                <div class="container-fluid">
                    <div class="row">

                        <div class="form-group">
                            <div class="row col-sm-12">
                                <label  class="col-sm-3 control-label"> Descripción </label>
                                <div class="col-sm-6">
                                    <input type="text" name="descripcion"  id="descripcion" value="{{$dataService['descripcion']}}" class="form-control"  required />
                                    <input type="hidden" name="serviceId" id="serviceId" value="{{$dataService['itemId']}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row col-sm-12">
                                <label  class="col-sm-3 control-label"> Precio de costo </label>
                                <div class="col-sm-6">
                                    <div class="input-group mb-md">
                                        <span class="input-group-addon">S/.</span>
                                        <input type="text" name="basePrice"  id="basePrice" value="{{$dataService['basePrice']}}" class="form-control"  required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row col-sm-12">
                                <label  class="col-sm-3 control-label"> Estado </label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </br>

            </fieldset>
         </form>

    <div class="panel-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-right">
                        <button id="saveServiceId" class="btn btn-success" onclick="saveService()">
                            Guardar servicio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    var jQueryValidator;

    $(document).ready(function(){
        var status = "{{$dataService['status']}}";
        $("#status").val(status).trigger('change');
    });

    function validarServicio(){
        jQueryValidator = $("#form-service").validate({
            rules: {
                descripcion: {
                    required: true,
                    maxlength: 125
                },
                basePrice: {
                    required: true,
                    number: true,
                    maxlength: 15
                },
                status: {
                    required: true
                }
            },
            messages: {
                descripcion: {
                    required: "Por favor ingrese una descripción para el servicio",
                    maxlength: "La descripcion no puede exceder de 125 caracteres"
                },
                basePrice: {
                    required: "Por favor ingrese un precio para el servicio",
                    number: "Indique el precio en números",
                    maxlength: "El precio no puede exceder de 15 digitos"
                },
                status: {
                    required: "Por favor seleccione un estado para el servicio"
                }
            }
        });
    }

    $(document).ready(function(){
        validarServicio();              // Inicializar variable jQueryValidator con reglas
    });

    $('#form-service').submit(function(e){
        e.preventDefault();             // No procesar formulario por defecto
    });

    function saveService(){

        if($('#form-service').valid()){
            var action = "{{$action}}";
            var url = ("{{ URL::action('ServiceController@sendDataService',[$action]) }}");
            if(action == "create"){
                var msjConfirmacion = "Servicio registrado correctamente.";
            } else {
                var msjConfirmacion = "Servicio modificado correctamente.";
            }

            $.ajax({
                url : url,
                data : readFormValues(document.forms['form-service']),
                type : 'post',
                dataType : 'json',
                beforeSend:function(){
                    $("#saveServiceId").prop('disabled', true);
                },
                success : function(data) {

                    swal({
                        title: msjConfirmacion,
                        text: "Presione el boton para continuar!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                    },function(){
                        window.location=(" {{ URL::action('ServiceController@index') }} ");
                    });

                },
                error : function(xhr, status) {
                    swal({
                        title: xhr.statusText,
                        text: "Presione el boton para continuar!",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonText: "Error",
                        closeOnConfirm: true
                    },function(){
                        window.location="{{URL::action('ServiceController@index')}}";
                    });
                },
                complete : function(xhr, status) {
                    $("#saveServiceId").removeAttr("disabled");
                }
            });
        }
    };
</script>
@stop