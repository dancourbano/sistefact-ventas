@extends('layouts.master')
@section('title')
Facturacion

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Nueva Factura</h2>
        </div>
    <section class="panel">
        <div class="panel-body  LoadingOverlayApi" data-loading-overlay>

        <form id="form-invoice" name="form-invoice" method="post" action="" class="form-horizontal cmxform ">
            <fieldset>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <label class="col-sm-4 mb-md control-label text-dark">Nº Factura</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="invoiceNumber" name="invoiceNumber" value="FAC005588" readonly/>
                                    <input type="hidden" class="form-control" id="invoiceId" name="invoiceId" value="" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Forma de Pago</label>
                                <div class="col-sm-8">
                                    <select name="methodPayment" id="methodPayment" class="form-control  mb-md">
                                        <option value="1">Al Contado</option>
                                        <option value="0">Cuenta Bancaria</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Impuesto a la Venta</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="taxType" name="taxType" value="18%" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Estado</label>
                                <div class="col-sm-8">
                                    <select name="status" id="status" class="form-control  mb-md" required>
                                        <option value="">Seleccione</option>
                                        <option value="0">Pendiente</option>
                                        <option value="1">Pagado</option>
                                        <option value="2">Sin emitir</option>
                                    </select>
                                    <label class="error" for="status"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Repetir facturación</label>
                                <div class="col-sm-8">
                                    <select name="repeatInvoice" id="repeatInvoice" class="form-control select">
                                        <option value="0">No Repetir</option>
                                        <option value="1">Cada 2 semanas</option>
                                        <option value="2">Cada 1 mes</option>
                                        <option value="3">Cada 2 meses</option>
                                        <option value="4">Cada 3 meses</option>
                                        <option value="5">Cada 5 meses</option>
                                        <option value="6">Cada 1 año</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Descuento</label>
                                <div class="col-sm-8">
                                    <a  id="btnDiscount" class="btn btn-info" href="#modalDescuento" data-toggle="modal" ><i class="fa fa-tags"></i> Crear Descuento</a>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-4 ">
                            <div class="form-group ">
                                <label class="col-sm-4 control-label text-dark">Fecha</label>
                                <div class="col-sm-8 mb-md">
                                    <input type="text" id="fecha" class="form-control" name="fecha" value="<?php echo date("Y-m-d");?>" readonly/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Deuda</label>
                                <div class="col-sm-8 mb-md">
                                    <input type="text" id="debt" class="form-control" name="debt" value="0.00" readonly="readonly"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Fecha Pago Max</label>
                                <div class="col-sm-8 mb-md">
                                    <input type="text" id="datePayMax" class="form-control" name="datePayMax" value="<?php echo date("Y-m-d H:i:s");?>" readonly="readonly"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Enviar por Correo</label>
                                <div class="col-sm-8">
                                    <div class="checkbox-custom checkbox-default">
                                        <input  type="checkbox"  id="is_sendEmail">
                                        <label for="is_sendEmail"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Cliente</label>
                                <div class="col-sm-8 mb-sm">
                                    <select data-plugin-selectTwo name="customerId" id="customerId" class="form-control" required>
                                        <option value="">Seleccionar Cliente</option>
                                    </select>
                                    <label class="error" for="customerId"></label>
                                    <p><a class="text-info" data-toggle="modal" href="#modalRegisterCustomer"> Agregar Nuevo Cliente</a></p>


                                </div>


                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label text-dark" for="addressCustomer">Dirección</label>
                                <div class="col-md-8 mb-sm">
                                    <textarea class="form-control" rows="2" id="addressCustomer" name="addressCustomer" readonly></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label text-dark">Vehiculo</label>
                                <div class="col-sm-8 mb-sm">
                                    <select data-plugin-selectTwo name="vehicleId" id="vehicleId" class="form-control" required>
                                        <option value="0">Seleccionar Vehiculo</option>
                                    </select>
                                    <label class="error" for="vehicleId"></label>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
        <br>
        <div class="invoice">
            <div class="table-responsive">
                <table class="table invoice-items" id="datatableInvoiceDetail">
                    <thead>
                    <tr class="h4 text-dark">
                        <th id="cell-id"     class="text-weight-semibold">#</th>
                        <th id="cell-item"   class="text-weight-semibold">Item</th>
                        <th id="cell-price"  class="text-center text-weight-semibold">Tipo</th>
                        <th id="cell-price"  class="text-center text-weight-semibold">Precio</th>
                        <th id="cell-qty"    class="text-center text-weight-semibold">Cantidad</th>
                        <th id="cell-qty"    class="text-center text-weight-semibold">Vehiculo</th>
                        <th id="cell-total"  class="text-center text-weight-semibold">Total</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <br>
            <div class="invoice-summary">
                <div class="row">
                    <div class="col-sm-12">
                        <a data-toggle="modal" href="#modalAddItem" class="btn btn-warning ml-sm"><i class="fa fa-plus-circle"></i> Añadir Nuevo Item</a>
                        <a data-toggle="modal" href="#modalProduct" class="btn btn-danger ml-sm"><i class="fa fa-search-plus"></i> Añadir Producto </a>
                        <a data-toggle="modal" href="#modalService"  class="btn btn-danger ml-sm"><i class="fa fa-search-plus"></i> Añadir Servicio</a>
                        <a data-toggle="modal" href="#modalPackage" class="btn btn-danger ml-sm"><i class="fa fa-search-plus"></i> Añadir Paquete</a>
                    </div>
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table h5 text-dark">
                            <tbody>
                            <tr class="b-top-none">
                                <td colspan="2">Subtotal </td>
                                <td class="text-left"><span id="spanSubtotal"><strong>0.00</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2">Descuento</td>
                                <td class="text-left"><span id="spanDescuento"><strong>0.00</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2">IGV</td>
                                <td class="text-left"><span id="spanIGV"><strong>0.00</strong></td>
                            </tr>
                            <tr class="h4">
                                <td colspan="2">Total a Pagar (S/.)</td>
                                <td class="text-left"><span id="spanTotal"><strong>0.00</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mr-lg">
            <a onclick="clearScreen()" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Limpiar Pantalla</a>
            <button onclick="saveInvoice()" id="idGuardarFactura" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar Factura</button>
            <a onclick="printInvoice()" class="btn btn-info ml-sm"><i class="fa fa-print"></i> Imprimir</a>
            <a onclick="excelInvoice()"  class="btn btn-info"><i class="fa fa-file-excel-o"></i> Exportar Excel</a>
            <a onclick="pdfInvoice()" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Exportar PDF</a>
            <a onclick="emailInvoice()" id="idEnviarEmail" class="btn btn-info"><i class="fa fa-envelope-o"></i> Enviar Correo</a>
        </div>
        </div>
