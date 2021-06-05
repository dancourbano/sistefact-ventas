@extends('layouts.master')
@section('title')
Productos

@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                @if ($action == "create")
                Registrar nuevo producto
                @else
                Editar Producto
                @endif
            </h3>
        </div>
        <div class="panel-body">
            <form id="form-product" name="form-product" action="" method="post" class="form-horizontal cmxform">
                <fieldset>
                    <div class="container-fluid">
                        <div class="row">

                                <div class="form-group">
                                    <div class="row col-sm-12">
                                        <label  class="col-sm-3 control-label"> Descripción </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="descripcion"  id="descripcion" value="{{$product['descripcion']}}" class="form-control"  required />
                                            <input type="hidden" name="productId" id="productId" value="{{$product['itemId']}}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-sm-12">
                                        <label  class="col-sm-3 control-label"> Precio de costo </label>
                                        <div class="col-sm-6">
                                            <div class="input-group mb-md">
                                                <span class="input-group-addon">S/.</span>
                                                <input type="text" name="basePrice"  id="basePrice" value="{{$product['basePrice']}}" class="form-control"  required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-sm-12">
                                        <label  class="col-sm-3 control-label"> Estado </label>
                                        <div class="col-sm-6">
                                            <select name="status" id="status" class="form-control" value="{{$product['status']}}">
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-sm-12">
                                        <label  class="col-sm-3 control-label"> Stock Inicial </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="itemNumber" value="{{$product['itemNumber']}}" id="itemNumber" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-sm-12">
                                        <label  class="col-sm-3 control-label" > Stock Actual </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="itemNumCurrent" id="itemNumCurrent" value="{{$product['itemNumCurrent']}}" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </fieldset>
                </br>
             </form>
        </div>

        <div class="panel-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-right">
                            <button class="btn  btn-success" id="saveProductId" onclick="saveProduct()">
                                Guardar producto
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
        var jQueryValidator;

        function validarProducto(){
            jQueryValidator = $("#form-product").validate({
                rules: {
                    descripcion: {
                        required: true,
                        maxlength: 125
                    },
                    basePrice: {
                        required: true,
                        number: true,
                        maxlength: 15
                    },
                    status: {
                        required: true
                    },
                    itemNumber: {
                        required: true,
                        number: true,
                        maxlength: 15
                    },
                    itemNumCurrent: {
                        required: true,
                        number: true,
                        maxlength: 15
                    }
                },
                messages: {
                    descripcion: {
                        required: "Por favor ingrese una descripción para el producto",
                        maxlength: "La descripcion no puede exceder de 125 caracteres"
                    },
                    basePrice: {
                        required: "Por favor ingrese un precio para el producto",
                        number: "Indique el precio en números",
                        maxlength: "El precio no puede exceder de 15 digitos"
                    },
                    status: {
                        required: "Por favor seleccione un estado para el producto"
                    },
                    itemNumber: {
                        required: "Por favor ingrese el Stock Inicial para el producto",
                        number: "Indique el Stock Inicial en números",
                        maxlength: "El Stock Inicial no puede exceder 15 digitos"
                    },
                    itemNumCurrent: {
                        required: "Por favor ingrese el Stock Actual para el producto",
                        number: "Indique el stock Actual en números",
                        maxlength: "El Stock Actual no puede exceder 15 digitos"
                    }
                }
            });
        }

        $(document).ready(function(){
            validarProducto();              // Inicializar variable jQueryValidator con reglas
        });

        $('#form-product').submit(function(e){
            e.preventDefault();             // No procesar formulario por defecto
        });

        function saveProduct(){

            if($('#form-product').valid()){
                var action = "{{$action}}";
                var productId=$('#productId').val();
                var url = ("{{ URL::action('ProductController@sendDataProduct',['action','productId']) }}").replace('action',action).replace('productId',productId);

                $.ajax({
                    url : url,
                    data : readFormValues(document.forms['form-product']),
                    type : 'post',
                    dataType : 'json',
                    beforeSend:function(){
                        $("#saveProductId").prop('disabled', true);
                    },
                    success : function(data) {
                        swal({
                            title: "Operacion Realizada Correctamente!",
                            text: "Presione el boton para continuar!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },function(){
                            window.location="{{ URL::action('ProductController@index') }}";
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
                            window.location="{{ URL::action('ProductController@index') }}";
                        });
                    },
                    complete : function(xhr, status) {
                        $("#saveProductId").removeAttr("disabled");

                    }
                });
            }
        };
    </script>
@stop