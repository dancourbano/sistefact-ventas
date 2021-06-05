@extends('layouts.master')
@section('title')
Facturacion

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Envio de Email</h3>
        </div>
        <div class="panel-body">

            <div class="invoice">
                <header class="clearfix">
                    <h5 class="modal-title">Datos de envío</h5>
                </header>
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-1">
                        <table class="table invoice-items text-dark">
                            <tbody>
                            <tr class="b-top-none">
                                <td id="cell-id" >Nombre:</td>
                                <td id="cell-desc" class="text-left">{{$customer['name']."  ".$customer['lastName']}}</td>
                            </tr>
                            <tr>
                                <td id="cell-id">Email:</td>
                                <td id="cell-desc" class="text-left">{{$customer['email']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p>
                    Se a entregado con exito el email, por favor cierre esta pagina.
                </p>
            </div>

        </div>

    </div>


@endsection

@section('scripts')
    <script>

    </script>
@stop