@extends('layouts.master')
@section('title')
    @if ( $data['mode'] == 'edit')
        Editar Vehiculo Desactualizado
    @else
        Registrar vehiculo Desactualizado
    @endif

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                @if ($data['mode'] == "create")
                Registrar vehículo Desactualizado
                @else
                Editar vehículo Desactualizado
                @endif
            </h3>
        </div>
        <div class="panel-body LoadingOverlayApi" data-loading-overlay>

            <form id="form-vehicle" name="form-vehicle" action="" method="post" class="form-horizontal cmxform">
                <fieldset>
                    <div class="container-fluid">
                        <div class="invoice">
                            <header class="clearfix">
                                <h5 class="modal-title">Información del Vehículo</h5>
                            </header>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label" > Placa </label>
                                        <div class="col-sm-9">
                                            <input type="hidden" id="vehicleId" name="vehicleId" value="{{$vehicleList['vehicleId']}}" />
                                            <input type="text" name="placa" id="placa" value="{{$vehicleList['placa']}}" class="form-control"  required />
                                        </div>
                                    </div>                                 
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Telefono </label>
                                        <div class="col-sm-9">
                                            <input  name="phone" id="phone" value="{{$vehicleList['phone']}}" class="form-control"   />
                                        </div>
                                    </div>	
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Tipo Comando </label>
                                        <div class="col-sm-9">
                                            <select  name="typeCommandSmsId" id="typeCommandSmsId"  class="form-control"   />
                                            @foreach($typeCommandSmsList as $typeCommand)
                                            
                                                <option @if ($vehicleList['typeCommandSmsId'] ==  $typeCommand->typeCommandSmsId ) selected="selected"
    @endif value="{{ $typeCommand->typeCommandSmsId}}">{{ $typeCommand->type}}</option>                                              
                                            
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <table class="table table-bordered table-striped mb-none" id="datatable-commands">
                                        <thead>
                                        <tr>
                                            <th style="width: 15%;">Orden</th>
                                            <th>Comando</th>                
                                            <th style="width: 25%;"></th> 
                                        </tr>
                                        </thead>

                                        <tbody></tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12">
                                                <div class="btn btn-block btn-info" onclick="addCommandSMS()"><i class="glyphicon glyphicon-plus"></i> Agregar Comando</div>
                                            </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                       
                        
                        
                            
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <button class="btn btn-success" id="saveVehicleId" onclick="saveVehicle()">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>

    

    <!--End Modal -->
@stop
@section('scripts')

    <script>
        var jQueryValidator;        
        var emergencyContacts;
        var datatableSMSCommand;
        $('input.datepicker-bootstrap').datepicker({
            language: "es",
            orientation: "top"
        });

        $('#form-customer').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });
        var elementRow = {              // Object that is inserted on new rows
            name: "<input class='form-control name'   type='text'></ input><input class='form-control' type='hidden' value='-1'></ input>",
            phone : "<textarea class='form-control phone' type='text' value='M-'/>",
                            
            deleteOption :  "<div class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-trash'></i> Quitar</div>"
        };
        function validar(){
            jQueryValidator = $("#form-vehicle").validate({
                rules: {
                    placa: {
                        required: true,
                        maxlength: 7
                    },
                    phone: {
                        required: true,
                        maxlength: 30
                    }
                },
                messages: {
                    placa:{
                        required: "Por favor ingrese la placa",
                        maxlength: 'Ingrese una placa válida'
                    },
                    phone:{
                        required: "Por favor ingrese el Telefono SMS",
                        maxlength:  jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    }                       
                    

                }
            });
        }
        var customerId = "";
        $(document).ready(function(){
            $("#registerDate").datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
           

            datatableSMSCommand = $('#datatable-commands').DataTable({
                "dom": 't'
            });       
           
            
            validar();              // Inicializar variable jQueryValidator con reglas           

        });

        

        $('#form-vehicle').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });     
        
        function addCommandSMS(){
            datatableSMSCommand.row.add([
                elementRow.name,
                elementRow.phone,                 
                elementRow.deleteOption
            ]).draw();
        }
        function saveVehicle(){
             
            // validar formulario

            if($('#form-vehicle').valid()){
                var vehicleId=$('#vehicleId').val();
                var mode="{{$data['mode']}}";
                if(mode=="create"){
                    vehicleId=0;
                }
                var url = ("{{ URL::action('SmsSendController@sendDataVehicle',[$data['mode'],'vehicleId'])}}").replace('vehicleId',vehicleId);;
                $.ajax({
                    // la URL para la petición
                    url : url,

                    // la información a enviar
                    // (también es posible utilizar una cadena de datos)
                    data : {
                        formData: readFormValues(document.forms['form-vehicle'])                       
                    },

                    // especifica si será una petición POST o GET
                    type : 'post',

                    // el tipo de información que se espera de respuesta
                    dataType : 'json',

                    beforeSend:function(){
                        $("#saveVehicle").prop('disabled', true);
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
                            window.location="{{ URL::action('SmsSendController@index') }}";
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
                            window.location="{{URL::action('SmsSendController@index')}}";
                        });
                    },
                    complete : function(xhr, status) {
                        $("#saveVehicleId").removeAttr("disabled");
                    }

                });

            }
        };

    </script>
@stop