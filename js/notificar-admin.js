/**
 * @author Oliver Castelblanco
 */
var selec=true;
var numNotificados = 0;
var intervaloNot;
var idDocentes = [];
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
            $('#ventanaProgreso').modal({
                backdrop: 'static',
                keyboard: false
            });
            obtenerIDdocentes();
            $('#ventanaProgreso #continuarNotificacion').click(function() {
                notificar();
            });
        });
        if(datos.sinAprobar<1) {
            $('#ventanaProgreso .modal-body .alert').hide();
        }
    }).fail(function(datos){
       console.log(datos); 
    });
}
function obtenerIDdocentes(){
    $('input[type=checkbox]:checked').each(function(){
        idDocentes.push($(this).val());
    });
}
function notificar() {
    if (numNotificados < idDocentes.length) {
        pasoApaso(2);
        $('#ventanaProgreso #envioActual').html(numNotificados);
        $('#ventanaProgreso .porNotificar').html(numCheck());
        var porcentaje = Math.floor((numNotificados*2)/(numCheck()*2)*100);
        $('#ventanaProgreso .progress-bar').attr('style', 'width: '+porcentaje+'%');
        $('#ventanaProgreso .sr-only').html('Completado '+porcentaje+'%');
        $('#ventanaProgreso #textoBarraProgreso').html('Completado '+porcentaje+'%');
        var numID = idDocentes[numNotificados];
        enviarNotificacion(numID);
    } else {
        clearTimeout(intervaloNot);
        pasoApaso(4);
        $('#ventanaProgreso').on('hidden.bs.modal', function (e) {
            document.location.reload(true);
        });
    }
}
function enviarNotificacion(num) {
    $.getJSON('notificador.php?id='+num, function(datos){
        pasoApaso(3);
        var porcentaje = Math.floor(((numNotificados*2)+1)/(numCheck()*2)*100);
        $('#ventanaProgreso .progress-bar').attr('style', 'width: '+porcentaje+'%');
        $('#ventanaProgreso .sr-only').html('Completado '+porcentaje+'%');
        $('.nombreDocente').html(datos.nombres+' '+datos.apellidos);
        if(datos.resultado == 'correcto') {
            $('#ventanaProgreso #textoBarraProgreso').html('Completado '+porcentaje+'%');
        } else {
            $('#ventanaProgreso #textoBarraProgreso').html('Error en el envío de correo a '+datos.nombres+" "+datos.apellidos+": "+datos.error);
        }
        numNotificados++;
        intervaloNot = window.setTimeout(notificar, 15*1000);
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
