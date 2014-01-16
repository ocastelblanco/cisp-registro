/**
 * @author Oliver Castelblanco
 */
/*
var htmlPlanDeAccion = new Array('<div class="row filaPar" id="plandeaccion','"><div class="col-md-12"><div class="row fila01"><div class="col-md-4"><div class="form-group"><label for="actividades','">ACTIVIDADES (Descripción)</label><textarea id="actividades','" class="form-control" rows="2"></textarea></div></div><!-- /.col-md-4 --><div class="col-md-4"><div class="form-group"><label for="metas','">METAS</label><textarea id="metas','" class="form-control" rows="2"></textarea></div></div><!-- /.col-md-4 --><div class="col-md-4"><div class="form-group"><label for="actores','">ACTORES INVOLUCRADOS</label><textarea id="actores','" class="form-control" rows="2"></textarea></div></div><!-- /.col-md-4 --></div><!-- /.row fila01 --><div class="row fila02"><div class="col-md-4"><div class="form-group"><label for="disponibles','">RECURSOS DISPONIBLES</label><textarea id="disponibles','" class="form-control" rows="2"></textarea></div></div><!-- /.col-md-4 --><div class="col-md-4"><div class="form-group"><label for="nodisponibles','">RECURSOS NO DISPONIBLES</label><textarea id="nodisponibles','" class="form-control" rows="2"></textarea></div></div><!-- /.col-md-4 --><div class="col-md-4"><div class="form-group"><label for="cronograma','">CRONOGRAMA</label><textarea id="cronograma','" class="form-control" rows="2"></textarea></div></div><!-- /.col-md-4 --></div><!-- /.row fila02 --></div><!-- /.col-md-12 --><div class="col-md-12 botonesAccion"><button type="button" class="anadir btn btn-default"><span class="glyphicon glyphicon-plus"></span> Añadir nueva fila</button><button type="button" class="eliminar btn btn-danger"><span class="glyphicon glyphicon-minus"></span> Eliminar esta fila</button></div><!-- /.col-md-12 --></div><!-- /.row filaImpar -->');
var numPlanDeAccion = 0;
var planDeAccion = new Array();
planDeAccion.push(htmlPlanDeAccion);
*/
var paises,departamentos,municipios,pais,departamento,municipio;
var opcionesForm = {
    beforeSend:         iniciarCarga,
    uploadProgress:     mostrarProgreso,
    success:            mostrarOK,
    dataType:           'json'
};
function iniciarCarga(){
    var barraDeProgreso = '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><span class="sr-only">Completado 0%</span></div></div>';
    $('#progreso').html(barraDeProgreso);
    $('.modal-body p').html('Iniciando el registro');
    console.log('Iniciando el registro');
}
function mostrarProgreso(event,position,total,percentComplete){
    var barraDeProgreso = '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="'+percentComplete+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%;"><span class="sr-only">Completado '+percentComplete+'%</span></div></div>'; 
    $('#progreso').html(barraDeProgreso);
    $('.modal-body p').html('Carga de datos: '+percentComplete+'%');
    console.log('Carga de datos: '+percentComplete+'%');
}
function mostrarOK(respuesta,estatus,xhr,jqForm){
    var barraDeProgreso = '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">Completado 100%</span></div></div>';
    $('#progreso').html(barraDeProgreso);
    $('.modal-body p').html(respuesta.nombres+' '+respuesta.apellidos+' sus datos han sido registrados exitosamente.<br><br>Muchas gracias por su participación.');
    console.log('Datos cargados finalmente');
    console.log(respuesta);
    //borrarDatos();
    $('#ventanaProgreso').on('hidden.bs.modal', function () {
        $('form').hide();
        $('#navegacion').hide();
        $('#instrucciones p:first').html('Gracias por su interés en esta iniciativa.');
        $('#instrucciones p:last').html('Próximamente nos comunicaremos con usted a través de su correo electrónico.');
   });
   return false;
}
$(function(){
   $('#guardando').hide();
   $.getJSON('js/municipios.json', function(datos){
      paises = datos;
      if (supports_html5_storage()) {
          cargarDatos();
          window.setInterval(guardarDatos, 20 * 1000);
           $("#formulario").submit(function() {
               event.preventDefault();
               $('#ventanaProgreso').modal();
               console.log('Validando datos');
               if (validarDatos()){
                   console.log('Enviando datos');
                   $('#alertaPoblacionIP').addClass('hidden');
                   $(this).ajaxSubmit(opcionesForm);
               } else {
                   $('.modal-body p').html('Hay un error de validación en el formulario.<br><br>Cierre esta ventana, revise y corrija el error para poder continuar');
                   $('#alertaPoblacionIP').removeClass('hidden');
               }
           });
       }
   });
   ajustarAlturaFichas();
   $(window).resize(function() {
       ajustarAlturaFichas();
   });
   $('select#pais').change(function() {
       if($('select#pais option:first').val() == 'Seleccione el país') {
           $('select#departamento').removeAttr('disabled');
           $('select#municipio').removeAttr('disabled');
           $('select#pais option:first').remove();
       }
       pais = $('select#pais option:selected').val();
       cambiaPais(true);
   });
   $('select#departamento').change(function() {
       departamento = $('select#departamento option:selected').val();
       cambiaDepto();
   });
   
   $('#nombreIE').jqBootstrapValidation();
   $('#zonaIE').jqBootstrapValidation();
   $('#direccionIE').jqBootstrapValidation();
   $('#telefonoIE').jqBootstrapValidation();
   $('#emailIE').jqBootstrapValidation();
   $('#nombres').jqBootstrapValidation();
   $('#apellidos').jqBootstrapValidation();
   $('#cargo').jqBootstrapValidation();
   $('#area').jqBootstrapValidation();
   $('#grado').jqBootstrapValidation();
   $('#direccion').jqBootstrapValidation();
   $('#telefono').jqBootstrapValidation();
   $('#email').jqBootstrapValidation();
   $('#descripcionperfil').jqBootstrapValidation();
   $('#nombreIP').jqBootstrapValidation();
   $('#resumenIP').jqBootstrapValidation();
   /*
   $('#poblacionIP_estudiantes').jqBootstrapValidation();
   $('#poblacionIP_docentes').jqBootstrapValidation();
   $('#poblacionIP_directivas').jqBootstrapValidation();
   $('#poblacionIP_padres').jqBootstrapValidation();
   $('#poblacionIP_miembros').jqBootstrapValidation();
   $('#poblacionIP_otros').jqBootstrapValidation();
   $('#poblacionIP_otrosTexto').jqBootstrapValidation();
   $('#poblacionIP_estudiantesCant').jqBootstrapValidation();
   $('#poblacionIP_docentesCant').jqBootstrapValidation();
   $('#poblacionIP_directivasCant').jqBootstrapValidation();
   $('#poblacionIP_padresCant').jqBootstrapValidation();
   $('#poblacionIP_miembrosCant').jqBootstrapValidation();
   $('#poblacionIP_otrosCant').jqBootstrapValidation();
   $('#tiempoIP').jqBootstrapValidation();
   $('#pais').jqBootstrapValidation();
   $('#departamento').jqBootstrapValidation();
   $('#municipio').jqBootstrapValidation();
   $('#nivelIP').jqBootstrapValidation();
   $('#otroNivelIP').jqBootstrapValidation();
   */
   $('input[name="nivelIP"]').click(function() {
       habilitaNivelIP();
   });
   $('input[value="poblacionIP_otros"],input[value="poblacionIP_estudiantes"],input[value="poblacionIP_docentes"],input[value="poblacionIP_directivas"],input[value="poblacionIP_padres"],input[value="poblacionIP_miembros"]').click(function() {
          habilitaPoblacionIP();
   });
   $('#masAnexoIP1').click(function() {
       $('#filaAnexoIP2').removeClass('oculto');
       $(this).hide();
   });
   $('#masAnexoIP2').click(function() {
       $('#filaAnexoIP3').removeClass('oculto');
       $(this).hide();
       $('#menosAnexoIP2').hide();
   });
   $('#menosAnexoIP2').click(function() {
       $('#filaAnexoIP2').addClass('oculto');
       $('#masAnexoIP1').show();
       $('#menosAnexoIP2').show();
   });
   $('#menosAnexoIP3').click(function() {
       $('#filaAnexoIP3').addClass('oculto');
       $('#masAnexoIP2').show();
       $('#menosAnexoIP2').show();
   });
   /*
   $('#plandeaccion button.anadir').click(function() {
       nuevaFila(this);
   });
   */
});
// ---------------------> Funciones generales
function cambiaDepto() {
   if (!$('select#departamento option:selected').val()){
       municipios = departamentos[departamento];
       $('#select#departamento').val(departamento);
   } else {
       municipios = departamentos[$('select#departamento option:selected').val()];
   }
   var salida = "";
   for (var i=0;i<municipios.length;i++) {
       salida += '<option>'+municipios[i]+'</option>';
   }
   $('select#municipio').html(salida);
   if (municipio) $('select#municipio').val(municipio);
}
function cambiaPais(depto) {
   if (!$('select#pais option:selected').val()){
       departamentos = paises[pais];
       $('select#pais').val(pais);
   } else {
       departamentos = paises[$('select#pais option:selected').val()];
   }
   var salida = "";
   for (var depto in departamentos) {
       salida += '<option>'+depto+'</option>';
   }
   $('select#departamento').html(salida);
   if (depto) cambiaDepto();
}
function ajustarAlturaFichas() {
    var altura = ($('.navbar').height()+10)+"px";
    $('#instrucciones').css("margin-top", altura);
}
function validarDatos(){
    var num = $('#poblacionIP input[type="checkbox"]:checked').length;
    if (num){
        return true;
    } else {
        return false;
    }
}
function habilitaPoblacionIP() {
       if($('input[value="poblacionIP_otros"]:checked').val() == "poblacionIP_otros") {
           $('input#poblacionIP_otrosTexto').removeAttr('disabled');
           $('input#poblacionIP_otrosCant').removeAttr('disabled');
       } else {
           $('input#poblacionIP_otrosTexto').attr('disabled', true);
           $('input#poblacionIP_otrosCant').attr('disabled', true);
       }
       if($('input[value="poblacionIP_estudiantes"]:checked').val() == "poblacionIP_estudiantes") {
           $('input#poblacionIP_estudiantesCant').removeAttr('disabled');
       } else {
           $('input#poblacionIP_estudiantesCant').attr('disabled', true);
       }
       if($('input[value="poblacionIP_docentes"]:checked').val() == "poblacionIP_docentes") {
           $('input#poblacionIP_docentesCant').removeAttr('disabled');
       } else {
           $('input#poblacionIP_docentesCant').attr('disabled', true);
       }
       if($('input[value="poblacionIP_directivas"]:checked').val() == "poblacionIP_directivas") {
           $('input#poblacionIP_directivasCant').removeAttr('disabled');
       } else {
           $('input#poblacionIP_directivasCant').attr('disabled', true);
       }
       if($('input[value="poblacionIP_padres"]:checked').val() == "poblacionIP_padres") {
           $('input#poblacionIP_padresCant').removeAttr('disabled');
       } else {
           $('input#poblacionIP_padresCant').attr('disabled', true);
       }
       if($('input[value="poblacionIP_miembros"]:checked').val() == "poblacionIP_miembros") {
           $('input#poblacionIP_miembrosCant').removeAttr('disabled');
       } else {
           $('input#poblacionIP_miembrosCant').attr('disabled', true);
       }
}
function habilitaNivelIP() {
    if($('input[name="nivelIP"]:checked').val() == "Otro") {
        $('input#otroNivelIP').removeAttr('disabled');
    } else {
        $('input#otroNivelIP').attr('disabled', true);
    }
}
//Credit: http://diveintohtml5.org/storage.html
function supports_html5_storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}
function cargarDatos() {
    $('#guardando > span').html('Cargando datos almacenados temporalmente...');
    $('#guardando').css('right', '20px');
    $('#guardando').show();
    if(localStorage["registro-cisp.nombreIE"] && localStorage["registro-cisp.nombreIE"] != 'undefined') $("#nombreIE").val(localStorage["registro-cisp.nombreIE"]);
    if(localStorage["registro-cisp.zonaIE"] && localStorage["registro-cisp.zonaIE"] != 'undefined') $("#zonaIE").val(localStorage["registro-cisp.zonaIE"]);
    if(localStorage["registro-cisp.direccionIE"] && localStorage["registro-cisp.direccionIE"] != 'undefined') $("#direccionIE").val(localStorage["registro-cisp.direccionIE"]);
    if(localStorage["registro-cisp.telefonoIE"] && localStorage["registro-cisp.telefonoIE"] != 'undefined') $("#telefonoIE").val(localStorage["registro-cisp.telefonoIE"]);
    if(localStorage["registro-cisp.emailIE"] && localStorage["registro-cisp.emailIE"] != 'undefined') $("#emailIE").val(localStorage["registro-cisp.emailIE"]);
    if(localStorage["registro-cisp.nombres"] && localStorage["registro-cisp.nombres"] != 'undefined') $("#nombres").val(localStorage["registro-cisp.nombres"]);
    if(localStorage["registro-cisp.apellidos"] && localStorage["registro-cisp.apellidos"] != 'undefined') $("#apellidos").val(localStorage["registro-cisp.apellidos"]);
    if(localStorage["registro-cisp.cargo"] && localStorage["registro-cisp.cargo"] != 'undefined') $("#cargo").val(localStorage["registro-cisp.cargo"]);
    if(localStorage["registro-cisp.area"] && localStorage["registro-cisp.area"] != 'undefined') $("#area").val(localStorage["registro-cisp.area"]);
    if(localStorage["registro-cisp.grado"] && localStorage["registro-cisp.grado"] != 'undefined') $("#grado").val(localStorage["registro-cisp.grado"]);
    if(localStorage["registro-cisp.direccion"] && localStorage["registro-cisp.direccion"] != 'undefined') $("#direccion").val(localStorage["registro-cisp.direccion"]);
    if(localStorage["registro-cisp.telefono"] && localStorage["registro-cisp.telefono"] != 'undefined') $("#telefono").val(localStorage["registro-cisp.telefono"]);
    if(localStorage["registro-cisp.email"] && localStorage["registro-cisp.email"] != 'undefined') $("#email").val(localStorage["registro-cisp.email"]);
    if(localStorage["registro-cisp.descripcionperfil"] && localStorage["registro-cisp.descripcionperfil"] != 'undefined') $("#descripcionperfil").val(localStorage["registro-cisp.descripcionperfil"]);
    if(localStorage["registro-cisp.nombreIP"] && localStorage["registro-cisp.nombreIP"] != 'undefined') $("#nombreIP").val(localStorage["registro-cisp.nombreIP"]);
    if(localStorage["registro-cisp.nivelIP"] && localStorage["registro-cisp.nivelIP"] != 'undefined') $("#nivelIP").val(localStorage["registro-cisp.nivelIP"]);
    if(localStorage["registro-cisp.otroNivelIP"] && localStorage["registro-cisp.otroNivelIP"] != 'undefined') $("#otroNivelIP").val(localStorage["registro-cisp.otroNivelIP"]);
    /*
    if(localStorage["registro-cisp.poblacionIP_estudiantes"]) $('input[name="poblacionIP_estudiantes"').val(localStorage["registro-cisp.poblacionIP_estudiantes"]);
    if(localStorage["registro-cisp.poblacionIP_docentes"]) $('input[name="poblacionIP_docentes"').val(localStorage["registro-cisp.poblacionIP_docentes"]);
    if(localStorage["registro-cisp.poblacionIP_directivas"]) $('input[name="poblacionIP_directivas"').val(localStorage["registro-cisp.poblacionIP_directivas"]);
    if(localStorage["registro-cisp.poblacionIP_padres"]) $('input[name="poblacionIP_padres"').val(localStorage["registro-cisp.poblacionIP_padres"]);
    if(localStorage["registro-cisp.poblacionIP_miembros"]) $('input[name="poblacionIP_miembros"').val(localStorage["registro-cisp.poblacionIP_miembros"]);
    if(localStorage["registro-cisp.poblacionIP_otros"]) $('input[name="poblacionIP_otros"').val(localStorage["registro-cisp.poblacionIP_otros"]);
    */
    if(localStorage["registro-cisp.poblacionIP_otrosTexto"] && localStorage["registro-cisp.poblacionIP_otrosTexto"] != 'undefined') $("#poblacionIP_otrosTexto").val(localStorage["registro-cisp.poblacionIP_otrosTexto"]);
    if(localStorage["registro-cisp.poblacionIP_estudiantesCant"] && localStorage["registro-cisp.poblacionIP_estudiantesCant"] != 'undefined') $("#poblacionIP_estudiantesCant").val(localStorage["registro-cisp.poblacionIP_estudiantesCant"]);
    if(localStorage["registro-cisp.poblacionIP_docentesCant"] && localStorage["registro-cisp.poblacionIP_docentesCant"] != 'undefined') $("#poblacionIP_docentesCant").val(localStorage["registro-cisp.poblacionIP_docentesCant"]);
    if(localStorage["registro-cisp.poblacionIP_directivasCant"] && localStorage["registro-cisp.poblacionIP_directivasCant"] != 'undefined') $("#poblacionIP_directivasCant").val(localStorage["registro-cisp.poblacionIP_directivasCant"]);
    if(localStorage["registro-cisp.poblacionIP_padresCant"] && localStorage["registro-cisp.poblacionIP_padresCant"] != 'undefined') $("#poblacionIP_padresCant").val(localStorage["registro-cisp.poblacionIP_padresCant"]);
    if(localStorage["registro-cisp.poblacionIP_miembrosCant"] && localStorage["registro-cisp.poblacionIP_miembrosCant"] != 'undefined') $("#poblacionIP_miembrosCant").val(localStorage["registro-cisp.poblacionIP_miembrosCant"]);
    if(localStorage["registro-cisp.poblacionIP_otrosCant"] && localStorage["registro-cisp.poblacionIP_otrosCant"] != 'undefined') $("#poblacionIP_otrosCant").val(localStorage["registro-cisp.poblacionIP_otrosCant"]);
    if(localStorage["registro-cisp.tiempoIP"] && localStorage["registro-cisp.tiempoIP"] != 'undefined') $("#tiempoIP").val(localStorage["registro-cisp.tiempoIP"]);
    if(localStorage["registro-cisp.resumenIP"] && localStorage["registro-cisp.resumenIP"] != 'undefined') $("#resumenIP").val(localStorage["registro-cisp.resumenIP"]);
    if(localStorage["registro-cisp.contextoIP"] && localStorage["registro-cisp.contextoIP"] != 'undefined') $("#contextoIP").val(localStorage["registro-cisp.contextoIP"]);
    if(localStorage["registro-cisp.justificacionIP"] && localStorage["registro-cisp.justificacionIP"] != 'undefined') $("#justificacionIP").val(localStorage["registro-cisp.justificacionIP"]);
    if(localStorage["registro-cisp.marcoIP"] && localStorage["registro-cisp.marcoIP"] != 'undefined') $("#marcoIP").val(localStorage["registro-cisp.marcoIP"]);
    if(localStorage["registro-cisp.objetivosIP"] && localStorage["registro-cisp.objetivosIP"] != 'undefined') $("#objetivosIP").val(localStorage["registro-cisp.objetivosIP"]);
    if(localStorage["registro-cisp.metodologiaIP"] && localStorage["registro-cisp.metodologiaIP"] != 'undefined') $("#metodologiaIP").val(localStorage["registro-cisp.metodologiaIP"]);
    if(localStorage["registro-cisp.seguimientoIP"] && localStorage["registro-cisp.seguimientoIP"] != 'undefined') $("#seguimientoIP").val(localStorage["registro-cisp.seguimientoIP"]);
    if(localStorage["registro-cisp.monitoreoIP"] && localStorage["registro-cisp.monitoreoIP"] != 'undefined') $("#monitoreoIP").val(localStorage["registro-cisp.monitoreoIP"]);
    if(localStorage["registro-cisp.proyeccionIP"] && localStorage["registro-cisp.proyeccionIP"] != 'undefined') $("#proyeccionIP").val(localStorage["registro-cisp.proyeccionIP"]);

    if(localStorage["registro-cisp.pais"] && localStorage["registro-cisp.pais"] != 'Seleccione el país') {
       if($('select#pais option:first').val() == 'Seleccione el país') {
           $('select#departamento').removeAttr('disabled');
           $('select#municipio').removeAttr('disabled');
           $('select#pais option:first').remove();
       }
       $("#pais").val(localStorage["registro-cisp.pais"]);
       pais = localStorage["registro-cisp.pais"];
       cambiaPais(false);
       if(localStorage["registro-cisp.departamento"] && localStorage["registro-cisp.departamento"] != 'Seleccione el país para activar esta opción') {
           $("#departamento").val(localStorage["registro-cisp.departamento"]);
           departamento = localStorage["registro-cisp.departamento"];
           cambiaDepto();
           if(localStorage["registro-cisp.municipio"] && localStorage["registro-cisp.municipio"] != 'Seleccione el departamento para activar esta opción') {
               $("#municipio").val(localStorage["registro-cisp.municipio"]);
               municipio = localStorage["registro-cisp.municipio"];
           }
       }
    }
    if(localStorage["zonaIE"] && localStorage["zonaIE"] != 'undefined') $('#'+localStorage["zonaIE"]).prop('checked',true);
    if(localStorage["nivelIP"] && localStorage["nivelIP"] != 'undefined') {
        $('#'+localStorage["nivelIP"]).prop('checked',true);
        habilitaNivelIP();
    }
    if(localStorage["tiempoIP"] && localStorage["tiempoIP"] != 'undefined') $('#'+localStorage["tiempoIP"]).prop('checked',true);
    if(localStorage["poblacionIP_estudiantes"] && localStorage["poblacionIP_estudiantes"] != 'undefined') $('input[value="poblacionIP_estudiantes"]').prop('checked',true);
    if(localStorage["poblacionIP_docentes"] && localStorage["poblacionIP_docentes"] != 'undefined') $('input[value="poblacionIP_docentes"]').prop('checked',true);
    if(localStorage["poblacionIP_directivas"] && localStorage["poblacionIP_directivas"] != 'undefined') $('input[value="poblacionIP_directivas"]').prop('checked',true);
    if(localStorage["poblacionIP_padres"] && localStorage["poblacionIP_padres"] != 'undefined') $('input[value="poblacionIP_padres"]').prop('checked',true);
    if(localStorage["poblacionIP_miembros"] && localStorage["poblacionIP_miembros"] != 'undefined') $('input[value="poblacionIP_miembros"]').prop('checked',true);
    if(localStorage["poblacionIP_otros"] && localStorage["poblacionIP_otros"] != 'undefined') $('input[value="poblacionIP_otros"]').prop('checked',true);
    habilitaPoblacionIP();
    $('#guardando').hide();
}

