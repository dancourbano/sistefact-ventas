<html>

<!-- Mirrored from preview.oklerthemes.com/porto-admin/1.4.2/pages-invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Oct 2015 03:57:04 GMT -->
<head>
    <title>Imprimir Factura</title>

</head>
<body>
<div class="invoice">
    <header class="clearfix">
        <div class="row">
            <div class="col-sm-6 mt-md">
                <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Reporte de Facturacion</h2>
                <h4 class="h4 m-none text-dark text-weight-bold">Fecha :{{date('Y-m-d h:i:s A')}}</h4>
            </div>
            <div class="col-sm-6 text-right mt-md mb-md">
                <address class="ib mr-xlg">
                    GPS JNISI
                    <br/>
                    John F. Kennedy #472, Trujillo ,Perú
                    <br/>
                    Phone: (044) 692727
                    <br/>
                    gps-jnisi@hotmail.com
                </address>

            </div>
        </div>
    </header>
    <div class="bill-info">
        <div class="row">
            <div class="col-md-6">
                <div class="bill-to">
                    <p class="h5 mb-xs text-dark text-weight-semibold">Detalles del reporte:</p>
                    <address>
                        Items Vendidos:{{$data['invoicing'][0]->quantityItems}}
                        </br>
                        Paquetes Vendidos:{{$data['invoicing'][0]->quantityPackages}}
                        </br>
                        Fecha de Inicio:{{$detailInvoicing['startEmission']}}
                        </br>
                        Fecha de Fin:{{$detailInvoicing['endEmission']}}
                        </br>
                        Cliente:{{$detailInvoicing['customerId']}}
                        </br>
                        Estado:{{$detailInvoicing['status']}}
                    </address>
                </div>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table FRAME="void" RULES="rows" width="100%" >
            <thead>
            <tr class="h4 text-dark">
                <th id="cell-total"     class="text-weight-semibold">Fecha</th>
                <th id="cell-id"   class="text-weight-semibold">ID Factura</th>
                <th id="cell-item"   class="text-weight-semibold">Descripcion</th>
                <th id="cell-id"    class="text-center text-weight-semibold">Cantidad</th>
                <th id="cell-id"  class="text-center text-weight-semibold">Precio</th>
                <th id="cell-qty"    class="text-center text-weight-semibold">Forma de Pago</th>
                <th id="cell-total"  class="text-center text-weight-semibold">Cliente</th>
                <th id="cell-total"  class="text-center text-weight-semibold">DNI/RUC</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['detailinvoice'] as $row)
            <tr align="center">
                <td>{{$row->createdDate}}</td>
                <td align="left">{{$row->invoiceId}}</td>
                <td>{{$row->description}}</td>
                <td>{{$row->quantity}}</td>
                <td>{{$row->price}}</td>
                <td>{{$row->methodpayment}}</td>
                <td>{{$row->customerName." ".$row->customerLastName}}</td>
                <td>{{$row->customerIdentification}}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <br>
</div>

<script>
    window.print();
</script>
</body>

</html>