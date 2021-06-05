@extends('layouts.master')
@section('title')
Reporte de Mantenimiento
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            Editar reporte de mantenimiento
        </h3>
    </div>
    <div class="panel-body">
        <form id="form-detailMaintenance" name="form-detailMaintenance" action="" method="post" class="form-horizontal cmxform">
            <fieldset>
                <div class="container-fluid">
                    <div class="row col-sm-12">
                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-2 control-label"> N° Placa </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="placa"  id="placa" value="{{ $dataDetailMaintenance['placa'] }}" class="form-control" readonly="readonly" required />
                                        <input type="hidden" name="detailmaintenanceId"  id="detailmaintenanceId" value="{{ $dataDetailMaintenance['detailmaintenanceId'] }}"  />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-2 control-label"> Pestillos </label>
                                    <div class="col-sm-10">
                                        <textarea name="latches" id="latches" class="form-control" rows="2" >{{ $dataDetailMaintenance['latches'] }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-2 control-label"> Botón de pánico </label>
                                    <div class="col-sm-10">
                                        <textarea name="panic" id="panic" class="form-control" rows="2" >{{ $dataDetailMaintenance['panic'] }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-2 control-label"> Claxón </label>
                                    <div class="col-sm-10">
                                        <textarea name="claxon" id="claxon" class="form-control" rows="2" >{{ $dataDetailMaintenance['claxon'] }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-2 control-label"> Botón de encendido / apagado </label>
                                    <div class="col-sm-10">
                                        <textarea name="onOff" id="onOff" class="form-control" rows="2" >{{ $dataDetailMaintenance['onOff'] }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-2 control-label"> Micrófono </label>
                                    <div class="col-sm-10">
                                        <textarea name="microphone" id="microphone" class="form-control" rows="2" >{{ $dataDetailMaintenance['microphone'] }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row col-sm-12">
                                    <label  class="col-sm-2 control-label"> Detalles </label>
                                    <div class="col-sm-10">
                                        <textarea name="detail" id="detail" class="form-control" rows="2" >{{ $dataDetailMaintenance['detail'] }}</textarea>
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
                        <button class="btn  btn-success" id="saveDetailMainenanceId" onclick="saveDetailMaintenance()">
                            Guardar detalle de mantenimiento
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
    var jQueryValidator;            // To validate Maintenance information

    function validateDetailMaintenance(){
        jQueryValidator = $("#form-detailMaintenance").validate({
            rules: {
                latches: {
                    maxlength: 45
                },
                panic: {
                    maxlength: 45
                },
                claxon: {
                    maxlength: 45
                },
                onOff: {
                    maxlength: 45
                },
                microphone: {
                    maxlength: 45
                },
                detail: {
                    maxlength: 65535
                }
            },
            messages: {
                latches: {
                    maxlength: "No puede exceder de 45 caracteres"
                },
                panic: {
                    maxlength: "No puede exceder de 45 caracteres"
                },
                claxon: {
                    maxlength: "No puede exceder de 45 caracteres"
                },
                onOff: {
                    maxlength: "No puede exceder de 45 caracteres"
                },
                microphone: {
                    maxlength: "No puede exceder de 45 caracteres"
                },
                detail: {
                    maxlength: "No puede exceder de 65535 caracteres"
                }
            }
        });
    }

    $(document).ready(function(){
        validateDetailMaintenance();              // Init jQueryValidator with rules
    });


    /* ****************************************************************************** */
    // Function for Save Maintenance data (update, delete, create)
    /* ****************************************************************************** */

    function saveDetailMaintenance(){
        if($('#form-detailMaintenance').valid()){
            var action = "{{ $action }}";
            var url = "{{ URL::action('DetailMaintenanceController@sendDataDetailMaintenance',[$action]) }}";

            // Show confirmation message
            var msjConfirmacion = "Detalle de Mantenimiento modificado correctamente.";


            $.ajax({
                url : url,
                data : readFormValues(document.forms['form-detailMaintenance']),
                type : 'post',
                dataType : 'json',
                beforeSend:function(){
                    $("#saveDetailMainenanceId").prop('disabled', true);
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
                    $("#saveDetailMainenanceId").removeAttr("disabled");

                }
            });
        }
    };
</script>
@stop