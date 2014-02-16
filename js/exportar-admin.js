/**
 * @author Oliver Castelblanco
 */
$(function(){
    $('#xls').click(function() {
        exportarLista('xls');
    });
    $('#xlsx').click(function() {
        exportarLista('xlsx');
    });
    $('#csv').click(function() {
        exportarLista('csv');
    });
});
function exportarLista(tipo){
    $('#ventanaDescarga').modal('show');
    $.getJSON('exportador.php?tipo='+tipo+'&pais='+pais, function(datos){
        $('#ventanaDescarga .modal-body p').html('Se generó el archivo de descarga con '+datos.numFilas+' registros. <a href="'+datos.nombreArchivo+'">Haga clic en este enlace.</a>');
        $('#ventanaDescarga #progreso').hide();
    }).fail(function(datos){
        console.log(datos);
    });
}
