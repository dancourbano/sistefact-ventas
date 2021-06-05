@extends('layouts.master')
@section('title')
Clientes
@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                @if ($data['mode'] == "create")
                Registrar nuevo cliente
                @else
                Editar cliente
                @endif
            </h3>
        </div>
        <div class="panel-body LoadingOverlayApi" data-loading-overlay>
            <form id="form-customer" name="form-customer" action="" method="post" class="form-horizontal cmxform">
                <fieldset>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label" > Nombre </label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="customerId" name="customerId" value="{{$customerList['customerId']}}" />
                                        <input type="text" name="name" id="name" value="{{$customerList['name']}}" class="form-control"  required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Apellidos </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="lastName" value="{{$customerList['lastName']}}" id="lastName" class="form-control"  required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label">DNI o RUC<div id="labelIdentification"></div>  </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="identification"  id="identification" value="{{$customerList['identification']}}" class="form-control"  required />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Telefono 1 </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone1"  id="phone1" value="{{$customerList['phone1']}}" class="form-control"  required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Telefono 2 </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone2"  id="phone2" value="{{$customerList['phone2']}}" class="form-control"  />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Direccion </label>
                                    <div class="col-sm-9">
                                        <input  name="address" id="address" value="{{$customerList['address']}}" class="form-control"  />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Tipo Cliente </label>
                                    <div class="col-sm-9">

                                        <select onchange="changeIdentification()" name="type"  id="type"  class="form-control select2">
                                            <option value="1" selected>Natural</option>
                                            <option value="2">Empresa</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Email </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="{{$customerList['email']}}" id="email" class="form-control"   />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Estado Civil </label>
                                    <div class="col-sm-9">
                                        <select name="maritalStatus"  id="maritalStatus"  class="form-control select2">
                                            <option value="SO" selected>Soltero</option>
                                            <option value="CA">Casado</option>
                                            <option value="DI">Divorciado</option>
                                            <option value="VI">Viudo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Ciudad </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="city" value="{{$customerList['city']}}" id="city" class="form-control"  required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Fec. Nac </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="birthday"    value="{{$customerList['birthday']}}" id="birthday" class="form-control datepicker-bootstrap"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">

                            </div>
                        </div>
                    </div>




                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">

                                    <button  class="btn btn-success" id="saveCustomerId" onclick="saveCustomer()" >Guardar</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
@stop
@section('scripts')

    <script>
        var jQueryValidator;
        $('input.datepicker-bootstrap').datepicker({
            language: "es",
            orientation: "top"
        });
        function validar(){
            jQueryValidator = $("#form-customer").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 45
                    },
                    lastName: {
                        required: true,
                        maxlength: 45
                    },
                    identification: {
                        required: true,
                        number: true,
                        minlength: 8,
                        maxlength: 12
                    },
                    phone1: {
                        required: true,                        
                        minlength: 6,
                        maxlength: 25
                    },
                    phone2: {
                        minlength: 6,
                        maxlength: 25
                    },
                    email: {
                        
                        email: true,
                        maxlength: 65
                    },
                    address: {                        
                        minlength: 7,
                        maxlength: 65
                    },
                    city: {
                        required: true,
                        minlength: 4,
                        maxlength: 45
                    },
                    type:{
                        required:true
                    },
                    maritalStatus:{
                        required:true
                    }
                },
                messages: {
                    name: "Por favor ingrese su nombre",
                    lastName: "Por favor ingrese su apellido",
                    identification: {
                        required: "Por favor ingrese su DNI o RUC",
                        number: 'Ingrese un DNI/RUC válido',
                        minlength: 'Ingrese un DNI/RUC válido',
                        maxlength: 'Ingrese un DNI/RUC válido'
                    },
                    phone1: {
                        required: "Por favor ingrese su número de télefono",
                        
                        minlength: 'Ingrese un número de teléfono válido',
                        maxlength: 'Ingrese un número de teléfono válido'
                    },
                    phone2: {                        
                        minlength: 'Ingrese un número de teléfono válido',
                        maxlength: 'Ingrese un número de teléfono válido'
                    },
                    email: "Por favor ingrese un correo electrónico válido",
                    address: {                        
                        minlength: "Por favor ingrese una dirección más específica"
                    },
                    type:{
                        required: "El tipo Cliente es requerido"
                    },
                    city:{
                        required: "Por favor ingrese una Ciudad",
                        maxlength: 'Ingrese un número de Ciudad válida'
                    },
                    maritalStatus:{
                        required: "El Estado Civil es requerido"
                    }

                }
            });
        }

        $(document).ready(function(){

            var maritalStatus = "{{$customerList['maritalStatus']}}";
            $("#maritalStatus").val(maritalStatus).trigger('change');
            var type = "{{$customerList['type']}}";
            $("#type").val(type).trigger('change');

            if($("#type").val()=="1" || $("#type").val()==undefined){
                $("#labelIdentification").text("Dni");
            }
            else $("#labelIdentification").text("Ruc");

            validar();              // Inicializar variable jQueryValidator con reglas
        });

        $('#form-customer').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });
        function changeIdentification(){
            if($("#type").val()=="1" || $("#type").val()==""){
                $("#labelIdentification").text("Dni");
            }
            else $("#labelIdentification").text("Ruc");
        }

        function saveCustomer(){
            // validar formulario
            var action = "{{ $action }}";
            if(action == "create"){
                var msjConfirmacion = "Cliente registrado correctamente.";
            } else {
                var msjConfirmacion = "Cliente modificado correctamente.";
            }
            if($('#form-customer').valid()){
                var customerId=$('#customerId').val();
                var mode='{{$data['mode']}}';
                if(mode=="create"){
                    customerId=0;
                }


                var action = "{{ $action }}";
                var url = ("{{ URL::action('CustomerController@sendDataCustomer',['action']) }}").replace("action",action);


                $.ajax({
                    // la URL para la petición
                    url : url,

                    // la información a enviar
                    // (también es posible utilizar una cadena de datos)
                    data : readFormValues(document.forms['form-customer']),

                    // especifica si será una petición POST o GET
                    type : 'post',

                    // el tipo de información que se espera de respuesta
                    dataType : 'json',

                    // código a ejecutar si la petición es satisfactoria;
                    // la respuesta es pasada como argumento a la función

                    beforeSend:function(){
                        $("#saveCustomer").prop('disabled', true);
                        $('.LoadingOverlayApi').trigger('loading-overlay:show');
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
                            window.location="{{URL::action('CustomerController@index')}}";
                        });


                    },

                    // código a ejecutar si la petición falla;
                    // son pasados como argumentos a la función
                    // el objeto de la petición en crudo y código de estatus de la petición
                    error : function(xhr, status) {

                        $('.LoadingOverlayApi').trigger('loading-overlay:hide');
                        swal({
                            title: xhr.statusText,
                            text: "Presione el boton para continuar!",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonText: "Error",
                            closeOnConfirm: true
                        },function(){
                            window.location="{{URL::action('CustomerController@index')}}";
                        });
                    },
                    complete : function() {

                        $("#saveCustomerId").removeAttr("disabled");
                    }

                });

            }
        };

    </script>
@stop