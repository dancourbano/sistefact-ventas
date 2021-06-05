@extends('layouts.master')
@section('title')
    Vehículos
@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Vehiculos</h3>
        </div>
        <div class="panel-footer">
            <div class="btn-toolbar" role="toolbar">
                <div class="row pull-right">
                    <br>
                    <div class="col-sm-6">
                        <a class="btn btn-success" href="{{ URL::action('VehicleController@showHistory') }}" >Historial Retirados </a>


                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-success" href="{{ URL::action('VehicleController@showVehicle',['create',0]) }}" >Agregar Vehiculo </a>

                        
                    </div>
                </div>
            </div>
        </div>
            <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-vehicle">
                <thead>
                <tr>

                    <th>Codigo</th>
                    <th>Empresa</th>
                    <th>Nº Movil</th>
                    <th>Placa</th>
                    <th>Sn</th>
                    <th>Sim</th>
                    <th>Marca Disp</th>
                    <th>id</th>
                    <th>Estado</th>
                    <th>Fecha Ingreso</th>
                    <th>Propietario</th>
                    <th>Encargado</th>
                    <th>Opciones</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($vehicleBE as $row)
                    <tr>

                        <td>{{ $row->shortNumber }}</div></td>
                        <td>{{ $row->company }}</td>
                        <td>{{ $row->internalNumber }}</td>
                        <td>{{ $row->placa }}</td>
                        <td>{{ $row->sn }}</td>
                        <td>{{ $row->sim }}</td>
                        <td>{{ $row->brandDevice}}</td>
                        <td>{{ $row->gpsId }}</td>
                        <td>@if(($row->status)==2) <div class="label label-success">Prest. @elseif (($row->status)==0)<div class="label label-danger">Retirado @else Activo @endif</div></td>
                        <td>{{ $row->registerDate}}</td>
                        <td>{{ $row->customerName  }} {{$row->customerLastName}}</td>
                        <td>{{ $row->mandated }}</td>
                        <td>
                            <div class="btn-group btn-group-justified">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCustomer" title="Propietario, encargado" onclick="viewCustomer({{ $row->vehicleId }})")><i class="fa fa-user"></i></button>
                                <button class="btn btn-success btn-sm" title="Registro de Mantenimiento" onclick="maintenanceVehicle({{ $row->vehicleId }},'{{ $row->placa }}')"><i class="fa fa-wrench"></i></button>
                                <button class="btn btn-info btn-sm" title="Detalles de Mantenimiento" onclick="detailMaintenanceVehicle({{ $row->vehicleId }},'{{ $row->placa }}')"><i class="fa fa-check"></i></button>
                                <button class="btn btn-warning btn-sm" title="Editar vehículo" onclick="editVehicle( {{ $row->vehicleId }} )"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-sm" title="Eliminar vehículo" onclick="deleteVehicle( {{ $row->vehicleId }} )"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <input type="hidden" id="send" name="toDelete">

        </div>
    </div>


    <!-- Modal Maintenance-->
    <div class="modal fade" id="modalMaintenance" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    </br>
                        <div class="container-fluid">
                            <div  class="datatable">
                                <table id="dataTableMaintenance" class="table">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Detalle </th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </br>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success btn-sm" id="buttonAddMaintenance">Agregar Mantenimiento</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
    <!--End Modal -->

    <!-- Modal DetailMaintenance-->
    <div class="modal fade" id="modalDetailMaintenance" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modalDetailMaintenanceTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    </br>
                        <div class="container-fluid">
                            <div  class="datatable">
                                <table id="dataTableDetailMaintenance" class="table">
                                    <thead>
                                        <tr>
                                            <th>Última Modificación</th>
                                            <th>Pestillos</th>
                                            <th>B. Pánico</th>
                                            <th>Claxon</th>
                                            <th>B. On/Off</th>
                                            <th>Micrófono</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </br>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success btn-sm" id="buttonEditMaintenance">Editar reporte de Mantenimiento</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
    <!--End Modal -->

    <!-- Modal Ver datos de Cliente-->
    <div class="modal fade" id="modalCustomer" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detalles de Contactos</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="invoice">
                                    <header class="clearfix">
                                        <h5 class="modal-title">Información del Cliente</h5>
                                    </header>
                                    <div class="row">
                                        <div class="col-sm-9 col-sm-offset-1">
                                            <table class="table invoice-items text-dark">
                                                <tbody>
                                                <tr class="b-top-none">
                                                    <td id="cell-id" >Nombre:</td>
                                                    <td id="cell-desc" class="text-left"><span id="spanNombreCliente"></span></td>
                                                </tr>
                                                <tr>
                                                    <td id="cell-id">Telefono:</td>
                                                    <td id="cell-desc" class="text-left"><span id="spanTelefonoCliente"></span></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice">
                                    <header class="clearfix">
                                        <h5 class="modal-title">Información del Encargado</h5>
                                    </header>
                                    <div class="row">
                                        <div class="col-sm-9 col-sm-offset-1">
                                            <table class="table invoice-items text-dark">
                                                <tbody>
                                                    <tr class="b-top-none">
                                                        <td id="cell-id"  >Nombre:</td>
                                                        <td id="cell-desc" class="text-left"><span id="spanNombreEncargado"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="cell-id" >Telefono:</td>
                                                        <td id="cell-desc"class="text-left"><span id="spanTelefonoEncargado"></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="invoice">
                                    <header class="clearfix">
                                        <h5 class="modal-title">Información del Conductor</h5>
                                    </header>
                                    <div class="row">
                                        <div class="col-sm-9 col-sm-offset-1">
                                            <table class="table invoice-items text-dark">
                                                <tbody>
                                                <tr class="b-top-none">
                                                    <td id="cell-id">Nombre:</td>
                                                    <td id="cell-desc" class="text-left"><span id="spanNombreConductor"></span></td>
                                                </tr>
                                                <tr>
                                                    <td id="cell-id">Telefono:</td>
                                                    <td id="cell-desc" class="text-left"><span id="spanTelefonoConductor"></span></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice">
                                    <header class="clearfix">
                                        <h5 class="modal-title">Información en Caso de Emergencia</h5>
                                    </header>
                                    <div class="row">
                                        <div class="col-sm-9 col-sm-offset-1">
                                            <table class="table invoice-items text-dark" id="emergencyContactTable">
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="text-right mr-lg">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal -->
@stop

