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
                                        <input type="hidden" id="id" name="id" value="{{$usersList['id']}}" />
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
                                        <input type="password" name="password" value="######" id="password" class="form-control"  required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"> Rol </label>
                                    <div class="col-sm-9">
                                        <select name="role_id"  id="role_id"  class="form-control select2">
                                            <option value="1" selected>admin</option>
                                            <option value="2">Cobranza</option>
                                            <option value="3">Monitor</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button class="btn btn-success" id="saveusersId" onclick="saveusers()">Guardar</button>
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
                        required: "Por favor ingrese su n??mero de t??lefono",
                        number: 'Ingrese un n??mero de tel??fono valido',
                        minlength: 'Ingrese un n??mero de tel??fono valido',
                        maxlength: 'Ingrese un n??mero de tel??fono valido'
                    },
                    email: "Por favor ingrese un correo electr??nico v??lido",
                    address: {
                        required: "Por favor ingrese una direcci??n",
                        minlength: "Por favor ingrese una direcci??n m??s espec??fica"
                    }

                }
            });
        }

        $(document).ready(function(){
            var roleId = "{{$usersList['role_id']}}";
            $("#role_id").val(roleId).trigger('change');
            validar();              // Inicializar variable jQueryValidator con reglas
        });

        $('#form-users').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });

        function saveusers(){
            // validar formulario
            var action = "{{ $action }}";
            if(action == "create"){
                var msjConfirmacion = "Usuario registrado correctamente.";
            } else {
                var msjConfirmacion = "Usuario modificado correctamente.";
            }
            if($('#form-users').valid()){
                var usersId=$('#usersId').val();
                var mode='{{ $action }}';
                if(mode=="create"){
                    usersId=0;
                }
                if($("#password").val()=="######"){
                    sweetAlert("Debe ingresar una contrase??a nueva");
                    return;
                }
                var url = "{{ url('/users/sendUsers/')}}/"+ mode;

                $.ajax({
                    // la URL para la petici??n
                    url : url,

                    // la informaci??n a enviar
                    // (tambi??n es posible utilizar una cadena de datos)
                    data : readFormValues(document.forms['form-users']),

                    // especifica si ser?? una petici??n POST o GET
                    type : 'post',

                    // el tipo de informaci??n que se espera de respuesta
                    dataType : 'json',

                    // c??digo a ejecutar si la petici??n es satisfactoria;
                    // la respuesta es pasada como argumento a la funci??n
                    beforeSend:function(){
                      $("#saveusersId").prop('disabled', true);
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
                            window.location="{{url('/users')}}";
                        });
                    },

                    // c??digo a ejecutar si la petici??n falla;
                    // son pasados como argumentos a la funci??n
                    // el objeto de la petici??n en crudo y c??digo de estatus de la petici??n
                    error : function(xhr, status) {
                        swal({
                            title: xhr.statusText,
                            text: "Presione el boton para continuar!",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonText: "Error",
                            closeOnConfirm: true
                        },function(){
                            window.location="{{url('/users')}}";
                        });
                    },
                    complete : function(xhr, status) {
                        $("#saveusersId").removeAttr("disabled");
                    }

                });

            }
        }

    </script>
@stop