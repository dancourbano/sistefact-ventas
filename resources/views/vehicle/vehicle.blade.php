@extends('layouts.master')
@section('title')
    @if ( $data['mode'] == 'edit')
        Editar Vehiculo
    @else
        Registrar nuevo vehiculo
    @endif

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                @if ($data['mode'] == "create")
                Registrar nuevo vehículo
                @else
                Editar vehículo
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
                                        <label  class="col-sm-3 control-label"> Sn </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sn" id="sn" value="{{$vehicleList['sn']}}"  class="form-control"  required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Código  </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="shortNumber"  id="shortNumber" value="{{$vehicleList['shortNumber']}}" class="form-control"  required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> N° motor </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="motorNumber"  id="motorNumber" value="{{$vehicleList['motorNumber']}}" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Año </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="year"  id="year" value="{{$vehicleList['year']}}" class="form-control"   />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Marca Veh. </label>
                                        <div class="col-sm-9">
                                            <input  name="brandCar" id="brandCar" value="{{$vehicleList['brandCar']}}" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Modelo </label>
                                        <div class="col-sm-9">
                                            <input  name="modelClass" id="modelClass" value="{{$vehicleList['modelClass']}}" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Mg </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mg"    value="{{$vehicleList['mg']}}" id="mg" class="form-control d"  />
                                        </div>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Serie Chasis </label>
                                        <div class="col-sm-9">
                                            <input  name="chasisSerie" id="chasisSerie" value="{{$vehicleList['chasisSerie']}}" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Fecha Ingreso </label>
                                        <div class="col-sm-9">
                                            <input  name="registerDate" id="registerDate" value="{{$vehicleList['registerDate']}}" class="form-control datetimepicker-bootstrap"  required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Clase </label>
                                        <div class="col-sm-9">
                                            <input  name="classCar" id="classCar" value="{{$vehicleList['classCar']}}" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> N° Movil/interno </label>
                                        <div class="col-sm-9">
                                            <input  name="internalNumber" id="internalNumber" value="{{$vehicleList['internalNumber']}}" class="form-control"  required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Estado </label>
                                        <div class="col-sm-9">
                                            <select data-plugin-selectTwo name="status" id="status" class="form-control select">
                                                <option value="1">Activo</option>
                                                <option value="2">Activo Prestación</option>
                                                <option value="0">Retirado</option>
                                                <option value="3">Exonerado</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Comentario </label>
                                        <div class="col-sm-9">
                                            <input  name="comment" id="comment" value="{{$vehicleList['comment']}}" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Estacion. </label>
                                        <div class="col-sm-9">
                                            <input   name="parkingplace" value="{{$vehicleList['parkingplace']}}" id="parkingplace" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label">Sim </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sim"    value="{{$vehicleList['sim']}}" id="sim" class="form-control "  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice">
                            <header class="clearfix">
                                <h5 class="modal-title">Información del Dispositivo</h5>
                            </header>
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Marca Disp. </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="brandDevice"    value="{{$vehicleList['brandDevice']}}" id="brandDevice" class="form-control"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Imei. </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gpsId"    value="{{$vehicleList['gpsId']}}" id="gpsId" class="form-control "  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice">
                            <header class="clearfix">
                                <h5 class="modal-title">Información del Cliente</h5>
                            </header>
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Cliente </label>
                                        <div class="col-md-9">
                                            <select data-plugin-selectTwo name="customerId" id="customerId" class="form-control select">
                                                <option value="">Seleccionar Cliente</option>
                                            </select>
                                            <p><a class="text-info" data-toggle="modal" href="#modalRegisterCustomer"> Agregar Nuevo Cliente</a></p>
                                            <label class="error" for="customerId"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice">
                            <header class="clearfix">
                                <h5 class="modal-title">Información del Encargado</h5>
                            </header>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Encargado </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mandated"    value="{{$vehicleList['mandated']}}" id="mandated" class="form-control"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Tel. Encargado </label>
                                        <div class="col-sm-9">
                                            <input  name="telMov" id="telMov" value="{{$vehicleList['telMov']}}" class="form-control"   />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice">
                            <header class="clearfix">
                                <h5 class="modal-title">Información de Emergencia</h5>
                            </header>
                            <div class="row">
                                <div class="form-group">
                                    <div class="row col-sm-12">
                                        <label  class="col-sm-3 control-label"> Contactos de emergencia </label>
                                        <div class="col-sm-9">
                                            <table class="table table-bordered table-striped mb-none" id="datatableEmergencyContacts">
                                                <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Teléfono</th>
                                                    <th>Dni</th>
                                                    <th>Opciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <br/>
                                            <div class="row">
                                                <div class="btn btn-block btn-info" onclick="addEmergencyContact()"><i class="glyphicon glyphicon-plus"></i> Agregar contacto de emergencia</div>
                                            </div>
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

    <!-- Modal Registrar Cliente -->
    <div class="modal fade" id="modalRegisterCustomer" role="dialog">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Registrar nuevo cliente</h4>
                </div>
                <div class="modal-body">
                    <br>
                    <form id="form-customer" name="form-customer" action="" method="post" class="form-horizontal cmxform">
                        <fieldset>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label" > Nombre </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" id="name" value="" class="form-control"  required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label"> Apellidos </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="lastName" value="" id="lastName" class="form-control"  required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label"><div id="labelIdentification"></div> DNI o RUC </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="identification"  id="identification" value="" class="form-control"  required />
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label"> Telefono 1 </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone1"  id="phone1" value="" class="form-control"  required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label"> Telefono 2 </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone2"  id="phone2" value="" class="form-control"   />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label"> Direccion </label>
                                            <div class="col-sm-9">
                                                <input  name="address" id="address" value="" class="form-control"   />
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
                                                <input type="text" name="email" value="" id="email" class="form-control"   />
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
                                                <input type="text" name="city" value="" id="city" class="form-control"  required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label"> Fec. Nac </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="birthday"    value="" id="birthday" class="form-control datepicker-bootstrap"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">

                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="saveCustomer" onclick="saveCustomer()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!--End Modal -->
