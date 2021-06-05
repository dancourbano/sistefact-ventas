<html>

<!-- Mirrored from preview.oklerthemes.com/porto-admin/1.4.2/pages-invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Oct 2015 03:57:04 GMT -->
<head>
    <title>Registro de Cambios</title>
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
                <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Registro de Creacion y/o Cambios</h2>
                <h4 class="h4 m-none text-dark text-weight-bold">Fecha:{{$parametros['fecha']}}</h4>
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
                    <p class="h5 mb-xs text-dark text-weight-semibold">Un usuario ha registrado los siguientes cambios y/o modificaciones:</p>
                    <address>
                    Usuario:{{$parametros['usuario']}}

                    </address>
                    <p class="h5 mb-xs text-dark text-weight-semibold">Cambios:</p>
                    <address>
                        Tipo:{{$parametros['tipo']}}
                        <br>
                        Tabla:{{$parametros['tabla']}}
                        <br>
                        Datos Registrados:


                    </address>
                </div>
            </div>

        </div>
    </div>
    <div class="table-responsive">
        <table border="1" class="table invoice-items">
            <thead>
            <tr class="h4 text-dark">
                <th id="cell-id"     class="text-weight-semibold">Campo</th>
                <th id="cell-item"   class="text-weight-semibold">Valor</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $campo => $valor)
            <tr>
                <td >{{$campo }}</td>
                <td >{{$valor }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>


</div>

<script>
</script>
</body>

</html>