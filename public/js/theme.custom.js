/* Add here all your JS customizations */
function showHtmlErrorMessage(message){
  var msg='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">x</a><center><div class="img-error"></div><div class="text-alert">'+ message +'</div></center></div>';

  $('.alertMsg').html(msg);
}
function showHtmlBlankMessage(){
  $('.alertMsg').html('');
}
function showHtmlSuccessMessage(message){
  var msg='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">x</a><center><div class="img-success"></div><div class="text-alert">'+ message +'</div></center></div>';

  $('.alertMsg').html(msg);
}
function showHtmlWarningMessage(message){
  var msg='<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">x</a><center><div class="img-warning"></div>'+ message +'</center></div>';

  $('.alertMsg').html(msg);
}
function showHtmlInfoMessage(message){
  var msg=' <div class="alert alert-info"><a href="#" class="close" data-dismiss="alert">x</a><center><div class="img-info"></div>><div class="text-alert">'+ message + '</div></center></div>';
  $('.alertMsg').html(msg);
}
function showHtmlWaitingMessage(message){
  var msg=' <div class="alert alert-waiting"><center><div class="img-waiting"></div><div class="text-alert">'+ message + '</div> </center></div>';
  $('.alertMsg').html(msg);
}
//function showHtmlErrorMessageInAppMessageSecction(message){ showHtmlErrorMessage('nombreDivFijo',message);}
function validacion(pass1){

  if (pass1.val() == null || pass1.val().length == 0 || /^\s+$/.test(pass1.val()) ){
    return false;
  }

  return true;
}

$.extend( $.fn.dataTable.defaults, {



    language: {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando... ",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
});


//===== Default datatable =====//



function readFormValues(form){
  var els= form.elements;
  var $row={};
  for (var i=0; i < els.length; i++)
  {
    $row[els[i].name]=els[i].value;
  }
  return $row;
}
