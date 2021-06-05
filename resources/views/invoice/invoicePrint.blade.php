<html>

<!-- Mirrored from preview.oklerthemes.com/porto-admin/1.4.2/pages-invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Oct 2015 03:57:04 GMT -->
<head>
    <title>Imprimir Factura</title>
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
                <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Factura</h2>
                <h4 class="h4 m-none text-dark text-weight-bold">#{{$invoice['invoice']->invoiceId}}</h4>
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
                    <p class="h5 mb-xs text-dark text-weight-semibold">Para:</p>
                    <address>
                        {{"Sr(a):".$invoice['invoice']->customerName." ".$invoice['invoice']->customerLastName."      DNI/RUC:".$invoice['invoice']->customerIdentification}}
                        <br/>
                        {{$invoice['invoice']->customerAddress.", ".$invoice['invoice']->customerCity}}
                        <br/>
                        {{"Telefono(s):  ".$invoice['invoice']->customerPhone1.",   ".$invoice['invoice']->customerPhone2}}
                        <br/>
                        {{$invoice['invoice']->customerEmail}}
                    </address>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bill-data text-right">
                    <br>
                    <p class="mb-none">
                        <span class="text-dark">Fecha de Emision:</span>
                        <span >{{$invoice['invoice']->createdDate }}</span>
                    </p>
                    <p class="mb-none">
                        <span class="text-dark">Fecha de Vencimiento:</span>
                        <span >{{$invoice['invoice']->datePayMax}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table invoice-items">
            <thead>
            <tr class="h4 text-dark">
                <th id="cell-id"     class="text-weight-semibold">#</th>
                <th id="cell-item"   class="text-weight-semibold">Item</th>
                <th id="cell-price"  class="text-center text-weight-semibold">Precio</th>
                <th id="cell-desc"    class="text-center text-weight-semibold">Cantidad</th>
                <th id="cell-qty"    class="text-center text-weight-semibold">Vehiculo</th>
                <th id="cell-total"  class="text-center text-weight-semibold">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoice['invoiceDetail'] as $detailInvoice)
            <tr>
                <td >{{ $detailInvoice->detailinvoiceId }}</td>
                <td class="text-weight-semibold text-dark">{{ $detailInvoice->description }}</td>
                <td class="text-center">{{ $detailInvoice->price }}</td>
                <td class="text-center">{{ $detailInvoice->quantity }}</td>
                <td class="text-center">{{ $detailInvoice->vehicleId }}</td>
                <td class="text-center">{{ $detailInvoice->quantity*$detailInvoice->price }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div class="invoice-summary">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-8">
                <table class="table h5 text-dark">
                    <tbody>
                    <tr class="b-top-none">
                        <td colspan="2">Subtotal(S/.)</td>
                        <td class="text-left">{{$invoice['invoice']->subtotal}}</td>
                    </tr>
                    <tr class="b-top-none">
                        <td colspan="2">Descuento(S/.)</td>
                        <td class="text-left">{{$invoice['invoice']->disccountValue}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">IGV 18% (S/.)</td>
                        <td class="text-left">{{$invoice['invoice']->tax}}</td>
                    </tr>
                    <tr class="h4">
                        <td colspan="2">Total a Pagar (S/.)</td>
                        <td class="text-left">{{$invoice['invoice']->total}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>
</body>

</html>