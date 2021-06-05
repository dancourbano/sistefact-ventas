@extends('layouts.master')
@section('title')
Movimiento
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            @if ($action == "create")
            Registrar nuevo movimiento
            @else
            Editar movimiento
            @endif
        </h3>
    </div>
    <div class="panel-body">
        <form id="form-movement" name="form-movement" action="" method="post" class="form-horizontal cmxform">
            <fieldset>
                <div class="container-fluid">
                    <div class="row col-sm-12">
                    	<div class="row col-sm-6">
                    		@if ($action == "edit")
	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Id </label>
	                                <div class="col-sm-7">
	                                    <input type="text" name="movementId"  id="movementId" value="{{ $dataMovement['movementId'] }}" class="form-control" readonly="readonly" required />
	                                </div>
	                            </div>
	                        </div>
	                        @endif

	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Tipo </label>
	                                <div class="col-sm-7">
	                                   <select class='form-control input-sm mb-md' name="type" id="type">
	                                   		<option value=''>Seleccione</option>
	                                   		<option value='1'>Ingreso</option>
	                                   		<option value='2'>Egreso</option>
	                                   		<option value='3'>Préstamo</option>
	                                   </select>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Responsable </label>
	                                <div class="col-sm-7">
	                                    <input type="text" name="sender"  id="sender" value="{{ $dataMovement['sender'] }}" class="form-control"  required />
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Concepto </label>
	                                <div class="col-sm-7">
	                                    <textarea name="concept"  id="concept" class="form-control"  required><?php echo $dataMovement['concept']; ?></textarea>
	                                </div>
	                            </div>
	                        </div>

                    	</div>
                    	
                    	<div class="row col-sm-6">
                    		<div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Cantidad </label>
	                                <div class="col-sm-7">
	                                    <input type="text" name="quantity"  id="quantity" value="{{ $dataMovement['quantity'] }}" class="form-control"  required />
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Número de Comprobante </label>
	                                <div class="col-sm-7">
	                                    <input type="text" name="comprobanteNumber"  id="comprobanteNumber" value="{{ $dataMovement['comprobanteNumber'] }}" class="form-control" />
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="row col-sm-12">
	                                <label  class="col-sm-5 control-label"> Descripción </label>
	                                <div class="col-sm-7">
	                                    <textarea name="description"  id="description" class="form-control"><?php echo $dataMovement['description']; ?></textarea>
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
                    <button class="btn  btn-success" id="saveMovementId" onclick="saveMovement()">
                        Guardar movimiento
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
    var jQueryValidator;            // To validate Movement information

    function validateMovement(){
        jQueryValidator = $("#form-movement").validate({
            rules: {
                quantity: {
                    required: true,
                    number: true,
                    maxlength: 12
                },
                type: {
                    required: true,
                    number: true,
                    maxlength: 1
                },
                description: {
                	maxlength: 225
                },
                concept: {
                	required: true,
                	maxlength: 245
                },
                sender: {
                	required: true,
                	maxlength: 145
                },
                comprobanteNumber: {
                	maxlength: 45
                }
            },
            messages: {
                quantity: {
                    required: "Por favor ingrese una cantidad para el movimiento",
                    number: "Indique la cantidad en números",
                    maxlength: "El paquete no puede exceder de 45 caracteres"
                },
                type: {
                    required: "Por favor seleccione un tipo para el movimiento",
                    number: "Indique el tipo en números",
                    maxlength: "El tipo no puede exceder de 1 digito"
                },
                description: {
                	maxlength: "La descripción no puede exceder de 225 caracteres"
                },
                concept: {
                	required: "Por favor ingrese un concepto para el movimiento",
                	maxlength: "El concepto no puede exceder de 245 caracteres"
                },
                sender: {
                	required: "Por favor ingrese el nombre del responsable para el movimiento",
                	maxlength: "El nombre del responsable no puede exceder de 145 caracteres"
                },
                comprobanteNumber: {
                	maxlength: "El número de comprobante no puede exceder de 45 caracteres"
                }

            }
        });
    }

    $(document).ready(function(){
        validateMovement();              // Init jQueryValidator with rules
        var selectType = $("#type");
        $(selectType).val("{{ $dataMovement['type'] }}");
    });

    
    /* ****************************************************************************** */
    // Function for Save Movement data (update, delete, create)
    /* ****************************************************************************** */

    function saveMovement(){
        if($('#form-movement').valid()){
            var action = "{{ $action }}";
            var url = "{{ URL::action('MovementController@sendDataMovement',[$action]) }}";

            // Show confirmation message
            if(action == "create"){
                var msjConfirmacion = "Movimiento registrado correctamente.";
            } else {
                var msjConfirmacion = "Movimiento modificado correctamente.";
            }

            $.ajax({
                url : url,
                data : readFormValues(document.forms['form-movement']),
                type : 'post',
                dataType : 'json',
                beforeSend:function(){
                    $("#saveMovementId").prop('disabled', true);
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
                        window.location="{{ URL::action('MovementController@index') }}";
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
                        window.location="{{URL::action('MovementController@index')}}";
                    });
                },
                complete : function(xhr, status) {
                    $("#saveMovementId").removeAttr('disabled');
                }
            });
        }
    };

</script>
@stop