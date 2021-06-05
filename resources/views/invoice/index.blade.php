@extends('layouts.master')
@section('title')
Facturacion

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Ultimas Facturas</h3>
        </div>
        <div class="panel-body">
            <br>
            <form id="form-filter-invoice" name="form-filter-invoice" action="" method="get" class="form-horizontal cmxform">
                <div class="form-group">
                    <label class="col-md-2 control-label">Fecha de Emision</label>
                    <div class="col-md-8">
                        <div class="input-daterange input-group" data-plugin-datepicker>
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                            <input type="text" class="form-control" name="startEmission" id="startEmission" value="2016-01-01">
                            <span class="input-group-addon">hasta</span>
                            <input type="text" class="form-control" name="endEmission" id="endEmission" value="<?php echo date("Y-m-d");?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Fecha de Pago</label>
                    <div class="col-md-8">
                        <div class="input-daterange input-group"  data-plugin-datepicker>
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                            <input type="text" class="form-control" name="startPayment" id="startPayment" value="2016-01-01">
                            <span class="input-group-addon">hasta</span>
                            <input type="text" class="form-control" name="endPayment" id="endPayment" value="<?php echo date("Y-m-d");?>">
                        </div>
                    </div>

                </div>
                <div class="form-group ">
                    <label  class="col-md-2 control-label" > Estado </label>
                    <div class="col-sm-4 ">
                        <select id="status" name="status" class="form-control select2">
                            <option value="" selected>Seleccione</option>
                            <option value="0">Pendiente</option>
                            <option value="1">Pagado</option>
                            <option value="2">Sin emitir</option>
                        </select>
                    </div>
                </div>
                <div class="form-group ">
                    <label  class="col-md-2 control-label" > Deuda </label>
                    <div class="col-sm-4 ">
                        <select id="debt" name="debt" class="form-control select2">
                            <option value="" selected>Seleccione</option>
                            <option value="0">Al Dia</option>
                            <option value="1">En Mora</option>
                        </select>
                    </div>
                </div>

                    <div class="text-right mr-lg">
                        <div class="col-sm-offset-6 col-sm-6">
                            <a class="btn btn-danger btn-sm" onclick="filterInvoice()" >Filtrar Factura</a>
                            <a class="btn btn-success btn-sm" href="{{ URL::action('InvoiceController@showInvoice',['create',0]) }}" >Nueva Factura</a>

                        </div>
                    </div>

            </form>

        </div>

    </div>
    <div class="panel-body ">
        <div class="row col-sm-12">

            <table class="table table-striped table-hover table-responsive datatable" id="datatable-invoice">
                <thead>
                <tr>

                    <th>Id</th>
                    <th>Fecha Emision</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Deuda</th>
                    <th>Forma de Pago</th>
                    <th>Placa</th>
                    <th>Cliente</th>
                    <th>DNI/RUC</th>

                    <th>Opciones</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($invoiceBE as $row)
                <tr>

                    <td>{{ $row->invoiceId }}</td>
                    <td>{{ $row->createdDate }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->total }}</td>
                    <td ><label>{{ $row->debt }}</label></td>
                    <td>{{ $row->methodpayment }}</td>
                    @if($row->placa!=null)
                    <td><label class="label label-dark">{{ $row->placa }}</label></td>
                    @else
                    <td>{{ '---' }}</td>
                    @endif
                    <td>{{ $row->customerName." ".$row->customerLastName }}</td>
                    <td>{{ $row->customerIdentification }}</td>

                    <td>
                        <div class="text-right mr-lg">
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalInvoice" onclick="viewInvoice({{$row->invoiceId}})"><i class="glyphicon glyphicon-eye-open"></i></button>
                            <button class="btn btn-success btn-sm" onclick="paymentInvoice({{$row->invoiceId}})"><i class="glyphicon glyphicon-usd"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="deleteInvoice({{$row->invoiceId}})"><i class="fa fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
