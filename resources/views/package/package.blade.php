@extends('layouts.master')
@section('title')
Paquetes

@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            @if ($action == "create")
            Registrar nuevo paquete
            @else
            Editar paquete
            @endif
        </h3>
    </div>
    <div class="panel-body">
        <form id="form-package" name="form-package" action="" method="post" class="form-horizontal cmxform">
            <fieldset>
                <div class="container-fluid">
                    <div class="row">

                        <div class="form-group">
                            <div class="row col-sm-12">
                                <label  class="col-sm-3 control-label"> Nombre </label>
                                <div class="col-sm-6">
                                    <input type="text" name="name"  id="name" value="{{$dataPackage['name']}}" class="form-control"  required />
                                    <input type="hidden" name="packageId" id="packageId" value="{{$dataPackage['packageId']}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row col-sm-12">
                                <label  class="col-sm-3 control-label"> Precio </label>
                                <div class="col-sm-6">
                                    <input type="text" name="basePrice"  id="basePrice" value="{{$dataPackage['basePrice']}}" class="form-control"  required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row col-sm-12">
                                <label  class="col-sm-3 control-label"> Detalles del paquete </label>
                                <div class="col-sm-9">
                                    <table class="table table-bordered table-striped mb-none" id="datatableDetailPackage">
                                        <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <br/>
                                    <div class="row">
                                        <div class="btn btn-block btn-info" onclick="addPackage()">Agregar Producto/Servicio</div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-sm-12">


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
                    <button class="btn  btn-success" onclick="savePackage()" id="savePackageId">
                        Guardar paquete
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
    var jQueryValidator;            // To valid Package information
    var datatableDetailPackage;     // Datatable for each detailPackage
    var detailPackage = [];         // List of Package's detailPackage to send
    var detailPackageDeleted = [];  // List of Package's detailPackage to delete

    var elements = [];              // List of items(products, services)
    var elementRow = {              // Object that is inserted on new rows
        quantity: "<input class='form-control' type='number' value='1'></ input>",
        options : "<option value=''>Seleccione</option>",
        cost : "<input class='form-control' type='text' class='detailCost' value='0'></ input>" + 
                "<input class='form-control' type='hidden' value='-1'></ input>",
        deleteOption :  "<div class='btn btn-danger btn-sm'>Quitar</div>"
    };

    (function($) {

        'use strict';

        var datatableInit = function() {
            datatableDetailPackage = $('#datatableDetailPackage').DataTable();
        };

        $(function() {
            datatableInit();
        });
        
    }).apply(this, [jQuery]);


    function validarPaquete(){
        jQueryValidator = $("#form-package").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 45
                },
                basePrice: {
                    required: true,
                    number: true,
                    maxlength: 15
                }
            },
            messages: {
                name: {
                    required: "Por favor ingrese un nombre para el paquete",
                    maxlength: "El paquete no puede exceder de 45 caracteres"
                },
                basePrice: {
                    required: "Por favor ingrese un precio para el paquete",
                    number: "Indique el precio en números",
                    maxlength: "El precio no puede exceder de 15 digitos"
                }
            }
        });
    }

    $(document).ready(function(){
        validarPaquete();              // Inicializar variable jQueryValidator con reglas
        loadItems();                   // 1st Call Load Items, then Load detailPackage(if exists)
    });

    /* ****************************************************************************** */
    // Function for Load list of items and put them like options on the select list
    /* ****************************************************************************** */

    function loadItems(){
        $.ajax({
                url : "{{URL::action('ItemController@getItems')}}",
                type : 'post',
                success : function(data) {
                    for (var i in data){
                        if(data.hasOwnProperty(i)){
                            var item = data[i];
                            var newOption = "<option value='" + item['itemId'] + "'>" + item['descripcion'] + "</option>"; 
                            var newElement = {
                                itemId : item['itemId'],
                                descripcion : item['descripcion'],
                                basePrice : item['basePrice']
                            }
                            elements.push(newElement);
                            elementRow.options += newOption; 
                        }
                    }
                    if("{{$action}}" == "create"){
                        addPackage();
                        calculate();
                    } else {
                        loadDetailPackage();
                    }

                },
                error : function(xhr, status) {

                },
                complete : function(xhr, status) {
                }
        });

    }

    /* ****************************************************************************** */
    // Function for add one Package row on the datatable an recalculate the basePrice
    /* ****************************************************************************** */

    function addPackage(){
        datatableDetailPackage.row.add([
            elementRow.quantity,
            "<select data-plugin-selectTwo class='form-control input-sm mb-md'>" + elementRow.options + "</select>",
            elementRow.cost,
            elementRow.deleteOption
        ]).draw();
        calculate();

        $('body').on('DOMNodeInserted', 'select', function () {
            $(this).select2();
        });
        
        $("select").select2();
    }

    /* ****************************************************************************** */
    // Function for [re]calculate the basePrice (total) iterating on each row.
    /* ****************************************************************************** */

    function calculate(){
        var totalCost = 0;       // Reset totalCost
        detailPackage = [];     // Reset detailPackage

        $("#datatableDetailPackage tbody tr").each(function(i, row){    // For each row in tbody
            var jRow = $(row);
            var detailPackageId = jRow.find("input[type='hidden']").val();
            var quantityAssigned = jRow.find("input[type='number']").val();
            var optionSelected = jRow.find("select").val();
            var costAssigned = jRow.find("input[type='text']").val();

            totalCost += parseFloat(costAssigned);

            var newDetailPackage = {
                detailPackageId : detailPackageId,
                quantity : quantityAssigned,
                itemId : optionSelected,
                basePrice : costAssigned
            };

            detailPackage.push(newDetailPackage);
        });
        $("#basePrice").val(totalCost);
    }

    /* ****************************************************************************** */
    // Event handler to update basePrice (total) when is a keyup 
    /* ****************************************************************************** */

    $(document).on('keyup','input',function(e){
        calculate();
    })

    /* ****************************************************************************** */
    // Event handler to update basePrice in each row then recalculate 
    // basePrice (total) when select changes
    /* ****************************************************************************** */

    $(document).on('change','select',function(e){
        var selected = $(this);             // Get element selected
        var tr = selected.closest('tr');    // Get <tr> Parent
        var inputNum = tr.find("input[type='number']");
        var inputSel = tr.find("select");
        var inputTxt = tr.find("input[type='text']");    // Get <input> inner <tr> Parent

        inputTxt.val(parseInt(inputNum.val()) * getBasePrice(inputSel.val()));   // Set the price
        calculate();                        // Recalculate
    })

    /* ****************************************************************************** */
    // Event handler to update basePrice in each row then recalculate 
    // basePrice (total) when quantity changes
    /* ****************************************************************************** */

    $(document).on('change',"input[type='number']",function(e){
        var selected = $(this);             // Get element selected
        var tr = selected.closest('tr');    // Get <tr> Parent
        var inputNum = tr.find("input[type='number']");
        var inputSel = tr.find("select");
        var inputTxt = tr.find("input[type='text']");    // Get <input> inner <tr> Parent

        inputTxt.val(parseInt(inputNum.val()) * getBasePrice(inputSel.val()));   // Set the price
        calculate();                        // Recalculate
    })

    /* ****************************************************************************** */
    // Function for get basePrice for an item from the item List loaded
    /* ****************************************************************************** */

    function getBasePrice(itemId){
        for (i in elements){
            if(elements[i]['itemId'] == itemId){
                return elements[i]['basePrice'];
            }
        }
    }

    /* ****************************************************************************** */
    // Function for set selected the option with value of itemId from the detailPackage
    /* ****************************************************************************** */

    function selectItem(detailPackageId,itemId){
        var select = document.getElementById(detailPackageId);
        $(select).val(itemId).trigger("change");
    }

    /* ****************************************************************************** */
    // Function for Delete rows (detailPackage) from the table and from the Package
    /* ****************************************************************************** */

    $('#datatableDetailPackage tbody').on('click',"div",function(e) {
        var selected = $(this);             // Get element selected
        var tr = selected.closest('tr');    // Get <tr> Parent
        var detailPackageId = tr.find("input[type='hidden']").val();
        detailPackageId = parseInt(detailPackageId);

        if(detailPackageId != -1) {                     // Only If is saved on the actual package (exists on db)
            detailPackageDeleted.push(detailPackageId);
        }

        console.log(detailPackageId);
        datatableDetailPackage
            .row($(this).parents('tr'))
            .remove()
            .draw();

        calculate();
    });

    /* ****************************************************************************** */
    // Don't process form by default
    /* ****************************************************************************** */

    $('#form-package').submit(function(e){
        e.preventDefault();             
    });

    /* ****************************************************************************** */
    // Function for Save the detailPackage data to the Package (update, delete, create)
    /* ****************************************************************************** */

    function savePackage(){
        if($('#form-package').valid()){
            var action = "{{$action}}";
            var url = "{{URL::action('PackageController@sendDataPackage',[$action])}}";
            // Show confirmation message
            if(action == "create"){
                var msjConfirmacion = "Paquete registrado correctamente.";
            } else {
                var msjConfirmacion = "Paquete modificado correctamente.";
            }

            $.ajax({
                url : url,
                data : {
                    name : $("#name").val(),
                    packageId : $('#packageId').val(),
                    basePrice : $('#basePrice').val(),
                    detailPackage : detailPackage,
                    detailPackageDeleted : detailPackageDeleted
                },
                type : 'post',
                dataType : 'json',
                beforeSend:function(){
                    $("#savePackageId").prop('disabled', true);
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
                        window.location="{{URL::action('PackageController@index')}}";
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
                        window.location="{{URL::action('PackageController@index')}}";
                    });
                },
                complete : function(xhr, status) {
                    $("#savePackageId").removeAttr("disabled");
                }
            });
        }
    };

    /* ****************************************************************************** */
    // Function for Load and List the detailPackage data from the Package
    /* ****************************************************************************** */

    function loadDetailPackage(){
        $.ajax({
            url : "{{ URL::action('PackageController@getDetailPackage',[$dataPackage['packageId']]) }}",
            type : 'post',
            dataType : 'json',
            success : function(data) {
                for (var i in data){
                    if(data.hasOwnProperty(i)){
                        datatableDetailPackage.row.add([
                            "<input class='form-control' type='number' value='" + data[i]['quantity'] + "'></ input>",
                            "<select class='form-control input-sm mb-md' id='" + data[i]['detailPackageId'] + "'>" + elementRow.options + "</select>",
                            "<input class='form-control' type='text' class='detailCost' value='" + data[i]['basePrice'] + "'></ input>"
                            + "<input class='form-control' type='hidden' value='" + data[i]['detailPackageId'] + "'></ input>",
                            elementRow.deleteOption
                        ]).draw();
                                $('body').on('DOMNodeInserted', 'select', function () {
                                    $(this).select2();
                                });
                                
                                $("select").select2();
                        selectItem(data[i]['detailPackageId'], data[i]['itemId']);
                    }
                }
                calculate();
            },
            error : function(xhr, status) {

            },
            complete : function(xhr, status) {
            }
        });
    }
</script>
@stop