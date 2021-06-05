@extends('layouts.master')
@section('title')


@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <form id="form-users" name="form-users" action="{{url('UsersController@store')}}" method="post" class="form-horizontal cmxform">
                <fieldset>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label" > Nombre </label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="usersId" name="usersId" value="{{$usersList['id']}}" />
                                        <input type="text" name="name" id="name" value="{{$usersList['name']}}" class="form-control"  required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> email </label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email"  id="email" value="{{$usersList['email']}}" class="form-control"  required />
                                    </div>
                                </div>


                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Password </label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" value="{{$usersList['password']}}" id="password" class="form-control"  required />
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>


                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <a class="btn btn-primary" onclick="saveusers()">Guardar</a>
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
            jQueryValidator = $("#form-users").validate({
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

            validar();              // Inicializar variable jQueryValidator con reglas
        });

        $('#form-users').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });

        function saveusers(){
            // validar formulario

            if($('#form-users').valid()){
                var usersId=$('#usersId').val();
                var mode='{{$data['mode']}}';
                if(mode=="create"){
                    usersId=0;
                }
                var url = "{{ url('/users/store/')}}"+ mode+ "/"+ usersId;

                $.ajax({
                    // la URL para la petición
                    url : url,

                    // la información a enviar
                    // (también es posible utilizar una cadena de datos)
                    data : readFormValues(document.forms['form-users']),

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
                        window.location="{{URL::to('users')}}";
                    }

                });

            }
        };

    </script>
@stop