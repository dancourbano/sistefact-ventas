@extends('layouts.master')
@section('title')
Conductor

@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            @if ($data['mode'] == "create")
            Registrar nuevo conductor
            @else
            Editar Conductor
            @endif
        </h3>
    </div>
    <div class="panel-body LoadingOverlayApi" data-loading-overlay>

        <form id="form-driver" name="form-driver" action="" method="post" class="form-horizontal cmxform">
            <fieldset>
                <div class="container-fluid">
                    <div class="row">

                                <div class="form-group">
                                    <div class="row col-sm-10">
                                        <label  class="col-sm-3 control-label" > Nombre </label>
                                        <div class="col-sm-9">
                                            <input type="hidden" id="driverId" name="driverId" value="{{$driver['driverId']}}" />
                                            <input type="text" name="name" id="name" value="{{$driver['name']}}" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row col-sm-10">
                                        <label  class="col-sm-3 control-label"> Apellidos </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="lastName" value="{{$driver['lastName']}}" id="lastName" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row col-sm-10">
                                        <label  class="col-sm-3 control-label"> DNI </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="identification" value="{{$driver['identification']}}" id="identification" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row col-sm-10">

                                        <label  class="col-sm-3 control-label"> Telefono</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="phone"  id="phone" value="{{$driver['phone']}}" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-sm-10">

                                        <label  class="col-sm-3 control-label"> Direccion </label>
                                        <div class="col-sm-9">
                                            <input  name="address" id="address" value="{{$driver['address']}}" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row col-sm-10">

                                        <div class="row col-sm-12">
                                            <label  class="col-sm-3 control-label"> Vehiculo </label>
                                            <div class="col-sm-6">
                                                <select data-plugin-selectTwo name="vehicleId" id="vehicleId"  class="form-control populate "  >
                                                    <option value="">[Seleccione]</option>
                                                    @foreach($vehicleList as $row)
                                                    <option value="{{$row->vehicleId}}">{{$row->placa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="panel-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-right">
                            <button class="btn  btn-success" id="saveDriverId" onclick="saveDriver()">
                                Guardar conductor
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@stop
@section('scripts')

    <script>
        var jQueryValidator;
        function validar(){
            jQueryValidator = $("#form-driver").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 45
                    },
                    lastName: {
                        required: true,
                        maxlength: 45
                    },
                    phone: {
                        required: true,
                        minlength: 6,
                        maxlength: 25
                    },
                    address: {
                        required: true,
                        minlength: 7,
                        maxlength: 65
                    },
                    vehicleId: {
                        required: true
                    },
                    identification: {
                        required: true,
                        number: true,
                        minlength: 8,
                        maxlength: 8
                    }
                },
                messages: {
                    name: "Por favor ingrese nombre",
                    lastName: "Por favor ingrese apellido",
                    phone: {
                        required: "Por favor ingrese número de télefono",
                        minlength: 'Ingrese un número de teléfono válido',
                        maxlength: 'Ingrese un número de teléfono válido'
                    },
                    address: {
                        required: "Por favor ingrese una dirección",
                        minlength: "Por favor ingrese una dirección más específica"
                    },
                    vehicleId: {
                        required: "Por favor seleccione un vehiculo"
                    },
                    identification: {
                        required: "Por favor ingrese su DNI",
                        number: 'Ingrese un DNI válido',
                        minlength: 'Ingrese los 8 digitos de un DNI',
                        maxlength: 'Ingrese los solo 8 digitos'
                    }
                }
            });
        }

        $(document).ready(function(){

            var vehicleId = "{{$driver['vehicleId']}}";
            $("#vehicleId").val(vehicleId).trigger('change');
            validar();              // Inicializar variable jQueryValidator con reglas

        });

        $('#form-driver').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });

        function saveDriver(){
            // validar formulario

            if($('#form-driver').valid()){
                var driverId=$('#driverId').val();
                var mode='{{$data['mode']}}';
                if(mode=="create"){
                    driverId=0;
                }
                var url = ("{{ URL::action('DriverController@sendDataDriver',[$data['mode'],'driverId'])}}").replace('driverId',driverId);

                $.ajax({
                    // la URL para la petición
                    url : url,

                    // la información a enviar
                    // (también es posible utilizar una cadena de datos)
                    data : readFormValues(document.forms['form-driver']),

                    // especifica si será una petición POST o GET
                    type : 'post',

                    // el tipo de información que se espera de respuesta
                    dataType : 'json',

                    // código a ejecutar si la petición es satisfactoria;
                    // la respuesta es pasada como argumento a la función
                    beforeSend:function(){
                        $("#saveDriverId").prop('disabled', true);
                        $('.LoadingOverlayApi').trigger('loading-overlay:show');
                    },
                    success : function(data) {
                        $('.LoadingOverlayApi').trigger('loading-overlay:hide');
                        swal({
                            title: data.messageDetail,
                            text: "Presione el boton para continuar!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },function(){
                            window.location="{{URL::action('DriverController@index')}}";
                        });

                    },

                    // código a ejecutar si la petición falla;
                    // son pasados como argumentos a la función
                    // el objeto de la petición en crudo y código de estatus de la petición
                    error : function(xhr, status) {

                        swal({
                            title: xhr.statusText,
                            text: "Presione el boton para continuar!",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonText: "Error",
                            closeOnConfirm: true
                        },function(){
                            window.location="{{URL::action('DriverController@index')}}";
                        });
                    },
                    complete : function(xhr, status) {
                        $("#saveDriverId").removeAttr('disabled');
                    }

                });

            }
        };

    </script>
@stop