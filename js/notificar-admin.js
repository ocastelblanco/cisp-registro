/**
 * @author Oliver Castelblanco
 */
var selec=true;
$(function(){
    cargaTabla();
    pasoApaso(1);
});
function cargaTabla() {
    $.getJSON('tablaNotificar.php?pais='+pais, function(datos){
        $("#tablaDocentes tbody").html(datos.cuerpoTabla);
        $('#tituloTabla').html('<i class="fa fa-bars"></i> Docentes registrados: '+datos.registros+"&nbsp;&nbsp;&nbsp;Notificados: "+datos.notificados);
        $('#selectToggle').click(function() {
            togglerSelect();
        });
        ajustaNumBotonNot(numCheck());
        $('input[type=checkbox]:disabled').parent().tooltip({
            title: 'Docente ya notificado o con iniciativa pendiente de aprobación. No se puede notificar.',
            container: 'body'
        });
        $('input[type=checkbox]').click(function() {
            ajustaNumBotonNot(numCheck());
        });
        $('#tablaPie').html('Docentes que pueden ser notificados: '+datos.porNotificar+'<br>Docentes pendientes de aprobación: '+datos.sinAprobar);
        $('#ventanaProgreso .modal-body .alert #sinAprobar').html(datos.sinAprobar);
        $('#accionNotificar').click(function() {
            $('#ventanaProgreso').modal('show');
            $('#ventanaProgreso #continuarNotificacion').click(function() {
                pasoApaso(2);
            });
        });
        if(datos.sinAprobar<1) {
            $('#ventanaProgreso .modal-body .alert').hide();
        }
    }).fail(function(datos){
       console.log(datos); 
    });
}
function togglerSelect() {
    if (selec) {
        $('input[type=checkbox]:checked').prop('checked', false);
        selec = false;
        $('#selectToggle').html('<i class="fa fa-check-square-o"></i> Seleccionar todos');
    } else {
        $('input[type=checkbox]').not(':disabled').prop('checked', true);
        selec = true;
        $('#selectToggle').html('<i class="fa fa-square-o"></i> Deseleccionar todos');
    }
    ajustaNumBotonNot(numCheck());
}
function ajustaNumBotonNot(num){
    if (num>0) {
        $('#accionNotificar').prop('disabled', false);
        $('#accionNotificar span').not('.glyphicon').html(num);
        $('#accionNotificar').parent().tooltip('destroy');
    } else {
        $('#accionNotificar').prop('disabled', true);
        $('#accionNotificar span').not('.glyphicon').html(num);
        $('#accionNotificar').parent().tooltip({
            title: 'No hay docentes seleccionados para notificar'
        });
    }
    if (numCheck() == numEnabled()){
        selec = true;
        $('#selectToggle').html('<i class="fa fa-square-o"></i> Deseleccionar todos');
    } else {
        selec = false;
        $('#selectToggle').html('<i class="fa fa-check-square-o"></i> Seleccionar todos');
    }
    $('#porNotificar').html(numCheck());
}
function numCheck() {
    return $("input[type=checkbox]:checked").length;
}
function numEnabled() {
    return $("input[type=checkbox]").not(':disabled').length;
}
function pasoApaso(paso){
    $('#ventanaProgreso .paso').not('.paso-'+paso).hide(50, function(){
        $('#ventanaProgreso .paso.paso-'+paso).show();
    });
}
