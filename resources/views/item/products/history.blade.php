@extends('layouts.master')
@section('title')
    Productos

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Historial Productos</h3>
        </div>
        <div class="panel-body">

            <div class="btn-toolbar" role="toolbar">
                <div class="row pull-right">
                    <div class=" col-sm-12">
                        <a class="btn btn-success btn-sm" href="{{ URL::action('ProductController@action',['create',0]) }}" >
                            Agregar Nuevo producto
                        </a>
                    </div>
                </div>
            </div>
            <br>

            <table class="table table-striped table-bordered table-hover table-responsive datatable" id="table-products">
                <thead>
                <tr>

                    <th id="cell-id" class="text-weight-semibold">Id</th>
                    <th id="cell-item" class="text-weight-semibold">Descripcion</th>
                    <th id="cell-total"  class="text-center text-weight-semibold">Precio de Costo</th>
                    <th id="cell-qty" class="text-center text-weight-semibold">Stock Inicial</th>
                    <th id="cell-total"  class="text-center text-weight-semibold">Estado</th>
                    <th id="cell-qty" class="text-center text-weight-semibold">Stock Actual</th>
                    <th id="cell-qty" class="text-center text-weight-semibold">Fecha Ingreso</th>
                    <th id="cell-total"  class="text-center text-weight-semibold">Opciones</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td  class="text-weight-semibold text-dark">{{ $product->itemId }}</td>
                        <td class="text-weight-semibold ">{{ $product->descripcion }}</td>
                        <td class="text-center">{{ $product->basePrice }}</td>
                        <td class="text-center">{{ $product->itemNumber }}</td>
                        <td class="text-center">{{ $product->status }}</td>
                        <td class="text-center">{{ $product->itemNumCurrent }}</td>
                        <td class="text-center">{{ $product->createdDate }}</td>
                        <td class="text-center">
                            <div>
                                <button class="btn btn-danger btn-sm" onclick="deleteProduct({{$product->itemId}})"><i class="fa fa-trash-o"></i></button>
                            </div>
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
        var datatableProducts;
        var detailPackages;
        $(document).ready(function(){
            datatableProducts=$("#table-products").DataTable();
            loadState();
            callAllDetailPackages();
        });

        function callAllDetailPackages(){

            var url = "{{ URL::action('PackageController@getAllDetailPackages') }}";

            $.ajax({

                url : url,

                type : 'get',

                dataType : 'json',

                success : function(data) {
                    detailPackages=data;

                },

                error : function(xhr, status) {

                },
                complete : function(xhr, status) {

                }

            });
        }

        /* Funcion que muestra el estado del producto*/

        function loadState(){
            $('#table-products tr').each(function() {
                $(this).find("td").eq(4).html(showState($(this).find("td").eq(4).html()));
            });
        }

        function showState(state){
            switch(state){
                case '0':  return 'Inactivo'; break;
                case '1':  return 'Activo'; break;
            }
        }

        function editProduct(idProduct){

            var url = ("{{ URL::action('ProductController@action',['edit','idProduct']) }}").replace('idProduct',idProduct);

            $(location).attr('href',url);

        }

        function deleteProduct(idProduct){
            var found=false;
            var i=0;
            for(i in detailPackages){
                if(detailPackages[i].itemId==idProduct){
                    found=true;
                }
            }
            if(found==false){
                swal({
                            title: "Confirme eliminación",
                            text: "Esta seguro de eliminar este producto?",
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
                                            text: "Producto eliminado con éxito.",
                                            type: "success"},
                                        function(isConfirm){
                                            if(isConfirm){

                                                var url = ("{{ URL::action('ProductController@delete',['productId']) }}").replace('productId',idProduct);

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
                    title: 'Operacion Cancelada',
                    text: 'El item que desea eliminar pertenece a un paquete, primero debe retirar el producto  del paquete.',
                    type: 'error'
                });
            }

        }

    </script>
@stop