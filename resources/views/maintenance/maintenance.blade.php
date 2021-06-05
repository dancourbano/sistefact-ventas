@extends('layouts.master')
@section('title')
Mantenimiento
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            Mantenimiento -
            @if ($action == "create")
            Registrar nuevo mantenimiento
            @else
            Editar mantenimiento
            @endif
        </h3>
    </div>
    <div class="panel-body">
        <form id="form-maintenance" name="form-maintenance" action="" method="post" class="form-horizontal cmxform">
            <fieldset>
                <div class="container-fluid">
                    <div class="row col-sm-12">
                            @if ($action == "edit")
                                <div class="form-group">
                                    <div class="row col-sm-12">
                                        <label  class="col-sm-5 control-label"> Id de Mantenimiento </label>
                                        <div class="col-sm-7">
                                            <input type="text" name="maintenanceId"  id="maintenanceId" value="{{ $dataMaintenance['maintenanceId'] }}" class="form-control" readonly="readonly" required />
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> N° Placa </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="placa"  id="placa" value="{{ $dataMaintenance['placa'] }}" class="form-control" readonly="readonly" required />
                                        <input type="hidden" name="vehicleId"  id="vehicleId" value="{{ $dataMaintenance['vehicleId'] }}"  />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> Fecha de mantenimiento </label>
                                    <div class="col-sm-7">
                                        <input type="text" id="maintenanceDate" class="form-control datetimepicker-bootstrap" name="maintenanceDate" value="{{ $dataMaintenance['maintenanceDate'] }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> Estado </label>
                                    <div class="col-sm-7">
                                        <select name="status" id="status" class="form-control" value="{{ $dataMaintenance['status'] }}">
                                            <option value="0">No atendido</option>
                                            <option value="1">Atendido</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-5 control-label"> Detalles </label>
                                    <div class="col-sm-7">
                                        <textarea name="detail" id="detail" class="form-control" rows="3" required>{{ $dataMaintenance['detail'] }}</textarea>
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
    <div class="btn-toolbar" role="toolbar">
        <div class="row pull-right">
            <button class="btn btn-success btn-md" id="saveMaintenanceId" onclick="saveMaintenance()">
                Guardar Mantenimiento
            </button>
        </div>  
    </div>
</div>
</div>


@endsection

@section('scripts')
<script>
    var jQueryValidator;            // To validate Maintenance information

    function validateMaintenance(){
        jQueryValidator = $("#form-maintenance").validate({
            rules: {
                maintenanceDate: {
                    required: true
                },
                detail: {
                    required: true,
                    maxlength: 225
                },
                status: {
                    required: true
                }
            },
            messages: {
                maintenanceDate: {
                    required: "Por favor ingrese una fecha para el mantenimiento"
                },
                detail: {
                    required: "Por favor detalle brevemente el mantenimiento",
                    maxlength: "El detalle no puede exceder de 225 caracteres"
                },
                status: {
                    required: "Seleccione un estado"
                }
            }
        });
    }

    $(document).ready(function(){
        $("#maintenanceDate").datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        var status = "{{$dataMaintenance['status']}}";
        $("#status").val(status).trigger('change');
        validateMaintenance();              // Init jQueryValidator with rules
    });

    $('.input-daterange input').datepicker({
            orientation: "auto"
        });

    /* ****************************************************************************** */
    // Function for Save Maintenance data (update, delete, create)
    /* ****************************************************************************** */

    function saveMaintenance(){
        if($('#form-maintenance').valid()){
            var action = "{{ $action }}";
            var url = (" {{ URL::action('MaintenanceController@sendDataMaintenance',[$action]) }} ")

            // Show confirmation message
            if(action == "create"){
                var msjConfirmacion = "Mantenimiento registrado correctamente.";
            } else {
                var msjConfirmacion = "Mantenimiento modificado correctamente.";
            }

            $.ajax({
                url : url,
                data : readFormValues(document.forms['form-maintenance']),
                type : 'post',
                dataType : 'json',
                beforeSend:function(){
                  $("#saveMaintenanceId").prop('disabled', true);
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
                        window.location="{{ URL::action('VehicleController@index') }}";
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
                        window.location="{{URL::action('VehicleController@index')}}";
                    });
                },
                complete : function(xhr, status) {
                    $("#saveMaintenanceId").removeAttr('disabled');
                }
            });
        }
    };
</script>
@stop