</section>

        <!-- Modal Registrar Descuento -->
        <div class="modal fade" id="modalDescuento" role="dialog">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Crear Descuento</h4>
                    </div>
                    <div class="modal-body">

                        <br>
                        <form id="form-discount" name="form-discount" action="" method="post" class="form-horizontal cmxform">
                            <fieldset>
                                <div class="container-fluid">
                                    <div class="row">
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label" > Descuento </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="descuento" id="descuento" class="form-control"  required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Tipo de Descuento<span class="required">*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="radio-custom radio-primary">
                                                        <input id="percentage" name="radio_discount" type="radio" value="0" required />
                                                        <label for="percentage">Porcentaje(%)</label>
                                                    </div>
                                                    <div class="radio-custom radio-primary">
                                                        <input id="quantityFixed" name="radio_discount" type="radio" value="1" />
                                                        <label for="quantityFixed">Cantidad Fija(S/.)</label>
                                                    </div>
                                                    <label class="error" for="radio_discount"></label>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </fieldset>
                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="discountValid()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal -->

        <!-- Modal Registrar Cliente -->
        <div class="modal fade" id="modalRegisterCustomer" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Registrar nuevo usuario</h4>
                    </div>
                    <div class="modal-body">

                        <br>
                        <form id="form-customer" name="form-customer" action="" method="post" class="form-horizontal cmxform">
                            <fieldset>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label" > Nombre </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name" id="name" value="" class="form-control"  required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Apellidos </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="lastName" value="" id="lastName" class="form-control"  required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"><div id="labelIdentification"></div> DNI o RUC </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="identification"  id="identification" value="" class="form-control"  required />
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Telefono 1 </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="phone1"  id="phone1" value="" class="form-control"  required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Telefono 2 </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="phone2"  id="phone2" value="" class="form-control"   />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Direccion </label>
                                                <div class="col-sm-9">
                                                    <input  name="address" id="address" value="" class="form-control"   />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Tipo Cliente </label>
                                                <div class="col-sm-9">

                                                    <select onchange="changeIdentification()" name="type"  id="type"  class="form-control select2">
                                                        <option value="1" selected>Natural</option>
                                                        <option value="2">Empresa</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Email </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email" value="" id="email" class="form-control"   />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Estado Civil </label>
                                                <div class="col-sm-9">
                                                    <select name="maritalStatus"  id="maritalStatus"  class="form-control select2">
                                                        <option value="SO" selected>Soltero</option>
                                                        <option value="CA">Casado</option>
                                                        <option value="DI">Divorciado</option>
                                                        <option value="VI">Viudo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Ciudad </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="city" value="" id="city" class="form-control"  required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"> Fec. Nac </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="birthday"    value="" id="birthday" class="form-control datepicker-bootstrap"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">

                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnSaveCustomer" class="btn btn-primary" onclick="saveCustomer()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal -->

        <!-- Modal Añadir Producto-->
        <div class="modal fade" id="modalProduct" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Añadir producto</h4>
                    </div>
                    <div class="modal-block">

                    </div>
                    <div class="modal-body">
                        <form id="form-product" name="form-product" action="" method="post" class="form-horizontal cmxform">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label  class="col-sm-5 control-label" > Cantidad del Producto </label>
                                            <div class="col-sm-5 has-warning">
                                                <input type="text" name="cantidadProducto"  value="" id="cantidadProducto" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                            </br>
                            <div class="container-fluid">
                                <div  class="datatable">
                                    <table id="dataTableProduct" class="table">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Descripcion</th>
                                            <th>Precio </th>
                                            <th>Codigo</th>
                                            <th>Estado</th>
                                            <th>Stock Actual</th>
                                            <th>Opcion</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($productList as $product)
                                        <tr>
                                            <td>{{ $product->itemId }}</td>
                                            <td>{{ $product->descripcion }}</td>
                                            <td>{{ $product->basePrice }}</td>
                                            <td>{{ $product->itemNumber }}</td>
                                            <td>{{ $product->status }}</td>
                                            <td>{{ $product->itemNumCurrent }}</td>
                                            <td>
                                                <a id="addProduct" onclick="addDetailInvoice('{{$product->descripcion}}',{{$product->itemId}},{{$product->basePrice}},'Producto')" class="btn btn-info" >Agregar</a>
                                            </td>


                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            </br>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>

            </div>
        </div>
    <!--End Modal -->

    <!-- Modal Añadir Servicio-->
    <div class="modal fade" id="modalService" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Servicio</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        </br>
                        <form id="form-service" name="form-service" action="" method="post" class="form-horizontal cmxform">

                            <div  class="datatable">
                                <table id="dataTableService" class="table">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Descripcion</th>
                                        <th>Precio de Costo</th>
                                        <th>Stock Inicial</th>
                                        <th>Estado</th>
                                        <th>Stock Actual</th>
                                        <th>Opcion</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($serviceList as $service)
                                    <tr>
                                        <td>{{ $service->itemId }}</td>
                                        <td>{{ $service->descripcion }}</td>
                                        <td>{{ $service->basePrice }}</td>
                                        <td>{{ $service->itemNumber }}</td>
                                        <td>{{ $service->status }}</td>
                                        <td>{{ $service->itemNumCurrent }}</td>
                                        <td>
                                            <a id="addService" onclick="addDetailInvoice('{{$service->descripcion}}',{{$service->itemId}},{{$service->basePrice}},'Servicio')" class="btn btn-info " >Agregar</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </form>
                        </br>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal -->
    <!-- Modal agregar nuevo item -->
    <div class="modal fade" id="modalAddItem" role="dialog">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Nuevo Item</h4>
                </div>
                <div class="modal-body">

                    <br>

                    <form id="form-item" name="form-item" action="" method="post" class="form-horizontal cmxform">
                        <fieldset>
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="form-group">
                                        <div class="row col-sm-12">
                                            <label  class="col-sm-3 control-label"> Descripción </label>
                                            <div class="col-sm-6">
                                                <input type="text" name="itemDescription"  id="itemDescription" value="" class="form-control"  required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row col-sm-12">
                                            <label  class="col-sm-3 control-label"> Tipo</label>
                                            <div class="col-sm-6">
                                                <select name="itemType"  id="itemType"  class="form-control select2">
                                                    <option value="Producto" selected>Producto</option>
                                                    <option value="Servicio">Servicio</option>
                                                    <option value="Otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row col-sm-12">
                                            <label  class="col-sm-3 control-label"> Precio </label>
                                            <div class="col-sm-6">
                                                <div class="input-group mb-md">
                                                    <span class="input-group-addon">S/.</span>
                                                    <input type="text" name="itemPrice"  id="itemPrice" value="" class="form-control"  required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row col-sm-12">
                                            <label  class="col-sm-3 control-label"> Cantidad </label>
                                            <div class="col-sm-6">
                                                <input type="text" name="itemQuantity" value="" id="itemQuantity" class="form-control"  required />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="addNewItem()">Agregar</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal -->

    <!-- Modal Añadir Paquete-->
    <div class="modal fade" id="modalPackage" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Paquete</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        </br>
                        <form id="form-service" name="form-service" action="" method="post" class="form-horizontal cmxform">

                            <div  class="datatable">
                                <table id="dataTableService" class="table">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Opcion</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($packageList as $package)
                                    <tr>
                                        <td>{{ $package->packageId }}</td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->basePrice }}</td>
                                        <td>
                                            <a id="addService" onclick="addDetailInvoice('{{$package->name}}',{{$package->packageId}},{{$package->basePrice}},'Paquete')" class="btn btn-info " >Agregar</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </form>
                        </br>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal -->
