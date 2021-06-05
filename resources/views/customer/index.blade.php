@extends('layouts.master')

@section('content')

<p></p>


    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption"></div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable-customer">
                <thead>
                    <tr>

                        <th>Id</th>
                        <th>nombre</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>email</th>
                        <th>telefono1</th>
                        <th>telefono2</th>
                        <th>Fec. Nacimiento</th>

                        <th> </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($customerBE as $row)
                        <tr>

                            <td>{{ $row->customerId }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->lastName }}</td>
                            <td>{{ $row->identification }}</td>
                            <td>{{ $row->address }}</td>
                            <td>{{ $row->city }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone1 }}</td>
                            <td>{{ $row->phone2 }}</td>
                            <td>{{ $row->birthday }}</td>
                            <td>
                                <div>
                                    <button class="btn btn-info btn-sm" onclick="editCustomer( {{ $row->customerId }} )"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-warning btn-sm" onclick="deleteCustomer( {{ $row->customerId }} )"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">

                    </button>
                </div>
            </div>

                <input type="hidden" id="send" name="toDelete">

        </div>
	</div>


@stop

@section('script')
    <script>
        $(document).ready(function(){
            $('#datatable-customer').dataTable();
        });

        function showMaritalStatus(maritalStatus){
            switch(maritalStatus){
                case 'SO':  return 'Soltero'; break;
                case 'CA':  return 'Casado'; break;
                case 'VI':  return 'Viudo'; break;
                case 'DI':  return 'Divorciado'; break;
            }

        }

        function editCustomer(id){
            if(id == 0 || id == undefined){
                sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Pedido", "warning");
                return false;
            }
            var url = "{{ url('/customer/showCustomer/edit/') }}/"+ id ;
            $(location).attr('href',url);
        }

        function deleteCustomer(idCustomer){
            swal({
                    title: "Confirme eliminación",
                    text: "Esta seguro de eliminar este cliente?",
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
                                    text: "Eliminacción realizada.",
                                    type: "success"},
                                function(isConfirm){
                                    if(isConfirm){
                                        var url = "{{url('/customer/deleteCustomer/')}}"+ idCustomer ;
                                        $(location).attr('href',url);
                                    }
                                }
                        );
                    } else {
                        swal("Cancelado",
                                "Eliminación cancelada",
                                "error");
                    } }
            );
        }
    </script>
@stop