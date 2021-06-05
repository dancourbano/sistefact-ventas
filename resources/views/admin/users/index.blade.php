@extends('layouts.master')

@section('content')

    <p></p>


    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption"></div>
            <div class="row">
                <div class="col-sm-offset-10 col-sm-2"><a class="btn btn-default" href="{{ url('/users/create') }}" >Agregar Usuario</a>
                </div>
                <br>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable-users">
                <thead>
                <tr>

                    <th>Id</th>
                    <th>nombre</th>
                    <th>email</th>
                    <th>rol</th>
                    <th> </th>
                </tr>
                </thead>

                <tbody>
                @foreach ($users as $row)
                    <tr>

                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->role_id }}</td>
                        <td>
                            <div>
                                <button class="btn btn-info btn-sm" onclick="editCustomer( {{ $row->id }} )"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-warning btn-sm" onclick="deleteCustomer( {{ $row->id }} )"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


            <input type="hidden" id="send" name="toDelete">

        </div>
    </div>


@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#datatable-users').dataTable();
        });
        $('#datatable-users tr').each(function() {
            $(this).find("td").eq(3).html(showRole($(this).find("td").eq(3).html()));
        });
        function showRole(roleId){
            switch(roleId){
                case '1':  return 'Admin'; break;
                case '2':  return 'Cobranza'; break;
                case '3':  return 'Monitor'; break;
            }

        }


        function editCustomer(id){
            if(id == 0 || id == undefined){
                sweetAlert("¡Indique Selección!", "No ha seleccionado ningún Pedido", "warning");
                return false;
            }
            var url = "{{ url('/users/edit') }}/"+ id ;
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
                                            var url = "{{url('/users/delete')}}/"+ idCustomer ;
                                            $(location).attr('href',url);
                                        }
                                    }
                            );
                        } else {
                            swal("Cancelado",
                                    "Eliminación cancelada",
                                    "error");
                        } });
        }
    </script>
@stop