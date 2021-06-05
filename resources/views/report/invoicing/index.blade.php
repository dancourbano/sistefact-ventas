@extends('layouts.master')
@section('title')
Reporte de Facturacion

@stop
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Reporte de Facturacion</h3>
    </div>
</div>


<div class="panel-body panel-featured-left panel-featured-info">
    <br>
    <form id="form-filter-invoicing" action="" method="get" class="form-horizontal">
        <div class="container-fluid">
            <div class="row">
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
                    <label  class="col-md-2 control-label"> Cliente </label>
                    <div class="col-sm-4">
                        <select data-plugin-selectTwo name="customerId" id="customerId" class="form-control select">
                            <option value="">Seleccione</option>
                            @foreach($customerList as $row)
                            <option value="{{$row->customerId}}">{{ $row->name }} {{ $row->lastName}}</option>
                            @endforeach
                        </select>
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
                <div class="form-group">
                    <div class="col-sm-offset-10">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a  class="btn btn-success" onClick="filterInvoicing()" >Filtrar Ventas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
</div>
</br>

<div class="row">
    <div class="col-md-12 col-lg-6 col-xl-6">
        <section class="panel panel-featured-left panel-featured-secondary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-secondary">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Items Vendidos</h4>
                            <div class="info">
                                <strong class="amount"><span></span><span id="spanTotalItems">0</span></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-6">
        <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-tertiary">
                            <i class="fa fa-cube"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Paquetes Vendidos</h4>
                            <div class="info">
                                <strong class="amount"><span id="spanTotalPackages">0</span></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>

<div class="panel-body panel-featured-left panel-featured-success">
    <div class="row col-sm-12">
        <table class="table table-striped table-hover table-responsive datatable" id="datatable-invoicing">
            <thead>
            <tr>
                <th>Fecha Emision</th>
                <th>Id Factura</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Forma de Pago</th>
                <th>Cliente</th>
                <th>DNI/RUC</th>

            </tr>
            </thead>

            <tbody>

            </tbody>
        </table>

    </div>
    <br>
    <div class="text-right mr-lg">
        <a class="btn btn-success btn-sm" onclick="printInvoicing()" ><i class="fa fa-print"></i> Imprimir</a>
        <a class="btn btn-success btn-sm" onclick="pdfInvoicing()" ><i class="fa fa-file-pdf-o"></i> Generar PDF</a>
        <a class="btn btn-success btn-sm" onclick="excelInvoicing()" ><i></i><i class="fa fa-file-excel-o"></i> Generar Excel</a>
    </div>

</div>


@endsection

@section('scripts')
<script>
    var datatableInvoicing;
    var filterInvoingState=false;
    $(document).ready(function(){
        datatableInvoicing=$('#datatable-invoicing').DataTable();
    });

    $('.input-daterange input').datepicker({
        orientation: "auto"
    });

    function filterInvoicing(){
        var url = ("{{ URL::action('ReportInvoicingController@filterInvoicing') }}");

        $.ajax({
            url : url,
            type : 'get',
            data: readFormValues(document.forms['form-filter-invoicing']),
            dataType : 'json',

            success : function(data) {

                //console.log(data);
                $('#spanTotalItems').text(data['invoicing'][0].quantityItems);
                $('#spanTotalPackages').text(data['invoicing'][0].quantitypackages);
                datatableInvoicing.clear().draw();

                for (row in data['detailinvoice']){
                    datatableInvoicing.row.add([
                        data['detailinvoice'][row].createdDate,
                        data['detailinvoice'][row].invoiceId,
                        data['detailinvoice'][row].description,
                        data['detailinvoice'][row].quantity,
                        data['detailinvoice'][row].price,
                        data['detailinvoice'][row].methodpayment,
                        data['detailinvoice'][row].customerName+""+data['detailinvoice'][row].customerLastName,
                        data['detailinvoice'][row].customerIdentification

                    ]).draw();
                }

                filterInvoingState=true;
            },
            error : function(xhr, status) {
            }
        });
    }

    function printInvoicing(){
        var startEmission=$("#startEmission").val();
        var endEmission=$("#endEmission").val();
        var customerId=$("#customerId option:selected").html();
        var status=$('#status option:selected').html();
        if(customerId=='Seleccione'){
            customerId='Todos';
        }
        if(status=='Seleccione'){
            status='Todos';
        }
        if(filterInvoingState==true){
            var url = ("{{ URL::action('ReportInvoicingController@printInvoicing',['startEmission','endEmission','customerId','status']) }}").replace('startEmission',startEmission).replace('endEmission',endEmission).replace('customerId',customerId).replace('status',status);
            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }else{
            new PNotify({
                title: 'No se realizaron consultas',
                text: 'Debe realizar una consulta para imprimir los datos.',
                type: 'error'
            });
        }


    }
    function pdfInvoicing(){
        var startEmission=$("#startEmission").val();
        var endEmission=$("#endEmission").val();
        var customerId=$("#customerId option:selected").html();
        var status=$('#status option:selected').html();
        if(customerId=='Seleccione'){
            customerId='Todos';
        }
        if(status=='Seleccione'){
            status='Todos';
        }
        if(filterInvoingState==true){
            var url = ("{{ URL::action('ReportInvoicingController@pdfInvoicing',['startEmission','endEmission','customerId','status']) }}").replace('startEmission',startEmission).replace('endEmission',endEmission).replace('customerId',customerId).replace('status',status);

            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }else{
            new PNotify({
                title: 'No se realizaron consultas',
                text: 'Debe realizar una consulta para imprimir los datos.',
                type: 'error'
            });
        }
    }
    function excelInvoicing(){
        var startEmission=$("#startEmission").val();
        var endEmission=$("#endEmission").val();
        var customerId=$("#customerId option:selected").html();
        var status=$('#status option:selected').html();
        if(customerId=='Seleccione'){
            customerId='Todos';
        }
        if(status=='Seleccione'){
            status='Todos';
        }
        if(filterInvoingState==true){
            var url = ("{{ URL::action('ReportInvoicingController@excelInvoicing',['startEmission','endEmission','customerId','status']) }}").replace('startEmission',startEmission).replace('endEmission',endEmission).replace('customerId',customerId).replace('status',status);

            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }else{
            new PNotify({
                title: 'No se realizaron consultas',
                text: 'Debe realizar una consulta para imprimir los datos.',
                type: 'error'
            });
        }
    }
</script>
@stop