@section('scripts')
<script>
    var dataTableMaintenance;

    function opciones(maintenanceId){    // Function that returns a string for each table's row options
        url = ("{{ URL::action('MaintenanceController@edit',['maintenanceId']) }}").replace('maintenanceId',maintenanceId);
        return "<a class='btn btn-info btn-sm' href='"+url+"'><i class='fa fa-pencil'></i></a> <button class='btn btn-danger btn-sm' onclick='deleteMaintenance("+maintenanceId+")'><i class='fa fa-trash-o'></i></button>";
    }

    $(document).ready(function(){
        $('#datatable-vehicle>thead>tr>th:nth-child(1),#datatable-vehicle>tbody>tr>td:nth-child(1)')
                .css("width", "2%");
        $('#datatable-vehicle>thead>tr>th:nth-child(12),#datatable-vehicle>tbody>tr>td:nth-child(12)')
                .css("width", "12%");
        $('#datatable-vehicle').DataTable({
            pageLenght: 20
        });
        dataTableMaintenance = $('#dataTableMaintenance').DataTable({
            pageLenght: 20
        });

        dataTableDetailMaintenance = $('#dataTableDetailMaintenance').DataTable({
            "dom": 't'
        });
        $('#dataTableMaintenance>thead>tr>th:nth-child(2),#dataTableMaintenance>tbody>tr>td:nth-child(2)')
                .css("width", "52%");
        $('#dataTableMaintenance>thead>tr>th:nth-child(3),#dataTableMaintenance>tbody>tr>td:nth-child(3)')
                .css("width", "8%");
        $('#dataTableMaintenance>thead>tr>th:nth-child(4),#dataTableMaintenance>tbody>tr>td:nth-child(4)')
                .css("width", "12%");
    });

    function editVehicle(vehicleId){
        if(vehicleId == undefined){
            sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Vehículo", "warning");
            return false;
        }
        var url = ("{{ URL::action('VehicleController@showVehicle',['edit','vehicleId']) }}").replace('vehicleId',vehicleId);
        $(location).attr('href',url);
    }

    function deleteMaintenance(maintenanceId){
        swal({
                title: "Confirme eliminación",
                text: "Esta seguro de eliminar este mantenimiento?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "No, cancelar",
                closeOnConfirm: false,
                closeOnCancel: false },
            function(isConfirm){
                if (isConfirm) {
                    swal({
                            title: "Eliminado!",
                            text: "Mantenimiento eliminado con éxito.",
                            type: "success"},
                        function(isConfirm){
                            if(isConfirm){
                                var url = ("{{ URL::action('MaintenanceController@delete',['maintenanceId']) }}").replace('maintenanceId',maintenanceId);
                                $(location).attr('href',url);
                            }
                        }
                    );
                } else {
                    swal("Cancelado",
                        "Eliminación cancelada",
                        "error");
                } });
    }
    function showStatus(status){
        switch(status){
            case "0":  return '<label class="label label-danger">No atendido</label>'; break;
            case "1":  return '<label class="label label-success">Atendido</label>'; break;
        }
    }
    function maintenanceVehicle(vehicleId,placa){
        dataTableMaintenance.clear().draw();    // Reset the maintenance table

        $.ajax({
            url: ("{{ URL::action('MaintenanceController@getMaintenances',['vehicleId']) }}").replace('vehicleId',vehicleId),
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                for (row in data) {
                    var maintenanceData = data[row];
                    dataTableMaintenance.row.add([
                        maintenanceData['maintenanceDate'],
                        maintenanceData['detail'],
                        showStatus(maintenanceData['status']),
                        opciones(maintenanceData['maintenanceId'])
                    ]).draw();
                }

                $('#modalTitle').text(' Mantenimiento del vehículo ' + placa);// Add 'placa' in the modal title
                url = ("{{ URL::action('MaintenanceController@create',['vehicleId']) }}").replace('vehicleId',vehicleId);
                $('#buttonAddMaintenance').attr('href',url);
                $('#modalMaintenance').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseJSON.error.message);
            }
        });

    }

    function detailMaintenanceVehicle(vehicleId,placa){
        dataTableDetailMaintenance.clear().draw();    // Reset the detail maintenance table

        var url = ("{{ URL::action('DetailMaintenanceController@getDetailMaintenance',['vehicleId']) }}").replace('vehicleId',vehicleId);

        $.ajax({
            url: url,
            dataType: 'json',
            type: 'GET',
            success: function(data) {

                for (row in data) {
                    var detailmaintenanceData = data[row];
                    dataTableDetailMaintenance.row.add([
                        detailmaintenanceData['modifiedDate'],
                        detailmaintenanceData['latches'],
                        detailmaintenanceData['panic'],
                        detailmaintenanceData['claxon'],
                        detailmaintenanceData['onOff'],
                        detailmaintenanceData['microphone'],
                        detailmaintenanceData['detail']
                    ]).draw();
                }

                $('#modalDetailMaintenanceTitle').text(' Detalle de Mantenimiento del vehículo ' + placa);// Add 'placa' in the modal title

                var urlEdit = ("{{ URL::action('DetailMaintenanceController@edit',['detailmaintenanceId']) }}").replace('detailmaintenanceId',detailmaintenanceData['detailmaintenanceId']);
                
                $('#buttonEditMaintenance').attr('href',urlEdit);
                $('#modalDetailMaintenance').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseJSON.error.message);
            }
        });

    }

    function deleteVehicle(idVehicle){
        swal({
                    title: "Confirme eliminación",
                    text: "Esta seguro de eliminar este vehiculo?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "No, cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false },
                function(isConfirm){
                    if (isConfirm) {
                        swal({
                                    title: "Eliminado!",
                                    text: "Eliminacción realizada.",
                                    type: "success"},
                                function(isConfirm){
                                    if(isConfirm){
                                        var url = ("{{ URL::action('VehicleController@deleteVehicle',['idVehicle']) }}").replace('idVehicle',idVehicle);
                                        $(location).attr('href',url);
                                    }
                                }
                        );
                    } else {
                        swal("Cancelado",
                                "Eliminación cancelada",
                                "error");
                    } });
    }
    function viewCustomer(idVehicle){

        var url = ("{{ URL::action('VehicleController@showContact',['vehicleId']) }}").replace('vehicleId',idVehicle);

        $.ajax({
            url : url,
            type : 'get',
            dataType : 'json',

            success : function(data) {
                //limpiamos los datos anteriores
                $('#spanNombreCliente').text(" ");
                $('#spanTelefonoCliente').text(" ");

                $('#spanNombreConductor').text(" ");
                $('#spanTelefonoConductor').text(" ");

                $('#spanNombreEncargado').text(" ");
                $('#spanTelefonoEncargado').text(" ");

                $('#emergencyContactTable').empty();

                if(data!={}){
                    $('#spanNombreCliente').text(data['customer'][0].customerName+" "+data['customer'][0].customerLastName);
                    $('#spanTelefonoCliente').text(data['customer'][0].customerPhone1+" "+data['customer'][0].customerPhone2);
                    if(data['driver'].length!=0){
                        $('#spanNombreConductor').text(data['driver'][0].driverName+" "+data['driver'][0].driverLastName);
                        $('#spanTelefonoConductor').text(data['driver'][0].driverPhone);
                    }

                    for (var i=0 ; i < data['phones'].length ; i++ ){
                        var table = $('#emergencyContactTable');
                        var name =  data['phones'][i]['name'];;
                        var phone =  data['phones'][i]['phone'];
                        var dni = data['phones'][i]['dni'];
                        table.append("<tr><td id='cell-id'> Nombre: </td><td id='cell-desc'>" + name + "</td><td id='cell-id'>Teléfono:</td><td id='cell-desc'>" + phone + "</td><td id='cell-id'>Dni:</td><td id='cell-desc'>" + dni + "</td></tr>");

                    }

                    $('#spanNombreEncargado').text(data['vehicle'][0].mandated);
                    $('#spanTelefonoEncargado').text(data['vehicle'][0].mandatedMov+""+data['vehicle'][0].mandatedCla);

                }




            },
            error : function(xhr, status) {
            }
        });

        $("#invoiceCustomer").modal('show');
    }
</script>
@stop