@extends('layouts.master')
@section('title')
Pagos
@stop
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Pagos</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="datatablePayments">
            <thead>
            <tr>
                <th>id de Pago</th>
                <th>N° Factura</th>
                <th>Fecha de pago</th>
                <th>Fecha de vencimiento</th>
                <th>Método de pago</th>
                <th>Cantidad pagada</th>

                <th>Opciones</th>
            </tr>
            </thead>

            <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->paymentId }}</td>
                <td>{{ $payment->invoiceId }}</td>
                <td>{{ $payment->createdDate }}</td>
                <td>{{ $payment->datePayMax }}</td>
                <td>{{ $payment->paymethod }}</td>
                <td>{{ $payment->quantity }}</td>

                <td>
                    <a class="btn btn-info btn-sm" href="{{ url('payment/edit')}}/{{$payment->paymentId}}"><i class="fa fa-pencil"></i></a>
                    <button class="btn btn-danger btn-sm" onclick="deletePayment({{$payment->paymentId}})"><i class="fa fa-trash-o"></i></button>
                </td>

            </tr>
            @endforeach

            </tbody>
        </table>

    </div>
</div>


@endsection

@section('scripts')
<script>
    (function($) {

        'use strict';

        var datatableInit = function() {
            $('#datatablePayments').dataTable();
        };

        $(function() {
            datatableInit();
        });

        $('#datatablePayments tr').each(function() {
            $(this).find("td").eq(4).html(showMethodPayment($(this).find("td").eq(4).html()));
        });


    }).apply(this, [jQuery]);

    function showMethodPayment(methodPayment){
        switch(methodPayment){
            case '1':  return 'Efectivo'; break;
            case '0':  return 'Depósito bancario'; break;
        }
    }

    function editPayment(paymentId){
        if(paymentId == undefined){
            sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Pago", "warning");
            return false;
        }
        var url = ("{{ URL::action('PaymentController@edit',['paymentId']) }}").replace('paymentId',paymentId);
        $(location).attr('href',url);
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
                                var url = ("{{ URL::action('PaymentController@delete',['paymentId']) }}").replace('paymentId',paymentId) ;
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
</script>
@stop