function guardarDatos(){
    $('#guardando > span').html('Almacenando datos temporalmente...');
    $('#guardando').css('right', '20px');
    $('#guardando').show();
    localStorage["registro-cisp.pais"] = $("#pais").val();
    localStorage["registro-cisp.departamento"] = $("#departamento").val();
    localStorage["registro-cisp.municipio"] = $("#municipio").val();
    localStorage["zonaIE"] = $('input[name="zonaIE"]:checked').val();
    localStorage["nivelIP"] = $('input[name="nivelIP"]:checked').val();
    localStorage["tiempoIP"] = $('input[name="tiempoIP"]:checked').val();
    localStorage.removeItem("poblacionIP_estudiantes");
    localStorage.removeItem("poblacionIP_docentes");
    localStorage.removeItem("poblacionIP_directivas");
    localStorage.removeItem("poblacionIP_padres");
    localStorage.removeItem("poblacionIP_miembros");
    localStorage.removeItem("poblacionIP_otros");
    if($('input[name="poblacionIP_estudiantes"]:checked').length) localStorage["poblacionIP_estudiantes"] = $('input[value="poblacionIP_estudiantes"]').val();
    if($('input[name="poblacionIP_docentes"]:checked').length) localStorage["poblacionIP_docentes"] = $('input[value="poblacionIP_docentes"]').val();
    if($('input[name="poblacionIP_directivas"]:checked').length) localStorage["poblacionIP_directivas"] = $('input[value="poblacionIP_directivas"]').val();
    if($('input[name="poblacionIP_padres"]:checked').length) localStorage["poblacionIP_padres"] = $('input[value="poblacionIP_padres"]').val();
    if($('input[name="poblacionIP_miembros"]:checked').length) localStorage["poblacionIP_miembros"] = $('input[value="poblacionIP_miembros"]').val();
    if($('input[name="poblacionIP_otros"]:checked').length) localStorage["poblacionIP_otros"] = $('input[value="poblacionIP_otros"]').val();

    localStorage["registro-cisp.nombreIE"] = $("#nombreIE").val();
    localStorage["registro-cisp.zonaIE"] = $("#zonaIE").val();
    localStorage["registro-cisp.direccionIE"] = $("#direccionIE").val();
    localStorage["registro-cisp.telefonoIE"] = $("#telefonoIE").val();
    localStorage["registro-cisp.emailIE"] = $("#emailIE").val();
    localStorage["registro-cisp.nombres"] = $("#nombres").val();
    localStorage["registro-cisp.apellidos"] = $("#apellidos").val();
    localStorage["registro-cisp.cargo"] = $("#cargo").val();
    localStorage["registro-cisp.area"] = $("#area").val();
    localStorage["registro-cisp.grado"] = $("#grado").val();
    localStorage["registro-cisp.direccion"] = $("#direccion").val();
    localStorage["registro-cisp.telefono"] = $("#telefono").val();
    localStorage["registro-cisp.email"] = $("#email").val();
    localStorage["registro-cisp.descripcionperfil"] = $("#descripcionperfil").val();
    localStorage["registro-cisp.nombreIP"] = $("#nombreIP").val();
    localStorage["registro-cisp.nivelIP"] = $("#nivelIP").val();
    localStorage["registro-cisp.otroNivelIP"] = $("#otroNivelIP").val();
    localStorage["registro-cisp.poblacionIP_otrosTexto"] = $("#poblacionIP_otrosTexto").val();
    localStorage["registro-cisp.poblacionIP_estudiantesCant"] = $("#poblacionIP_estudiantesCant").val();
    localStorage["registro-cisp.poblacionIP_docentesCant"] = $("#poblacionIP_docentesCant").val();
    localStorage["registro-cisp.poblacionIP_directivasCant"] = $("#poblacionIP_directivasCant").val();
    localStorage["registro-cisp.poblacionIP_padresCant"] = $("#poblacionIP_padresCant").val();
    localStorage["registro-cisp.poblacionIP_miembrosCant"] = $("#poblacionIP_miembrosCant").val();
    localStorage["registro-cisp.poblacionIP_otrosCant"] = $("#poblacionIP_otrosCant").val();
    localStorage["registro-cisp.tiempoIP"] = $("#tiempoIP").val();
    localStorage["registro-cisp.resumenIP"] = $("#resumenIP").val();
    localStorage["registro-cisp.contextoIP"] = $("#contextoIP").val();
    localStorage["registro-cisp.justificacionIP"] = $("#justificacionIP").val();
    localStorage["registro-cisp.marcoIP"] = $("#marcoIP").val();
    localStorage["registro-cisp.objetivosIP"] = $("#objetivosIP").val();
    localStorage["registro-cisp.metodologiaIP"] = $("#metodologiaIP").val();
    localStorage["registro-cisp.seguimientoIP"] = $("#seguimientoIP").val();
    localStorage["registro-cisp.monitoreoIP"] = $("#monitoreoIP").val();
    localStorage["registro-cisp.proyeccionIP"] = $("#proyeccionIP").val();
    $('#guardando').hide();
}
function borrarDatos(){
    localStorage.removeItem("registro-cisp.pais");
    localStorage.removeItem("registro-cisp.departamento");
    localStorage.removeItem("registro-cisp.municipio");
    localStorage.removeItem("zonaIE");
    localStorage.removeItem("nivelIP");
    localStorage.removeItem("tiempoIP");
    localStorage.removeItem("poblacionIP_estudiantes");
    localStorage.removeItem("poblacionIP_docentes");
    localStorage.removeItem("poblacionIP_directivas");
    localStorage.removeItem("poblacionIP_padres");
    localStorage.removeItem("poblacionIP_miembros");
    localStorage.removeItem("poblacionIP_otros");
    localStorage.removeItem("poblacionIP");
    //
    localStorage.removeItem("registro-cisp.nombreIE");
    localStorage.removeItem("registro-cisp.zonaIE");
    localStorage.removeItem("registro-cisp.direccionIE");
    localStorage.removeItem("registro-cisp.telefonoIE");
    localStorage.removeItem("registro-cisp.emailIE");
    localStorage.removeItem("registro-cisp.nombres");
    localStorage.removeItem("registro-cisp.apellidos");
    localStorage.removeItem("registro-cisp.cargo");
    localStorage.removeItem("registro-cisp.area");
    localStorage.removeItem("registro-cisp.grado");
    localStorage.removeItem("registro-cisp.direccion");
    localStorage.removeItem("registro-cisp.telefono");
    localStorage.removeItem("registro-cisp.email");
    localStorage.removeItem("registro-cisp.descripcionperfil");
    localStorage.removeItem("registro-cisp.nombreIP");
    localStorage.removeItem("registro-cisp.nivelIP");
    localStorage.removeItem("registro-cisp.otroNivelIP");
    localStorage.removeItem("poblacionIP_estudiantes");
    localStorage.removeItem("poblacionIP_docentes");
    localStorage.removeItem("poblacionIP_directivas");
    localStorage.removeItem("poblacionIP_padres");
    localStorage.removeItem("poblacionIP_miembros");
    localStorage.removeItem("poblacionIP_otros");
    localStorage.removeItem("registro-cisp.poblacionIP_otrosTexto");
    localStorage.removeItem("registro-cisp.poblacionIP_estudiantesCant");
    localStorage.removeItem("registro-cisp.poblacionIP_docentesCant");
    localStorage.removeItem("registro-cisp.poblacionIP_directivasCant");
    localStorage.removeItem("registro-cisp.poblacionIP_padresCant");
    localStorage.removeItem("registro-cisp.poblacionIP_miembrosCant");
    localStorage.removeItem("registro-cisp.poblacionIP_otrosCant");
    localStorage.removeItem("registro-cisp.tiempoIP");
    localStorage.removeItem("registro-cisp.resumenIP");
    localStorage.removeItem("registro-cisp.contextoIP");
    localStorage.removeItem("registro-cisp.justificacionIP");
    localStorage.removeItem("registro-cisp.marcoIP");
    localStorage.removeItem("registro-cisp.objetivosIP");
    localStorage.removeItem("registro-cisp.metodologiaIP");
    localStorage.removeItem("registro-cisp.seguimientoIP");
    localStorage.removeItem("registro-cisp.monitoreoIP");
    localStorage.removeItem("registro-cisp.proyeccionIP");
    localStorage.removeItem("registro-cisp.anexoIP1");
    localStorage.removeItem("registro-cisp.anexoIP2");
    localStorage.removeItem("registro-cisp.anexoIP3");
}
/*
                                                                                
function nuevaFila(objeto){
    var salida = "";
    if(numPlanDeAccion != 0){
        $(objeto).addClass('oculto').parent().children('.eliminar').removeClass('oculto');
    } else {
        $(objeto).addClass('oculto');
    }
    numPlanDeAccion++;
    for (var i = 0;i<htmlPlanDeAccion.length-1;i++) {
        salida += htmlPlanDeAccion[i]+numPlanDeAccion;
    }
    salida += htmlPlanDeAccion[htmlPlanDeAccion.length-1];
    if (numPlanDeAccion % 2){
        salida = $(salida).removeClass('filaPar').addClass('filaImpar');
    }
    planDeAccion.push(salida);    
    $(objeto).parent().parent().parent().append(planDeAccion[numPlanDeAccion]);
    $('#plandeaccion'+numPlanDeAccion+' button.anadir').click(function() {
        nuevaFila(this);
    });
    $('#plandeaccion'+numPlanDeAccion+' button.eliminar').click(function() {
        eliminarFila(this);
    });
}
 */