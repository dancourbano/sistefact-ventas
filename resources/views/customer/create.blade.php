@extends('layouts.master')
@section('title')
    @if ( $data['mode'] == 'edit')
        - Editar cliente
    @else
        - Registrar nuevo cliente
    @endif

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <form id="form-customer" name="form-customer" action="{{URL::action('CustomerController@sendDataCustomer');}}" method="post" class="form-horizontal cmxform">
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
                                    <label  class="col-sm-3 control-label"> DNI </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="identificationId"  id="identificationId" value="{{$customerList['identificationId']}}" class="form-control"  required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Telefono </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="telephone"  id="telephone" value="{{$customerList['telephone']}}" class="form-control"  required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Apellidos </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="lastName" value="{{$customerList['lastName']}}" id="lastName" class="form-control"  required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Email </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="{{$customerList['email']}}" id="email" class="form-control"  required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Estado Civil </label>
                                    <div class="col-sm-9">
                                        <select name="maritalStatus"  id="maritalStatus"  class="form-control select2">
                                            <option value="SO">Soltero</option>
                                            <option value="CA">Casado</option>
                                            <option value="DI">Divorciado</option>
                                            <option value="VI">Viudo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label"> Direccion </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="address" id="address" value="{{$customerList['address']}}" class="form-control"  required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <a class="btn btn-primary" onclick="saveCustomer()">Guardar</a>
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
                    identificationId: {
                        required: true,
                        number: true,
                        minlength: 8,
                        maxlength: 8
                    },
                    telephone: {
                        required: true,
                        number: true,
                        minlength: 6,
                        maxlength: 45
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 65
                    },
                    address: {
                        required: true,
                        minlength: 7,
                        maxlength: 65
                    }
                },
                messages: {
                    name: "Por favor inregrese su nombre",
                    lastName: "Por favor ingrese su apellido",
                    identificationId: {
                        required: "Por favor ingrese su DNI",
                        number: 'Ingrese un DNI valido',
                        minlength: 'Ingrese un DNI valido',
                        maxlength: 'Ingrese un DNI valido'
                    },
                    telephone: {
                        required: "Por favor ingrese su número de télefono",
                        number: 'Ingrese un número de teléfono valido',
                        minlength: 'Ingrese un número de teléfono valido',
                        maxlength: 'Ingrese un número de teléfono valido'
                    },
                    email: "Por favor ingrese un correo electrónico válido",
                    address: {
                        required: "Por favor ingrese una dirección",
                        minlength: "Por favor ingrese una dirección más específica"
                    }

                }
            });
        }

        $(document).ready(function(){
            var maritalStatus = "{{$customerList['maritalStatus']}}";
            $("#maritalStatus").val(maritalStatus).trigger('change');
            validar();              // Inicializar variable jQueryValidator con reglas
        });

        $('#form-customer').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });

        function saveCustomer(){
            // validar formulario

            if($('#form-customer').valid()){
                var customerId=$('#customerId').val();
                var mode='{{$data['mode']}}';
                if(mode=="create"){
                    customerId=0;
                }
                var url = "{{ url()}}/customer/sendCustomer/"+ mode+ "/"+ customerId;

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
                    success : function(data) {

                    },

                    // código a ejecutar si la petición falla;
                    // son pasados como argumentos a la función
                    // el objeto de la petición en crudo y código de estatus de la petición
                    error : function(xhr, status) {

                    },
                    complete : function(xhr, status) {
                        window.location="{{URL::to('customer')}}";
                    }

                });

            }
        };

    </script>
@stop