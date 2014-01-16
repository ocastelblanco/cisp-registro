/**
 * @author Oliver Castelblanco
 */
var contVentanaDetalles = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">';
contVentanaDetalles += '<h4 class="modal-title"><i class="fa fa-spinner fa-spin"></i> Cargando contenido...</h4></div>';
contVentanaDetalles += '<div class="modal-body"><div class="progress progress-striped active">';
contVentanaDetalles += '<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">';
contVentanaDetalles += '<span class="sr-only">Cargando datos</span></div></div></div></div></div>';
var tablaResumen = '<table id="tablaIniciativas" class="table table-bordered table-hover table-striped tablesorter">';
tablaResumen += '<thead><tr><td><i class="fa fa-spinner fa-spin"></i> Cargando contenido...</td></tr></thead><tbody></tbody></table>';
$(function(){
    cargaTabla(false);
    cargaGraficos();
});
function cargaGraficos() {
    $.getScript('datos.php?pais='+pais, function(){
       activaGraficos();
    });
}
function cargaTabla(inicial) {
    $('.table-responsive').html(tablaResumen);
    $.getJSON('tables.php?pais='+pais+"&numero=10", function(datos){
        $('#panel-numPend .announcement-heading').html(datos.pendientes);
        $('#panel-numNot .announcement-heading').html(datos.notificados);
        $("#tablaIniciativas thead tr").html(datos.th);
        $("#tablaIniciativas tbody").html(datos.cuerpoTabla);
        $("#tablaIniciativas").tablesorter({
            debug: false,
            sortList: [[3, 1]],
            headers: datos.headers
        });
        $('#tablaIniciativas i.fa.fa-check-circle-o').tooltip({
            title: 'Iniciativa aprobada'
        });
        $('#tablaIniciativas i.fa.fa-ban').tooltip({
            title: 'Iniciativa descartada'
        });
        $('#tablaIniciativas i.fa.fa-circle-o').tooltip({
            title: 'Iniciativa pendiente de revisión'
        });
        $('#tablaIniciativas i.fa.fa-envelope-o').tooltip({
            title: 'Docente pendiente de notificación'
        });
        $('#tablaIniciativas i.fa.fa-envelope').tooltip({
            title: 'Docente notificado'
        });
        $('#tablaIniciativas i.fa.fa-external-link').tooltip({
            title: 'Abrir iniciativa para revisión'
        });
        abreModal();
        $('#tablaIniciativas').bind('sortEnd',function() {
            ajustaFlechas();
        });
    });
}
function ajustaFlechas() {
    $('#tablaIniciativas th.header i').removeClass('fa-sort fa-sort-down fa-sort-up');
    $('#tablaIniciativas th.header').not('th.headerSortUp th.headerSortDown').children('i').addClass('fa-sort');
    $('#tablaIniciativas th.headerSortUp i').addClass('fa-sort-up');
    $('#tablaIniciativas th.headerSortDown i').addClass('fa-sort-down');
}
function abreModal() {
    $('a.abreModal').click(function(e) {
        e.preventDefault();
        $('#ventanaDetalles').html(contVentanaDetalles);
        $('#ventanaDetalles').modal();      
        var id=$(this).attr('href').substr(16);
        $.get('detalles.php?id='+id,function(datos){
            $('#ventanaDetalles').html(datos);
            $('#aprobar, #descartar, #pendiente').click(function(e) {
                e.preventDefault();
                var accion = $(this).attr('id');
                $('#ventanaDetalles').html(contVentanaDetalles);
                $.getJSON('detalles.php?id='+id+'&accion='+accion,function(datos){
                    cargaTabla(true);
                    cargaGraficos();
                    $('#ventanaDetalles').modal('hide');
                });
            });
        });
    });
}