@endsection

@section('scripts')
    <script>
        var jQueryValidatorCustomer;
        var jQueryValidatorProduct;
        var jQueryValidatorDiscount;
        var jQueryValidatorInvoice;
        var direccion=[];
        var listDetailInvoice=[];
        var dataTableInvoiceDetail;
        var dataTableService;
        var dataTableProduct;
        var descuento=0;
        var igv='';
        var isSendEmail=0;
        var total=0;
        var totalSinDescuento=0;
        var subtotal=0;
        var descuentoAplicado=false;
        var hayDescuento=false;
        var cantidadADescontar=0;
        var discountType=-1;
        var repeatInvoice=-1;
        var invoiceIdPrint=0;
        var invoiceRegistered=false;
        var idCustomer=0;


        $(document).ready(function(){
            dataTableInvoiceDetail = $('#datatableInvoiceDetail').DataTable();
            dataTableService = $('#dataTableService').DataTable();
            dataTableProduct = $('#dataTableProduct').DataTable();
            limpiarPantalla();
            validarCustomer();
            validarDescuento();
            validarProduct();
            callAllCustomer();
            validarCheckBox();
            validarInvoice();
            $('#status').val("").trigger("change");
            $('#debt').val("0.00");

        });


        $('.input-daterange input').datepicker({
            orientation: "auto"
        });

        $('#form-customer').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });
        $('#form-invoice').submit(function(e){
            e.preventDefault();     // No procesar formulario por defecto
        });
        $('input.datepicker-bootstrap').datepicker({
            language: "es",
            orientation: "top"
        });
        $('select#customerId').on('change',function(){
            var valor = $(this).val();
            if(valor!=null){
                var i=0
                for(i in direccion){
                    if(valor==direccion[i].id){
                        var direccionCustomer=direccion[i].address;
                        $("#addressCustomer").val(direccionCustomer);
                    }
                }
                $('#vehicleId').val("").trigger("change");
                callVehiclesByCustomer(valor);
            }

        });

        /* Funcion empleada para habilitar y desabilitar campos de un  checkbox*/
        function validarCheckBox(){

            //si checkbox para fechas de citas fue presionado llamamos a esta funcion
            $('#is_sendEmail').click(function() {
                if ($(this).is(':checked')) {
                    isSendEmail=1;
                } else {
                    isSendEmail=0;

                }
            });

        }
        function limpiarPantalla(){
            $("#addressCustomer").val("");//al cargar la pagina limpiamos
            $("#descuento").val("");//al cargar la pagina limpiamos
            $("#is_sendEmail").prop("checked", "");
            $("#percentaje").prop("checked", "");
            $("#quantityFixed").prop("checked", "");
        }
        function validarProduct(){
            jQueryValidatorProduct = $("#form-product").validate({
                rules: {
                    cantidadProducto: {
                        required: true,
                        number: true,
                        min:1,
                        digits:true,
                        maxlength: 10
                    }
                },
                messages: {
                    cantidadProducto: {
                        required: 'Debe indicar la cantidad del producto',
                        number: 'Por favor ingrese un numero valido',
                        min: 'Por favor ingrese un numero mayor que 0',
                        digits: 'Por favor ingrese un numero entero',
                        maxlength: 'Lo sentimos, la cantidad no debe exceder los 10 digitos'
                    }
                }
            });
        }
        function validarDescuento(){
            jQueryValidatorDiscount=$("#form-discount").validate({
                rules:{
                    descuento:{
                        required:true,
                        number: true,
                        min:0
                    },
                    radio_discount: {
                        required: true
                    }

                },
                messages:{
                    descuento:{
                        required:"Por favor ingrese el descuento",
                        number:"Por favor ingrese un numero valido",
                        min:"Por favor ingrese un numero no negativo"
                    },
                    radio_discount:"Por favor seleccione una opcion"
                }
            });
        }

        function validarCustomer(){
            jQueryValidatorCustomer = $("#form-customer").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 45
                    },
                    lastName: {
                        required: true,
                        maxlength: 45
                    },
                    identification: {
                        required: true,
                        number: true,
                        minlength: 8,
                        maxlength: 12
                    },
                    phone1: {
                        required: true,
                        minlength: 6,
                        maxlength: 25
                    },
                    email: {
                        required: false,
                        email: true,
                        maxlength: 65
                    },
                    city: {
                        required: true,
                        minlength: 4,
                        maxlength: 45
                    },
                    type:{
                        required:true
                    },
                    maritalStatus:{
                        required:true
                    }
                },
                messages: {
                    name: "Por favor ingrese su nombre",
                    lastName: "Por favor ingrese su apellido",
                    identification: {
                        required: "Por favor ingrese su DNI o RUC",
                        number: 'Ingrese un DNI/RUC válido',
                        minlength: 'Ingrese un DNI/RUC válido',
                        maxlength: 'Ingrese un DNI/RUC válido'
                    },
                    phone1: {
                        required: "Por favor ingrese su número de télefono",
                        minlength: 'Ingrese un número de teléfono válido',
                        maxlength: 'Ingrese un número de teléfono válido'
                    },
                    email: "Por favor ingrese un correo electrónico válido",
                    type:{
                        required: "El tipo Cliente es requerido"
                    },
                    city:{
                        required: "Por favor ingrese una Ciudad",
                        maxlength: 'Ingrese un número de Ciudad válida'
                    },
                    maritalStatus:{
                        required: "El Estado Civil es requerido"
                    }

                }
            });
        }

        function validarInvoice(){
            jQueryValidatorInvoice = $("#form-invoice").validate({
                rules: {
                    customerId: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                    vehicleId: {
                        required: true
                    }
                },
                messages: {

                    customerId: {
                        required: 'Debe seleccionar un cliente'
                    },
                    status: {
                        required: 'Debe seleccionar el estado'
                    },
                    vehicleId: {
                        required: "Debe seleccionar un vehiculo"
                    }
                }
            });
        }
        function callAllCustomer(){

                var url = "{{ URL::action('CustomerController@getFilterAllCustomer')}}";

                $.ajax({
                    url : url,
                    type : 'get',

                    dataType : 'json',

                    success : function(data) {
                        $('#customerId').empty(); // clear the current elements in select box
                        $('#customerId').append($('<option></option>').attr('value', "").text("Seleccione"));
                        for (row in data) {
                            $('#customerId').append($('<option></option>').attr('value', data[row].customerId).text(data[row].name+" "+data[row].lastName+" "+data[row].identification));
                            var direccionCustomer=new Object();

                            direccionCustomer.id=data[row].customerId;
                            direccionCustomer.address=data[row].address;
                            direccion.push(direccionCustomer);
                        }

                    },

                    error : function(xhr, status) {

                    },
                    complete : function(xhr, status) {

                    }

                });


        };

        function callVehiclesByCustomer(customerId){

            var url = ("{{ URL::action('VehicleController@getVehiclesOfCustomer',['customerId']) }}").replace('customerId',customerId);

            $.ajax({
                url : url,
                type : 'get',

                dataType : 'json',

                success : function(data) {
                    $('#vehicleId').empty(); // clear the current elements in select box
                    $('#vehicleId').append($('<option></option>').attr('value', "0").text("Seleccionar"));
                    //console.log(data);

                    for (row in data) {
                        $('#vehicleId').append($('<option></option>').attr('value', data[row].vehicleId).text(data[row].placa));
                    }

                    $('#vehicleId').val("0").trigger("change");


                },

                error : function(xhr, status) {

                },
                complete : function(xhr, status) {

                }

            });


        };
        function saveCustomer(){
            // validar formulario

            if($('#form-customer').valid()){
                var customerId=0;
                var mode="create";
                if(mode=="create"){
                    customerId=0;
                }
                var url = ("{{ URL::action('CustomerController@sendDataCustomer',['create','customerId']) }}").replace('customerId',customerId);

                $.ajax({
                    // la URL para la petición
                    url : url,

                    // la información a enviar
                    // (también es posible utilizar una cadena de datos)
                    data : readFormValues(document.forms['form-customer']),

                    // especifica si será una petición POST o GET
                    type : 'post',

                    // el tipo de información que se espera de respuesta
                    dataType : 'json',

                    // código a ejecutar si la petición es satisfactoria;
                    // la respuesta es pasada como argumento a la función
                    success : function(data) {
                        callAllCustomer();

                        swal({
                            title: "Cliente registrado!",
                            text: "Presione el boton para continuar!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        },function(){

                            var id=data;
                            console.log(id);
                            $("#addressCustomer").val($("#address").val()).trigger('change');
                            $("#modalRegisterCustomer").modal('hide');
                            $("#customerId").val(id).change();

                        });

                    },

                    // código a ejecutar si la petición falla;
                    // son pasados como argumentos a la función
                    // el objeto de la petición en crudo y código de estatus de la petición
                    error : function(xhr, status) {

                    },
                    complete : function(xhr, status) {

                    }

                });

            }
        };
        //funcion que se encarga de agregar un item al la lista de detalle de factura
        function addDetailInvoice(description,item_id,price_sale,typeItems){
            var flag=false;
            var detailInvoice=new Object();
            var quantity=1;
            var itemId=0;
            var packageId=0;
            var typeItem=typeItems;
            var placa=$("#vehicleId option:selected").html();
            var vehicle=$("#vehicleId").val();

            if(vehicle=='0'){
                placa="Ninguno";
            }

            if(typeItem=='Producto'){
                quantity=$('#cantidadProducto').val();

                if($('#form-product').valid()){
                    flag=true; //bandera para validar si se ingresado cantidad de producto
                }

            }else{
                if(typeItem=='newItem'){
                    quantity=$('#itemQuantity').val();
                    typeItem=$('#itemType').val();
                    flag=true;
                }
                else{
                    flag=true;
                }

            }

            if(typeItem=='Paquete'){
                packageId=item_id;
            }else{
                itemId=item_id;
            }
            if(flag==true){

                detailInvoice.description=description;
                detailInvoice.quantity=quantity;
                detailInvoice.type=typeItem;
                detailInvoice.price=price_sale;
                detailInvoice.itemId=itemId;
                detailInvoice.packageId=packageId;
                detailInvoice.vehicleId=vehicle;
                detailInvoice.placa=placa;
               // detailInvoice.invoiceId=$("#invoice_number").val();
                detailInvoice.subtotal=quantity*price_sale;

                listDetailInvoice.push(detailInvoice);

                if(typeItem=='Producto'){
                    $("#modalProduct").modal('hide');
                    $("#cantidadProducto").val('');
                }else{
                    if(typeItem=='Paquete'){
                        $("#modalPackage").modal('hide');
                    }else{
                        $("#modalService").modal('hide');
                    }
                }

                console.log(listDetailInvoice);
                loadTableInvoiceDetail();
                $('#cantidadProducto').val('');
                clearNewItem();
            }

        }
        function  clearNewItem(){
            $('#itemDescription').val('');
            $('#itemPrice').val('');
            $('#itemQuantity').val('');
        }
        //funcion que actualiza la tabla de detalle de factura cada vez que agregamos o borramos items
        function loadTableInvoiceDetail(){
            dataTableInvoiceDetail.clear().draw();
            var i = 0;
            var j=1;
            subtotal=0;
            total=0;
            for(i in listDetailInvoice){
                dataTableInvoiceDetail.row.add( [
                    j,
                    listDetailInvoice[i].description,
                    listDetailInvoice[i].type,
                    listDetailInvoice[i].price ,
                    listDetailInvoice[i].quantity,
                    listDetailInvoice[i].placa,
                    listDetailInvoice[i].subtotal
                ] );
                total=total+listDetailInvoice[i].subtotal;
                j++;
            }
            totalSinDescuento=total;
            dataTableInvoiceDetail.draw();
            calculateTotalPayment();

        }
    function calculateTotalPayment(){
        //aplicamos el descuento
        if(hayDescuento==true){

                if($("#percentage").is(':checked')){
                    cantidadADescontar=total*(descuento/100);
                    total=(total-cantidadADescontar);
                    $('#spanDescuento').text(cantidadADescontar);
                    discountType=0;//tipo de descuento 0: porcentaje

                }else{

                    discountType=1;//tipo de descuento 1: soles
                    cantidadADescontar=descuento;
                    total=total-cantidadADescontar;
                    $('#spanDescuento').text(cantidadADescontar);

                }

                descuentoAplicado=true;
                console.log("Descuento Aplicado:"+descuentoAplicado);

        }

                total=total.toFixed(2);
                igv=(total*0.18).toFixed(2);
                subtotal=(total-igv).toFixed(2);
                igvAplicado=true;


        $('#spanSubtotal').text(subtotal);
        $("#spanIGV").text(igv);
        $("#spanTotal").text(total);
        $("#debt").val(total);

    }
        function discountValid(){
            if($("#form-discount").valid()){
                descuento=$("#descuento").val();
                $("#modalDescuento").modal('hide');
                hayDescuento=true;
                descuentoAplicado=false;
                console.log("Descuento Aplicado:"+descuentoAplicado);

                if(total==0){
                    descuentoAplicado=false;
                    console.log("Descuento Aplicado:"+descuentoAplicado);

                }else{
                    if(descuentoAplicado==false){
                        total=totalSinDescuento;
                        if($("#percentage").is(':checked')){
                            discountType=0;//tipo de descuento 0: porcentaje
                            cantidadADescontar=total*(descuento/100);
                            total=(total-cantidadADescontar);
                            $('#spanDescuento').text(cantidadADescontar);


                        }else{
                            discountType=1;//tipo de descuento 1: soles

                            cantidadADescontar=descuento;
                            total=total-cantidadADescontar;
                            $('#spanDescuento').text(cantidadADescontar);

                        }
                        descuentoAplicado=true;
                        console.log("Descuento Aplicado:"+descuentoAplicado);

                        total=total.toFixed(2);
                        igv=(total*0.18).toFixed(2);
                        subtotal=(total-igv).toFixed(2);

                        $('#spanSubtotal').text(subtotal);
                        $("#spanIGV").text(igv);
                        $("#spanTotal").text(total);
                        $("#debt").val(total);
                    }

                }
            }
        }
    function addNewItem(){
        var itemDescription;
        var itemType;
        var itemQuantity;
        var itemPrice;

        itemDescription=$("#itemDescription").val();
        itemPrice=$("#itemPrice").val();
        addDetailInvoice(itemDescription,1111,itemPrice,'newItem');
        $("#modalAddItem").modal('hide');
    }

        function saveInvoice(){

            if($('#form-invoice').valid()){
                if(invoiceRegistered==false){
                    //validar que haya algun item seleccionado
                    if(listDetailInvoice.length==0){

                        sweetAlert("Oops...", "Debe agregar un item a la factura!", "error");

                    }else{
                        if(isSendEmail==0){
                            repeatinvoice=-1
                        }else{
                            repeatinvoice=$("#repeatinvoice").val();
                        }
                        var invoiceId=0;
                        var mode="create";
                        var url = ("{{ URL::action('InvoiceController@sendDataInvoice',['action']) }}").replace('action',mode);
                        var productosJSON = JSON.stringify(listDetailInvoice);


                        $.ajax({
                            // la URL para la petición
                            url : url,

                            // la información a enviar
                            // (también es posible utilizar una cadena de datos)
                            data : {
                                invoiceId: invoiceId,
                                taxType:1,//IGV
                                tax:igv,
                                disccountValue:cantidadADescontar,
                                subtotal:subtotal,
                                datePayMax:$("#datePayMax").val(),
                                status:$("#status").val(),
                                disccountType:discountType,
                                total:total,
                                is_sendEmail:isSendEmail,
                                repeatInvoice:$("#repeatInvoice").val(),
                                debt:$("#debt").val(),
                                customerId:$("#customerId").val(),
                                // paymentLateType:$("#paymentLateType").val(),
                                methodpayment:$("#methodPayment").val(),
                                productos: productosJSON

                            },

                            // especifica si será una petición POST o GET
                            type : 'post',

                            // el tipo de información que se espera de respuesta
                            dataType : 'json',

                            // código a ejecutar si la petición es satisfactoria;
                            // la respuesta es pasada como argumento a la función
                            beforeSend:function(){
                                $("#idGuardarFactura").prop('disabled', true);
                                $('.LoadingOverlayApi').trigger('loading-overlay:show');
                            },
                            success : function(data) {
                                $('.LoadingOverlayApi').trigger('loading-overlay:hide');
                                invoiceIdPrint=data;
                                //console.log(invoiceIdPrint);
                                swal({
                                    title: "Factura registrada!",
                                    text: "Presione el boton para continuar!",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "OK",
                                    closeOnConfirm: true
                                },function(){
                                    //window.location="{{URL::to('invoice')}}";
                                });
                            },

                            // código a ejecutar si la petición falla;
                            // son pasados como argumentos a la función
                            // el objeto de la petición en crudo y código de estatus de la petición
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
                                $("#idGuardarFactura").removeAttr('disabled');

                            }
                        });
                        invoiceRegistered=true;
                        idCustomer=$("#customerId").val();
                    }
                }else{
                        new PNotify({
                            title: 'Factura ya registrada',
                            text: 'Ya se ha registrado una factura con los mismos datos, por favor reingrese al modulo de facturacion o presione el boton Limpiar Pantalla',
                            type: 'error'
                        });
                }



            }else{
                new PNotify({
                    title: 'Campos sin Rellenar',
                    text: 'Por favor verifique que todos los campos requeridos esten llenados.',
                    type: 'error'
                });
            }
        }

    function printInvoice(){
        if(invoiceRegistered==true){
            var url = ("{{ URL::action('InvoiceController@printInvoice',['invoiceId']) }}").replace('invoiceId',invoiceIdPrint);
            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }else{
            new PNotify({
                title: 'Factura no Registrada',
                text: 'Debe registrar una factura para poder imprimir los datos.',
                type: 'error'
            });
        }


    }

    function pdfInvoice(){
        if(invoiceRegistered==true){
            var url = ("{{ URL::action('InvoiceController@pdfInvoice',['invoiceId']) }}").replace('invoiceId',invoiceIdPrint);

            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }else{
            new PNotify({
                title: 'Factura no Registrada',
                text: 'Debe registrar una factura para poder imprimir los datos.',
                type: 'error'
            });
        }

    }
    function excelInvoice(){
        if(invoiceRegistered==true){
            var url = ("{{ URL::action('InvoiceController@excelInvoice',['invoiceId']) }}").replace('invoiceId',invoiceIdPrint);

            var ventanaPrint = window.open(url, '_blank');
            ventanaPrint.focus();
        }else{
            new PNotify({
                title: 'Factura no Registrada',
                text: 'Debe registrar una factura para poder exportar los datos a excel. ',
                type: 'error'
            });
        }

    }
    function emailInvoice(){


        if(invoiceRegistered==true){
            //obtenemos los datos del cliente para verificar si tiene email
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

                                                var url = ("{{ URL::action('InvoiceController@emailInvoice',['invoiceId','customerId']) }}").replace('invoiceId',invoiceIdPrint).replace('customerId',idCustomer);

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





        }else{
            new PNotify({
                title: 'Factura no Registrada',
                text: 'Debe registrar una factura para poder enviar los datos a un e-mail.',
                type: 'error'
            });
        }

    }

    function clearScreen(){
        location.reload();

    }
    </script>
@stop