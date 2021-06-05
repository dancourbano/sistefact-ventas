@extends('layouts.master')
@section('title')
Clientes

@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Clientes</h3>
    </div>
    <div class="panel-footer">
        <div class="btn-toolbar" role="toolbar">
            <div class="row pull-right">
                <br>
                
            <div class="col-sm-12"><a class="btn btn-success" href="{{ url('monitor/customer/showCustomer/create/0') }}" >Agregar Cliente</a>

          
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-customer">
                <thead>
                    <tr>

                        <th id="cell-id">Id</th>
                        <th>nombre</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Email</th>
                        <th>Telefono1</th>
                        <th>Vehículos</th>

                        <th>Fec. Nacimiento</th>

                        <th> Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($customerBE as $row)
                        <tr>

                            <td>{{ $row->customerId }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->lastName }}</td>
                            <td>{{ $row->identification }}</td>
                            <td>{{ $row->address }}</td>
                            <td>{{ $row->city }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone1 }}</td>
                            <td class="text-center"><button id="viewVehicles" onclick="viewVehicles({{$row->customerId}})" class="btn btn-success">{{ $row->vehiculos }}</button></td>
                            <td>{{ $row->birthday }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-info btn-sm" onclick="editCustomer( {{ $row->customerId }} )"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-warning btn-sm" onclick="deleteCustomer( {{ $row->customerId }} )"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


                <input type="hidden" id="send" name="toDelete">

        </div>
	</div>

    <!-- Modal Ver vehiculos de Cliente-->
    <div class="modal fade" id="modalVehicles" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Vehiculos de Cliente</h4>
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
                                        <h5 class="modal-title">Vehiculos</h5>
                                    </header>
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div  class="datatable">
                                                <table id="datatable-vehicle" class="table">
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
                                                        <th>Encargado</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
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
        var datatableVehicle;
        $(document).ready(function(){
            $('#datatable-customer').DataTable();
            datatableVehicle=$('#datatable-vehicle').DataTable();
            $('#datatable-customer>thead>tr>th:nth-child(1),#datatable-customer>tbody>tr>td:nth-child(1)')
                .css("width", "12%");
            $('#datatable-vehicle>thead>tr>th:nth-child(1),#datatable-vehicle>tbody>tr>td:nth-child(1)')
                .css("width", "12%");
        });

        function showMaritalStatus(maritalStatus){
            switch(maritalStatus){
                case 'SO':  return 'Soltero'; break;
                case 'CA':  return 'Casado'; break;
                case 'VI':  return 'Viudo'; break;
                case 'DI':  return 'Divorciado'; break;
            }

        }

        function editCustomer(id){
            if(id == 0 || id == undefined){
                sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Pedido", "warning");
                return false;
            }

            var url = ("{{ URL::action('CustomerController@showCustomer',['action','customerId']) }}").replace('customerId',id).replace("action","edit");
                        $(location).attr('href',url);
        }
        $('#datatable-customer>thead>tr>th:nth-child(10),#datatable-customer>tbody>tr>td:nth-child(10)')
                .css("width", "10%");
        function deleteCustomer(idCustomer){
            swal({
                        title: "Confirme eliminación",
                        text: "Esta seguro de eliminar este cliente?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Si, eliminar",
                        cancelButtonText: "No, cancelar",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function(isConfirm){
                        if (isConfirm) {
                           var url =  ("{{ URL::action('CustomerController@deleteCustomer',['customerId']) }}").replace('customerId',idCustomer);
                            $.ajax({
                                url : url,

                                type : 'get',
                                dataType : 'json',
                                success : function(data) {
                                    swal({
                                        title: data.messageDetail,
                                        text: "Presione el boton para continuar!",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonText: "OK",
                                        closeOnConfirm: true
                                    },function(){
                                        window.location="{{URL::action('CustomerController@index')}}";
                                    });
                                },
                                error : function(xhr, status) {
                                    console.log(xhr);
                                    swal({
                                        title: xhr.statusText,
                                        text: "Presione el boton para continuar!",
                                        type: "error",
                                        showCancelButton: false,
                                        confirmButtonText: "OK",
                                        closeOnConfirm: true
                                    },function(){
                                        window.location="{{URL::action('CustomerController@index')}}";
                                    });
                                },
                                complete : function(xhr, status) {

                                }
                            });
                        } else {
                            swal("Cancelado",
                                    "Eliminación cancelada",
                                    "error");
                        } });
        }
        function viewVehicles(customerId){

            var url = ("{{ URL::action('CustomerController@showVehicles',['customerId']) }}").replace('customerId',customerId);

            $.ajax({
                url : url,
                type : 'get',
                dataType : 'json',

                success : function(data) {
                    //limpiamos los datos anteriores
                    $('#spanNombreCliente').text(" ");
                    $('#spanTelefonoCliente').text(" ");

                    console.log(data);

                    var phone1=data['customer']['phone1'];
                    var phone2=data['customer']['phone2'];
                    if(phone2==null){
                        phone2="";
                    }
                    if(phone1==null){
                        phone1="";
                    }

                    $('#spanNombreCliente').text(data['customer']['name']+" "+data['customer']['lastName']);
                    $('#spanTelefonoCliente').text(phone1+" "+phone2);

                    datatableVehicle.clear().draw();
                    var i=0;
                    for(i in data['vehicles']){
                            datatableVehicle.row.add( [
                                data['vehicles'][i].shortNumber,
                                data['vehicles'][i].company,
                                data['vehicles'][i].internalNumber,
                                data['vehicles'][i].placa,
                                data['vehicles'][i].sn,
                                data['vehicles'][i].sim,
                                data['vehicles'][i].brandDevice,
                                data['vehicles'][i].gpsId,
                                data['vehicles'][i].mandated
                            ] );

                        }
                    datatableVehicle.draw();


                },
                error : function(xhr, status) {
                }
            });

            $("#modalVehicles").modal('show');
        }
    </script>
@stop