<!-- Modal Ver Factura-->
<div class="modal fade" id="modalInvoice" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalle de factura</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="invoice">
                                <header class="clearfix">
                                    <div class="row">
                                        <div class="col-sm-6 mt-md">
                                            <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Factura</h2>
                                            <h4 class="h4 m-none text-dark text-weight-bold">#<span id="spanInvoiceId"></span></h4>
                                        </div>
                                        <div class="col-sm-4 text-right mt-md mb-md">
                                            <address class="ib mr-xlg">
                                                GPS JNISI
                                                <br/>
                                                John F. Kennedy #472, Trujillo ,Perú
                                                <br/>
                                                Telefono: (044) 692727
                                                <br/>
                                                gps-jnisi@hotmail.com
                                            </address>

                                        </div>
                                        <div class="col-sm-2">
                                            <div class="ib">
                                                <img src="{{ url('public') }}/assets/images/gpsjnisi.png" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                <div class="bill-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="bill-to">
                                                <p class="h5 mb-xs text-dark text-weight-semibold">Para:</p>
                                                <address>
                                                    Sr(a) :<span id="spanCustomer"></span>
                                                    <br/>
                                                    <span id="spanAddress"></span>
                                                    <br/>
                                                    Telefono(s) :<span id="spanPhone"></span>
                                                    <br/>
                                                    <span id="spanEmail"></span>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bill-data text-right">
                                                <br>
                                                <p class="mb-none">
                                                    <span  class="text-dark">Fecha de Emision :</span>
                                                    <span id="spanCreatedDate" ></span>
                                                </p>
                                                <p class="mb-none">
                                                    <span class="text-dark">Fecha de Vencimiento :</span>
                                                    <span id="spanDatePayMax" ></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table invoice-items" id="dataTableInvoiceDetail">
                                        <thead>
                                        <tr class="h4 text-dark">
                                            <th id="cell-id"     class="text-weight-semibold">#</th>
                                            <th id="cell-item"   class="text-weight-semibold">Item</th>
                                            <th id="cell-price"  class="text-center text-weight-semibold">Precio</th>
                                            <th id="cell-price"    class="text-center text-weight-semibold">Cantidad</th>
                                            <th id="cell-qty"    class="text-center text-weight-semibold">Vehiculo</th>
                                            <th id="cell-total"  class="text-center text-weight-semibold">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="invoice-summary">
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-8">
                                            <table class="table h5 text-dark">
                                                <tbody>
                                                <tr class="b-top-none">
                                                    <td colspan="2">Subtotal (S/.)</td>
                                                    <td class="text-left"><span id="spanSubTotal"></span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Descuento (S/.)</td>
                                                    <td class="text-left"><span id="spanDiscount"></span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">IGV 18% (S/.)</td>
                                                    <td class="text-left"><span id="spanTax"></span></td>
                                                </tr>
                                                <tr class="h4">
                                                    <td colspan="2">Total a Pagar (S/.)</td>
                                                    <td class="text-left"><span id="spanTotal"></span></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </section>

                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right mr-lg">
                    <a onclick="printInvoice()" class="btn btn-info ml-sm"><i class="fa fa-print"></i> Imprimir</a>
                    <a onclick="excelInvoice()"  class="btn btn-info"><i class="fa fa-file-excel-o"></i> Exportar Excel</a>
                    <a onclick="pdfInvoice()" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Exportar PDF</a>
                    <a onclick="emailInvoice()" class="btn btn-info"><i class="fa fa-envelope-o"></i> Enviar Correo</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Modal -->


<!-- Modal Payments-->
<div class="modal fade" id="modalPayments" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modalTitle"></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div  class="datatable">
                                    <table id="dataTablePayments" class="table">
                                        <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Cantidad </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right mr-lg">
                    <a class="btn btn-success btn-sm" id="buttonAddPayment">Agregar Pago</a>
                    <button class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Modal -->
@endsection

