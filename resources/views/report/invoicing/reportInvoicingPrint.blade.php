<html>

<!-- Mirrored from preview.oklerthemes.com/porto-admin/1.4.2/pages-invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Oct 2015 03:57:04 GMT -->
<head>
    <title>Reporte de Facturacion</title>
    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/bootstrap/css/bootstrap.css" />

    <!-- Invoice Print Style -->
    <link rel="stylesheet" href="{{ url('public') }}/assets/stylesheets/invoice-print.css" />
</head>
<body>
<div class="invoice">
    <header class="clearfix">
        <div class="row">
            <div class="col-sm-6 mt-md">
                <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Reporte de Facturacion</h2>
                <h4 class="h4 m-none text-dark text-weight-bold">Fecha :{{date('Y-m-d h:i:s A')}}</h4>
            </div>
            <div class="col-sm-4 text-right mt-md mb-md">
                <address class="ib mr-xlg">
                    GPS JNISI
                    <br/>
                    John F. Kennedy #472, Trujillo ,Perú
                    <br/>
                    Telefono: (044) 692727
                    <br/>
                    gps-jnisi@hotmail.com
                </address>
            </div>
            <div class="col-sm-2">
                <div class="ib">
                    <img src="{{ url('public') }}/assets/images/gpsjnisi.png" alt="" />
                </div>
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
        <table class="table invoice-items">
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
                <tr>
                    <td class="text-weight-semibold text-dar">{{$row->createdDate}}</td>
                    <td class="text-center">{{$row->invoiceId}}</td>
                    <td class="text-weight-semibold text-dark">{{$row->description}}</td>
                    <td class="text-center">{{$row->quantity}}</td>
                    <td class="text-center">{{$row->price}}</td>
                    <td class="text-center">{{$row->methodpayment}}</td>
                    <td class="text-center">{{$row->customerName." ".$row->customerLastName}}</td>
                    <td class="text-center">{{$row->customerIdentification}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>

<script>
    window.print();
</script>
</body>

</html>