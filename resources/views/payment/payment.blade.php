@extends('layouts.master')
@section('title')
Pago
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            Pagos -
            @if ($action == "create")
            Registrar nuevo pago
            @else
            Editar pago
            @endif
        </h3>
    </div>
    <div class="panel-body">
        <form id="form-payment" name="form-payment" action="" method="post" class="form-horizontal cmxform">
            <fieldset>
                <div class="container-fluid">
                    <div class="row col-sm-12">
                    	<div class="row col-sm-6">
                    		@if ($action == "edit")
	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Id de Pago </label>
	                                <div class="col-sm-7">
	                                    <input type="text" name="paymentId"  id="paymentId" value="{{ $dataPayment['paymentId'] }}" class="form-control" readonly="readonly" required />
	                                </div>
	                            </div>
	                        </div>
	                        @endif

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> N° Factura </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="invoiceId"  id="invoiceId" value="{{ $dataPayment['invoiceId'] }}" class="form-control" readonly="readonly" required />
                                    </div>
                                </div>
                            </div>

	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Cliente </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="paymentName"  id="paymentName" value="{{ $dataPayment['paymentName'] }}" class="form-control" readonly="readonly" required />
                                    </div>
	                            </div>
	                        </div>

	                        

	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Deuda actual </label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-icon">
                                            <span class="input-group-addon">
                                                <span class="icon">S/.</span>
                                            </span>
                                            <input type="text" name="debt"  id="debt" value="{{ $dataPayment['debt'] + $dataPayment['quantity'] }}" class="form-control" readonly="readonly" required />
                                        </div>
                                    </div>
	                            </div>
	                        </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> Cantidad a pagar </label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-icon">
                                            <span class="input-group-addon">
                                                <span class="icon">S/.</span>
                                            </span>
                                            <input type="text" name="quantity"  id="quantity" value="{{ $dataPayment['quantity'] }}" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> Deuda final </label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-icon">
                                            <span class="input-group-addon">
                                                <span class="icon">S/.</span>
                                            </span>
                                            <input type="text" name="newDebt"  id="newDebt" value="" class="form-control" readonly="readonly" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                    	</div>
                    	
                    	<div class="row col-sm-6">
                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> Fecha de pago </label>
                                    <div class="col-sm-7">
                                       <input type="text" id="paymentDate" class="form-control" name="paymentDate" value="<?php echo date("Y-m-d H:i:s");?>" readonly/>
                                    </div>
                                </div>
                            </div>

                    		<div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> Método </label>
                                    <div class="col-sm-7">
                                       <select class='form-control input-sm mb-md' name="paymethod" id="paymethod">
                                            <option value=''>Seleccione</option>
                                            <option value='1'>Efectivo</option>
                                            <option value='0'>Depósito bancario</option>
                                       </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> Observación </label>
                                    <div class="col-sm-7">
                                        <textarea name="observation" id="observation" class="form-control" rows="3"><?php echo $dataPayment['observation']; ?></textarea>
                                    </div>
                                </div>
                            </div>

                    	</div>
                        
                    </div>
                </div>
    </div>
    </fieldset>
    </form>
</div>

<div class="panel-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                    <button class="btn  btn-success" id="savePaymentId" onclick="savePayment()">
                        Guardar pago
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


@endsection

@section('scripts')
<script>
    var jQueryValidator;            // To validate Payment information

    function validatePayment(){
        jQueryValidator = $("#form-payment").validate({
            rules: {
                quantity: {
                    required: true,
                    number: true,
                    maxlength: 12
                },
                paymethod: {
                    required: true,
                    number: true,
                    maxlength: 1
                },
                observation: {
                	maxlength: 225
                }
            },
            messages: {
                paymethod: {
                    required: "Por favor seleccione un tipo para el pago",
                    number: "Indique el tipo en números",
                    maxlength: "El tipo no puede exceder de 1 digito"
                },
                quantity: {
                	required: "Por favor ingrese una cantidad para el pago",
                    number: "Indique la cantidad en números",
                	maxlength: "La cantidad no puede exceder de 12 digitos"
                },
                observation: {
                    maxlength: "La observación no puede exceder de 225 caracteres"
                }
            }
        });
    }

    $(document).ready(function(){
        validatePayment();              // Init jQueryValidator with rules
        var selectType = $("#paymethod");
        $(selectType).val("{{ $dataPayment['paymethod'] }}");
        calculate();
    });

    
    /* ****************************************************************************** */
    // Function for Save Payment data (update, delete, create)
    /* ****************************************************************************** */

    function savePayment(){
        if($('#form-payment').valid()){
            var action = "{{ $action }}";
            var url = "{{URL::action('PaymentController@sendDataPayment',[$action])}}";

            // Show confirmation message
            if(action == "create"){
                var msjConfirmacion = "Pago registrado correctamente.";
            } else {
                var msjConfirmacion = "Pago modificado correctamente.";
            }

            $.ajax({
                url : url,
                data : readFormValues(document.forms['form-payment']),
                type : 'post',
                dataType : 'json',
                beforeSend:function(){
                    $("#savePaymentId").prop('disabled', true);
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
                        window.location="{{URL::action('InvoiceController@index')}}";
                    });
                },
                error : function(xhr, status) {
                    swal({
                        title: xhr.statusText,
                        text: "Presione el boton para continuar!",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonText: "Error",
                        closeOnConfirm: true
                    },function(){
                        window.location="{{URL::action('InvoiceController@index')}}";
                    });
                },
                complete : function(xhr, status) {
                    $("#savePaymentId").removeAttr("disabled");
                }
            });
        }
    };

    /* ****************************************************************************** */
    // Function for [re]calculate the new debt discounting the actual payment
    /* ****************************************************************************** */
    function calculate(){
        if( $('#quantity').val() == '' ){
            quantity = 0;
        } else {
            quantity = parseFloat( $('#quantity').val() ).toFixed(2);
        }
        
        debt = parseFloat( $('#debt').val() ).toFixed(2);

        $('#newDebt').val((debt - quantity).toFixed(2));
    }

    /* ****************************************************************************** */
    // Event handler to update new Debt when is a keyup 
    /* ****************************************************************************** */

    $(document).on('keyup','input',function(e){
        calculate();
    })

</script>
@stop