@section('scripts')
    <script>
        var invoiceId=0;
        var idCustomer=0;

        var dataTableInvoice;
        $(document).ready(function(){
            dataTableInvoice=$('#datatable-invoice').DataTable({
                "rowCallback": function(row, data, index) {
                    var cellValue = data[4];
                    if (cellValue=="<label>0.00</label>") {
                        $("td:eq(4) label",row).addClass(" label label-success");
                    }else{
                        $("td:eq(4) label",row).addClass(" label label-danger");

                    }
                    var cellValue = data[6];
                    if (cellValue=="<label>null</label>") {
                        $("td:eq(6)",row).html('---');

                    }else{
                        $("td:eq(6) label",row).addClass(" label label-dark");
                    }
                }
            });
            dataTablePayments = $('#dataTablePayments').DataTable();
            loadState();
            loadMethodPayment();
            $('#datatable-invoice>thead>tr>th:nth-child(1),#datatable-invoice>tbody>tr>td:nth-child(1)')
                .css("width", "8%");
        });



        $('.input-daterange input').datepicker({
            orientation: "auto"
        });

        /* Funcion que muestra el estado de una factura*/

        function loadState(){
            $('#datatable-invoice tr').each(function() {
                $(this).find("td").eq(2).html(showEstado($(this).find("td").eq(2).html()));
            });
        }

        function opciones(paymentId){    // Function that returns a string for each table's row options
            urlEdit = ("{{ URL::action('PaymentController@edit',['paymentId']) }}").replace('paymentId',paymentId);
            return "<a class='btn btn-info btn-sm' href='"+urlEdit+"'><i class='fa fa-pencil'></i></a> <button class='btn btn-danger btn-sm' onclick='deletePayment("+paymentId+")'><i class='fa fa-trash-o'></i></button>";

        }

        function showEstado(estado){
            switch(estado){
                case '0':  return 'Pendiente'; break;
                case '1':  return 'Pagado'; break;
                case '2':  return 'Sin Emitir'; break;
            }
        }

        /* Funcion que muestra el metodo de pago*/
        function loadMethodPayment(){
            $('#datatable-invoice tr').each(function() {
                $(this).find("td").eq(5).html(showMethodPayment($(this).find("td").eq(5).html()));
            });
        }

        function showMethodPayment(methodPayment){
            switch(methodPayment){
                case '0':  return 'Cuenta Bancaria'; break;
                case '1':  return 'Al Contado'; break;
            }
        }
        function viewInvoice(idInvoice){
            var dataTableInvoiceDetail = $('#dataTableInvoiceDetail').DataTable();
            dataTableInvoiceDetail.clear().draw();
            invoiceId = idInvoice;

            var url = ("{{ URL::action('InvoiceController@getInvoice',['invoiceId']) }}").replace('invoiceId',invoiceId);

            $.ajax({
                url : url,
                type : 'get',
                dataType : 'json',

                success : function(data) {

                    //console.log(data);
                    $('#spanCreatedDate').text(data['invoice'].createdDate);
                    $('#spanDatePayMax').text(data['invoice'].datePayMax);
                    $('#spanInvoiceId').text(data['invoice'].invoiceId);
                    $('#spanCustomer').text(data['invoice'].customerName+" "+data['invoice'].customerLastName+".      DNI/RUC: "+ data['invoice'].customerIdentification);
                    $('#spanAddress').text(data['invoice'].customerAddress+", "+data['invoice'].customerCity);
                    $('#spanPhone').text(data['invoice'].customerPhone1+", "+data['invoice'].customerPhone2);
                    $('#spanSubTotal').text(data['invoice'].subtotal);
                    $('#spanDiscount').text(data['invoice'].disccountValue);
                    $('#spanTax').text(data['invoice'].tax);
                    $('#spanTotal').text(data['invoice'].total);
                    idCustomer=data['invoice'].customerId;
                    var i=1;
                     for (row in data['invoiceDetail']){
                         dataTableInvoiceDetail.row.add([
                             i,
                             data['invoiceDetail'][row].description,
                             data['invoiceDetail'][row].price,
                             data['invoiceDetail'][row].quantity,
                             data['invoiceDetail'][row].vehicleId,
                             data['invoiceDetail'][row].quantity * data['invoiceDetail'][row].price

                         ]).draw();
                         i++;
                     }

                },
                error : function(xhr, status) {
                }
            });

            $("#invoiceModal").modal('show');
        }

        function paymentInvoice(invoiceId){
            dataTablePayments.clear().draw();    // Reset the payments table

            $.ajax({
                url: ("{{ URL::action('PaymentController@getPayments',['invoiceId']) }}").replace('invoiceId',invoiceId),
                dataType: 'json',
                type: 'GET',
                success: function(data) {
                    for (row in data) {
                        var paymentData = data[row];
                        dataTablePayments.row.add([
                            paymentData['createdDate'],
                            paymentData['quantity'],
                            opciones(paymentData['paymentId'])
                        ]).draw();
                    }

                    $('#modalTitle').text(' Pagos de la factura ' + invoiceId);
                    $('#buttonAddPayment').attr('href',("{{ URL::action('PaymentController@create',['invoiceId']) }}").replace('invoiceId',invoiceId));
                    $('#modalPayments').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseJSON.error.message);
                }
            });

        }

        function printInvoice(){

            var url = ("{{ URL::action('InvoiceController@printInvoice',['invoiceId']) }}").replace('invoiceId',invoiceId);

            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }

        function pdfInvoice(){

            var url = ("{{ URL::action('InvoiceController@pdfInvoice',['invoiceId']) }}").replace('invoiceId',invoiceId);

            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }
        function excelInvoice(){

            var url = ("{{ URL::action('InvoiceController@excelInvoice',['invoiceId']) }}").replace('invoiceId',invoiceId);

            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }
        function emailInvoice(){

            var email='';

            var url = ("{{ URL::action('CustomerController@getCustomer',['customerId']) }}").replace('customerId',idCustomer);
            $.ajax({
                url : url,

                type : 'get',

                dataType : 'json',

                beforeSend:function(){
                    $("#idEnviarEmail").prop('disabled', true);
                },

                success : function(data) {
                    //console.log(data);
                    email=data.email;
                },

                error : function(xhr, status) {

                },
                complete : function(xhr, status) {
                    $("#idEnviarEmail").removeAttr('disabled');
                    //console.log("email:"+email);
                    if(email==""){
                        new PNotify({
                            title: 'Usuario no tiene E-mail',
                            text: 'No se puede realizar la operacion porque usuario no tiene email, registre su email y envie la factura desde el panel principal de facturacion',
                            type: 'warning'
                        });
                    }else{
                        swal({
                                title: "Se enviara la factura al siguiente E-mail:",
                                text: email,
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Si, enviar",
                                cancelButtonText: "No, cancelar",
                                closeOnConfirm: false,
                                closeOnCancel: false },
                            function(isConfirm){
                                if (isConfirm) {
                                    swal({
                                            title: "Enviando Factura!",
                                            text: "Redireccionando a la vista de envío.",
                                            type: "success"},
                                        function(isConfirm){
                                            if(isConfirm){

                                                var url = ("{{ URL::action('InvoiceController@emailInvoice',['invoiceId','customerId']) }}").replace('invoiceId',invoiceId).replace('customerId',idCustomer);

                                                var ventanaPrint = window.open(url, '_blank');
                                                ventanaPrint.focus();
                                            }
                                        }
                                    );
                                } else {
                                    swal("Cancelado",
                                        "Envio cancelado",
                                        "error");
                                } }
                        );
                    }

                }
            });

        }
        function filterInvoice(){
            var url = "{{ URL::action('InvoiceController@filterInvoice')}}";

            $.ajax({
                url : url,
                type : 'get',
                data: readFormValues(document.forms['form-filter-invoice']),
                dataType : 'json',

                success : function(data) {

                    console.log(data);
                    dataTableInvoice.clear().draw();
                    var i=0;
                    for(i in data){
                        dataTableInvoice.row.add( [
                            data[i].invoiceId,
                            data[i].createdDate,
                            data[i].status,
                            data[i].total,
                            "<label>"+data[i].debt+"</label>",
                            data[i].methodpayment,
                            "<label>"+data[i].placa+"</label>",
                            data[i].customerName+" "+data[i].customerLastName,
                            data[i].customerIdentification,
                            "<button onclick='viewInvoice("+data[i].invoiceId+")' class='btn btn-info btn-sm' data-toggle='modal' data-target='#modalInvoice'><i class='glyphicon glyphicon-eye-open'></i></button>"+
                            "<button class='btn btn-success btn-sm' onclick='paymentInvoice("+data[i].invoiceId+")'><i class='glyphicon glyphicon-usd'></i></button>"+
                            "<button class='btn btn-danger btn-sm' onclick='deleteInvoice("+data[i].invoiceId+")'><i class='fa fa-trash'></i></button>"
                        ] );
                    }

                    dataTableInvoice.draw();
                    loadState();
                    loadMethodPayment();
                },
                error : function(xhr, status) {
                }
            });

        }

        function deletePayment(paymentId){
            swal({
                    title: "Confirme eliminación",
                    text: "Esta seguro de eliminar este pago?",
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
                                text: "Pago eliminado con éxito.",
                                type: "success"},
                            function(isConfirm){
                                if(isConfirm){
                                    var url = ("{{ URL::action('PaymentController@delete',['paymentId']) }}").replace('paymentId',paymentId);
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

        function deleteInvoice(invoiceId){

            var url = ("{{ URL::action('PaymentController@existPayment',['invoiceId']) }}").replace('invoiceId',invoiceId);
            $.ajax({
                url : url,
                type : 'get',
                dataType : 'json',

                success : function(data) {


                    if(data['count']==0){
                        swal({
                                title: "Confirme eliminación",
                                text: "Esta seguro que desea eliminar esta factura?",
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
                                            text: "Pago eliminado con éxito.",
                                            type: "success"},
                                        function(isConfirm){
                                            if(isConfirm){
                                                var url = ("{{ URL::action('InvoiceController@deleteInvoice',['invoiceId']) }}").replace('invoiceId',invoiceId);
                                                $(location).attr('href',url);
                                            }
                                        }
                                    );
                                } else {
                                    swal("Cancelado",
                                        "Eliminación cancelada",
                                        "error");
                                } });
                    }else{
                        new PNotify({
                            title: 'Hay pagos registrados',
                            text: 'Debe eliminar los pagos referentes a la factura seleccionada para poder eliminar la factura',
                            type: 'error'
                        });
                    }
                },
                error : function(xhr, status) {
                }
            });


        }
    </script>
@stop