@extends('layouts.master')
@section('title')
    Envío SMS - Actualizar
@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Envío SMS</h3>
        </div>
        <div class="panel-footer">
            <div class="btn-toolbar" role="toolbar">
                <div class="row pull-right">                    
                    <div class="col-sm-12">
                        <a class="btn btn-success" href="{{ URL::action('SmsSendController@showVehicle',['create',0]) }}" >Agregar SMS </a>
                        <!--a class="btn btn-success" href="{{ URL::action('SmsSendController@sendCommandSms') }}" >Enviar SMS </a-->
                        
                    </div>
                </div>
            </div>
        </div>
            <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-vehicle">
                <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Codigo</th>                    
                    <th>Comando/th>
                    <                  
                    <th>Opciones</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($vehicleOutdatedBE as $row)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $row->vehicleId }}</td>
                        <td>{{ $row->phone }}</td>
                                               
                         
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCustomer" title="Propietario, encargado" onclick="viewCustomer({{ $row->vehicleId }})")><i class="fa fa-user"></i></button>                              
                                
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
       
        
    });
    $('#selectAll').click(function(e){
    var table= $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
    });
    function editVehicle(vehicleId){
        if(vehicleId == undefined){
            sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Vehículo", "warning");
            return false;
        }
        var url = ("{{ URL::action('SmsSendController@showVehicle',['edit','vehicleId']) }}").replace('vehicleId',vehicleId);
        $(location).attr('href',url);
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
                                        var url = ("{{ URL::action('SmsSendController@deleteVehicle',['idVehicle']) }}").replace('idVehicle',idVehicle);
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
    function enviarTodoEventosSms(){
        $('#datatable-vehicle > tbody  > tr').each(function(i,row) {
            
             if ($(row).find('input:checked').length)
                {
                    console.log("check");
                }
        });
    }
</script>
@stop