@stop
@section('scripts')

    <script>

        var datatableEmergencyContacts;

        var jQueryValidator;
        var datatableEmergencyContacts;
        var emergencyContacts;
        var phonesDeleted = [];

        var elementRow = {              // Object that is inserted on new rows
            name: "<input class='form-control name' type='text'></ input>",
            phone : "<input class='form-control phone' type='text' value='M-'></ input>" +
                "<input class='form-control' type='hidden' value='-1'></ input>",
            dni: "<input class='form-control dni' type='text'></ input>",
            deleteOption :  "<div class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-trash'></i> Quitar</div>"
        };

        $('input.datepicker-bootstrap').datepicker({
            language: "es",
            orientation: "top"
        });

        $('#form-customer').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });

        function validar(){
            jQueryValidator = $("#form-vehicle").validate({
                rules: {
                    placa: {
                        required: true,
                        maxlength: 7
                    },
                    sn: {
                        required: true,
                        maxlength: 45
                    },
                    shortNumber: {
                        required: true,
                        minlength: 1,
                        maxlength: 12
                    },
                    motorNumber: {
                        minlength: 2,
                        maxlength: 25
                    },
                    year: {
                        number: true,
                        maxlength:4
                    },
                    brandCar: {
                        maxlength: 45
                    },
                    chasisSerie: {
                        maxlength: 122
                    },
                    registerDate: {
                        required: true
                    },
                    comment:{
                        maxlength:125
                    },
                    classCar:{
                        maxlength:125
                    },
                    internalNumber:{
                        required:true,
                        maxlength:65
                    },
                    telMov:{
                        maxlength: 32
                    },
                    telCla:{
                        maxlength: 32
                    },
                    telEmergency:{
                        required: true,
                        maxlength:150
                    },
                    sim:{
                        maxlength:9
                    },
                    gpsId:{
                        maxlength: 16
                    },
                    mg:{
                        maxlength:9
                    },
                    mandated:{
                        maxlength:125
                    },
                    personTelEmergency:{
                        required:true,
                        maxlength: 45
                    },
                    brandDevice:{
                        maxlength:45
                    },
                    notInformationName:{
                        maxlength:145
                    },
                    parkingplace:{

                        maxlength:205
                    },
                    customerId:{
                        required:true
                    }
                },
                messages: {
                    placa:{
                        required: "Por favor ingrese la placa",
                        maxlength: 'Ingrese una placa válida'
                    },
                    sn:{
                        required: "Por favor ingrese el sn",
                        maxlength:  jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    shortNumber: {
                        required: "Por favor ingrese el Número Corto",
                        minlength: jQuery.validator
                                .format("Ingreso debe ser como mínimo {0} caracteres"),
                        maxlength: jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    motorNumber: {
                        minlength: jQuery.validator
                                .format("Ingreso debe ser como mínimo {0} caracteres"),
                        maxlength: jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    year: {
                        number: "Por favor Ingrese un Año",
                        maxlength: jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    brandCar: {
                        maxlength: jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    chasisSerie: {
                        maxlength: jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    registerDate: {
                        required: "Por favor Ingrese una Fecha"
                    },
                    comment:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    classCar:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    internalNumber:{
                        required: "Debe ingresar numero Interno",
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    telMov:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    telCla:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    telEmergency:{
                        required: "Debe Ingresar Teléfono Emergencia",
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    sim:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    gpsId:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    mg:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    mandated:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    personTelEmergency:{
                        required: "Ingresar Persona encargada de Emergencia",
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    brandDevice:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    notInformationName:{
                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    parkingplace:{

                        maxlength:jQuery.validator
                                .format("Ingreso debe ser como máximo {0} caracteres")
                    },
                    customerId:{
                        required:"Por favor Elija un cliente"
                    }

                }
            });
        }
        var customerId = "{{$vehicleList['customerId']}}";
        $(document).ready(function(){
            $("#registerDate").datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            callAllCustomer();

            datatableEmergencyContacts = $('#datatableEmergencyContacts').DataTable({
                "dom": 't'
            });

            if("{{$data['mode']}}" == "create"){
                addEmergencyContact();
            } else {
                loadEmergencyContacts();
            }

            var status = "{{$vehicleList['status']}}";
            $("#status").val(status).trigger('change');
            validar();              // Inicializar variable jQueryValidator con reglas
            validarCustomer();

        });


        /* ****************************************************************************** */
        // Function for add one EmergencyContact row on the datatable
        /* ****************************************************************************** */

        function addEmergencyContact(){
            datatableEmergencyContacts.row.add([
                elementRow.name,
                elementRow.phone,
                elementRow.dni,
                elementRow.deleteOption
            ]).draw();
        }

        /* ****************************************************************************** */
        // Function for Delete rows from the EmergencyContacts table
        /* ****************************************************************************** */

        $('#datatableEmergencyContacts tbody').on('click',"div",function(e) {
            var selected = $(this);             // Get element selected
            var tr = selected.closest('tr');    // Get <tr> Parent
            var phoneId = tr.find("input[type='hidden']").val();
            phoneId = parseInt(phoneId);
            console.log(phoneId);
            if(phoneId != -1) {                     // Only If it is and old record
                phonesDeleted.push(phoneId);
            }

            datatableEmergencyContacts
                .row($(this).parents('tr'))
                .remove()
                .draw();

        });

        $('#form-vehicle').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });
        function changeIdentification(){
            if($("#type").val()=="1" || $("#type").val()==""){
                $("#labelIdentification").text("Dni");
            }
            else $("#labelIdentification").text("Ruc");
        }
        function validarCustomer(){
            jQueryValidatorCustomer = $("#form-customer").validate({
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
                    email: {
                        required: false,
                        email: true,
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
                    email: "Por favor ingrese un correo electrónico válido",
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
        function callAllCustomer(){

            var url = "{{ URL::action('CustomerController@getFilterAllCustomer')}}";

            $.ajax({
                url : url,
                type : 'get',

                dataType : 'json',

                beforeSend:function(){
                    $("#saveVehicle").prop('disabled', true);
                    $('.LoadingOverlayApi').trigger('loading-overlay:show');
                },

                success : function(data) {
                    $('#customerId').empty(); // clear the current elements in select box
                    $('#customerId').append($('<option></option>').attr('value', "").text("Seleccione"));
                    for (row in data) {
                        $('#customerId').append($('<option></option>').attr('value', data[row].customerId).text(data[row].name+" "+data[row].lastName+" "+data[row].identification));
                    }
                    $('.LoadingOverlayApi').trigger('loading-overlay:hide');
                },

                error : function(xhr, status) {

                },
                complete : function(xhr, status) {
                    $("#customerId").val(customerId).trigger('change');
                }

            });


        };
        function saveCustomer(){
            // validar formulario

            if($('#form-customer').valid()){
                var customerId=0;
                var mode="create";
                if(mode=="create"){
                    customerId=0;
                }
                var url = ("{{ URL::action('CustomerController@sendDataCustomer',['create','customerId']) }}").replace('customerId',customerId);

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

                    beforeSend:function(){
                        $("#saveVehicle").prop('disabled', true);
                        $("#saveCustomer").prop('disabled', true);
                        $('.LoadingOverlayApi').trigger('loading-overlay:show');
                    },

                    // código a ejecutar si la petición es satisfactoria;
                    // la respuesta es pasada como argumento a la función
                    success : function(data) {
                        $('.LoadingOverlayApi').trigger('loading-overlay:show');
                        callAllCustomer();
                        swal({
                            title: "Cliente registrado!",
                            text: "Presione el boton para continuar con el vehículo",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },function(){

                            var id=data;
                            console.log(id);
                            $("#modalRegisterCustomer").modal('hide');
                            $("#customerId").val(id).change();

                        });

                    },

                    // código a ejecutar si la petición falla;
                    // son pasados como argumentos a la función
                    // el objeto de la petición en crudo y código de estatus de la petición
                    error : function(xhr, status) {

                    },
                    complete : function(xhr, status) {

                    }

                });

            }
        };
        function saveVehicle(){
            saveEmergencyContacts();
            // validar formulario

            if($('#form-vehicle').valid()){
                var vehicleId=$('#vehicleId').val();
                var mode="{{$data['mode']}}";
                if(mode=="create"){
                    customerId=0;
                }
                var url = ("{{ URL::action('VehicleController@sendDataVehicle',[$data['mode'],'vehicleId'])}}").replace('vehicleId',vehicleId);

                $.ajax({
                    // la URL para la petición
                    url : url,

                    // la información a enviar
                    // (también es posible utilizar una cadena de datos)
                    data : {
                        formData: readFormValues(document.forms['form-vehicle']),
                        emergencyContacts: emergencyContacts,
                        phonesDeleted : phonesDeleted
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
                            window.location="{{ URL::action('VehicleController@index') }}";
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
                            window.location="{{URL::action('VehicleController@index')}}";
                        });
                    },
                    complete : function(xhr, status) {
                        $("#saveVehicleId").removeAttr("disabled");
                    }

                });

            }
        };

        /* ****************************************************************************** */
        // Function for saving the Emergency contact information iterating on each row.
        /* ****************************************************************************** */

        function saveEmergencyContacts(){
            emergencyContacts = [];     // Reset detailPackage

            $("#datatableEmergencyContacts tbody tr").each(function(i, row){    // For each row in tbody
                var jRow = $(row);
                var phoneId = jRow.find("input[type='hidden']").val();
                var name = jRow.find("input.name[type='text']").val();
                var phone = jRow.find("input.phone[type='text']").val();
                var dni = jRow.find("input.dni[type='text']").val();

                var newEmergencyContact = {
                    phoneId : phoneId,
                    name : name,
                    phone : phone,
                    dni : dni
                };

                emergencyContacts.push(newEmergencyContact);
            });

        }

        /* ****************************************************************************** */
        // Function for Load and List the Emergency contacts for the actual vehicle
        /* ****************************************************************************** */

        function loadEmergencyContacts(){
            $.ajax({
                url : "{{ URL::action('VehicleController@getEmergencyContacts',[$vehicleList['vehicleId']]) }}",
                type : 'post',
                dataType : 'json',
                success : function(data) {

                    for (var i in data){
                        if(data.hasOwnProperty(i)){

                            datatableEmergencyContacts.row.add([
                                "<input class='form-control name' type='text' value='" + data[i]['name'] + "'></ input>",
                                "<input class='form-control phone' type='text' value='" + data[i]['phone'] + "'></ input>"
                                    + "<input class='form-control' type='hidden' value='" + data[i]['phoneId'] + "'></ input>",
                                    "<input class='form-control dni' type='text' value='" + data[i]['dni'] + "'></ input>",
                                elementRow.deleteOption
                            ]).draw();

                        }
                    }

                },
                error : function(xhr, status) {

                },
                complete : function(xhr, status) {
                }
            });
        }

    </script>
@stop