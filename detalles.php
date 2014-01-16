<?php
if (isset($_GET['id']) && !isset($_GET['accion'])){
	$estados = array("<span class=\"label label-default\"><i class=\"fa fa-circle-o\"></i> Pendiente de aprobación</span>",
					"<span class=\"label label-success\"><i class=\"fa fa-check-circle-o\"></i> Aprobada</span>",
					"<span class=\"label label-danger\"><i class=\"fa fa-ban\"></i> Descartada</span>");
	$notificado = array("<span class=\"label label-warning\"><i class=\"fa fa-envelope-o\"></i> Sin notificar</span>",
					"<span class=\"label label-success\"><i class=\"fa fa-envelope\"></i> Notificado</span>");
	require_once 'lib/config.php';
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	$query = "SELECT * FROM `registrodocentes` WHERE `id`='".$_GET['id']."'";
	$resultado = $mysqli->query($query);
	$datos = $resultado->fetch_assoc();
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Iniciativa registrada por <?php echo $datos['nombres']." ".$datos['apellidos']; ?></h4>
		</div><!-- /.modal-header -->
		<div class="modal-body">
			<?php echo $estados[$datos['estado']]." ".$notificado[$datos['notificado']]; ?>
			<br><br>
			<ul class="nav nav-tabs" id="secciones">
				<li class="active"><a href="#datosIE" data-toggle="tab">Datos Institución Educativa</a></li>
				<li><a href="#datosDoc" data-toggle="tab">Datos docente</a></li>
				<li><a href="#resumenIP" data-toggle="tab">Resumen Iniciativa Pedagógica</a></li>
				<li><a href="#descIP" data-toggle="tab">Descripción Iniciativa Pedagógica</a></li>
				<li><a href="#adjuntos" data-toggle="tab">Archivos adjuntos</a></li>
			</ul><!-- /.nav .nav-tabs -->
			<div class="tab-content">
				<div class="tab-pane fade in active" id="datosIE">
					<div class="page-header">
						<h4>Datos de la Institución Educativa</h4>
					</div>
				    <div class="container">
						<div class="row">
							<div class="col-lg-12 well well-sm">
		    					<strong>Nombre de la Institución Educativa (IE)</strong>
		    					<h4><strong><?php echo $datos['nombreIE']; ?></strong></h4>
		  					</div>
	  					</div><!-- /.row -->
		    			<div class="row">
		    				<div class="col-lg-3 well well-sm">
		    					<strong>País</strong>
		    					<h4><strong><?php echo $datos['pais']; ?></strong></h4>
		    				</div><!-- /.col-lg-3 -->
	    					<div class="col-lg-3 well well-sm">
	    						<strong>Departamento/Provincia/Estado</strong>
	    						<h4><strong><?php echo $datos['departamento']; ?></strong></h4>
	    					</div><!-- /.col-lg-3 -->
	    					<div class="col-lg-3 well well-sm">
	    						<strong>Municipio/Ciudad</strong>
    							<h4><strong><?php echo $datos['municipio']; ?></strong></h4>
	    					</div><!-- /.col-lg-3 -->
	    					<div class="col-lg-3 well well-sm">
	    						<strong>Tipo de zona</strong>
								<h4><strong>Zona <?php echo $datos['zonaIE']; ?></strong></h4>
	    					</div><!-- /.col-lg-3 -->
	    				</div><!-- /.row -->
	    				<div class="row">
	    					<div class="col-lg-4 well well-sm">
			    				<strong>Dirección</strong>
			    				<h4><strong><?php echo $datos['direccionIE']; ?></strong></h4>
	    					</div><!-- /.col-lg-4 -->
	    					<div class="col-lg-4 well well-sm">
			    				<strong>Teléfono</strong>
			    				<h4><strong><?php echo $datos['telefonoIE']; ?></strong></h4>
	    					</div><!-- /.col-lg-4 -->
	    					<div class="col-lg-4 well well-sm">
			    				<strong>Correo electrónico</strong>
			    				<h4><strong><?php echo $datos['emailIE']; ?></strong></h4>
	    					</div><!-- /.col-lg-4 -->
	    				</div><!-- /.row -->
    				</div><!-- /.container -->
				</div>
				<div class="tab-pane fade" id="datosDoc">
					<div class="page-header">
						<h4>Datos del docente que registró la Iniciativa Pedagógica</h4>
					</div>
				    <div class="container">
						<div class="row">
		    				<div class="col-lg-6 well well-sm">
			    				<strong>Nombres</strong>
			    				<h4><strong><?php echo $datos['nombres']; ?></strong></h4>
		  					</div><!-- /.col-lg-6 -->
		    				<div class="col-lg-6 well well-sm">
			    				<strong>Apellidos</strong>
			    				<h4><strong><?php echo $datos['apellidos']; ?></strong></h4>
		  					</div><!-- /.col-lg-6 -->
	  					</div><!-- /.row -->
		  				<div class="row">
		    				<div class="col-lg-4 well well-sm">
			    				<strong>Cargo/s</strong>
			    				<h4><strong><?php echo $datos['cargo']; ?></strong></h4>
		  					</div><!-- /.col-lg-4 -->
		    				<div class="col-lg-4 well well-sm">
			    				<strong>Área de Conocimiento</strong>
			    				<h4><strong><?php echo $datos['area']; ?></strong></h4>
		  					</div><!-- /.col-lg-4 -->
		    				<div class="col-lg-4 well well-sm">
			    				<strong>Grado/s a cargo</strong>
			    				<h4><strong><?php echo $datos['grado']; ?></strong></h4>
		  					</div><!-- /.col-lg-4 -->
	  					</div><!-- /.row -->
	    				<div class="row">
	    					<div class="col-lg-4 well well-sm">
			    				<strong>Dirección Residencia</strong>
			    				<h4><strong><?php echo $datos['direccion']; ?></strong></h4>
	    					</div><!-- /.col-lg-4 -->
	    					<div class="col-lg-4 well well-sm">
			    				<strong>Teléfono fijo / Celular</strong>
			    				<h4><strong><?php echo $datos['telefono']; ?></strong></h4>
	    					</div><!-- /.col-lg-4 -->
	    					<div class="col-lg-4 well well-sm">
			    				<strong>Correo electrónico</strong>
			    				<h4><strong><?php echo $datos['email']; ?></strong></h4>
	    					</div><!-- /.col-lg-4 -->
	    				</div><!-- /.row -->
	    				<div class="row">
				    		<div class="col-lg-12 well well-sm">
				    			<strong>Descripción del perfil</strong>
			    				<p><?php echo $datos['descripcionperfil']; ?></p>
		    				</div>
	    				</div><!-- /.row -->
    				</div><!-- /.container -->
				</div>
				<div class="tab-pane fade" id="resumenIP">
					<div class="page-header">
						<h4>Resumen de la Iniciativa Pedagógica</h4>
					</div>
				    <div class="container">
						<div class="row">
		    				<div class="col-lg-12 well well-sm">
					    		<strong>Nombre de la Iniciativa</strong>
			    				<h4><strong><?php echo $datos['nombreIP']; ?></strong></h4>
		    				</div><!-- /.col-lg-12 -->
		    			</div><!-- /.row -->
		    			<div class="row">
		    				<div class="col-lg-4 well well-sm">
	    						<strong>Nivel en que se ejecuta la iniciativa</strong>
			    				<h4><strong><?php echo $datos['nivelIP']; ?></strong></h4>
			    				<h4><strong><?php echo $datos['otroNivelIP']; ?></strong></h4>
		    				</div><!-- /.col-lg-4 -->
		    				<div class="col-lg-4 well well-sm">
		    					<strong>Población hacia la que se dirige la iniciativa</strong>
		    					<h4><strong><?php if ($datos['poblacionIP_estudiantes'] == '1') { echo "Estudiantes: ".$datos['poblacionIP_estudiantesCant']; } ?></strong></h4>
		    					<h4><strong><?php if ($datos['poblacionIP_docentes'] == '1') { echo "Docentes: ".$datos['poblacionIP_docentesCant']; } ?></strong></h4>
		    					<h4><strong><?php if ($datos['poblacionIP_directivas'] == '1') { echo "Directivas: ".$datos['poblacionIP_directivasCant']; } ?></strong></h4>
		    					<h4><strong><?php if ($datos['poblacionIP_padres'] == '1') { echo "Padres de Familia: ".$datos['poblacionIP_padresCant']; } ?></strong></h4>
		    					<h4><strong><?php if ($datos['poblacionIP_miembros'] == '1') { echo "Personas de la Comunidad: ".$datos['poblacionIP_miembrosCant']; } ?></strong></h4>
		    					<h4><strong><?php if ($datos['poblacionIP_otros'] == '1') { echo $datos['poblacionIP_otrosTexto'].": ".$datos['poblacionIP_otrosCant']; } ?></strong></h4>
							</div><!-- /.col-lg-4 -->
		    				<div class="col-lg-4 well well-sm">
		    					<strong>Tiempo de ejecución</strong>
		    					<h4><strong>
		    						<?php
		    							if ($datos['tiempoIP'] == 'planificacion')
		    								echo "Está en su fase de planificación todavía";
		    							if ($datos['tiempoIP'] == 'menos1')
		    								echo "Menos de 1 año";
		    							if ($datos['tiempoIP'] == '1y2')
		    								echo "Entre 1 año y 2 años";
		    							if ($datos['tiempoIP'] == '2y3')
		    								echo "Entre 2 años y 3 años";
		    							if ($datos['tiempoIP'] == 'mas3')
		    								echo "Más de 3 años";
		    						?>
	    						</strong></h4>
		    				</div><!-- /.col-lg-4 -->
		    			</div><!-- /.row -->
		    			<div class="row">
		    				<div class="col-lg-12 well well-sm">
				    			<strong>Resumen</strong>
				    			<p><?php echo $datos['resumenIP']; ?></p>
		    				</div><!-- /.col-lg-12 -->
		    			</div><!-- /.row -->
    				</div><!-- /.container -->
				</div>
				<div class="tab-pane fade" id="descIP">
					<div class="page-header">
						<h4>Descripción de la Iniciativa Pedagógica</h4>
					</div>
				    <div class="container">
						<div class="row">
		    				<div class="col-md-12 well well-sm">
		    					<strong>Descripción de la situación o contexto</strong>
				    			<p><?php echo $datos['contextoIP']; ?></p>
	    					</div><!-- /.col-md-12 -->
		    				<div class="col-md-12 well well-sm">
		    					<strong>Justificación</strong>
				    			<p><?php echo $datos['justificacionIP']; ?></p>
	    					</div><!-- /.col-md-12 -->
		    				<div class="col-md-12 well well-sm">
		    					<strong>Marco conceptual</strong>
				    			<p><?php echo $datos['marcoIP']; ?></p>
	    					</div><!-- /.col-md-12 -->
		    				<div class="col-md-12 well well-sm">
		    					<strong>Objetivos</strong>
				    			<p><?php echo $datos['objetivosIP']; ?></p>
	    					</div><!-- /.col-md-12 -->
		    				<div class="col-md-12 well well-sm">
		    					<strong>Metodología</strong>
				    			<p><?php echo $datos['metodologiaIP']; ?></p>
	    					</div><!-- /.col-md-12 -->
		    				<div class="col-md-12 well well-sm">
		    					<strong>Seguimiento, evaluación y monitoreo</strong>
				    			<p><?php echo $datos['seguimientoIP']; ?></p>
	    					</div><!-- /.col-md-12 -->
		    				<div class="col-md-12 well well-sm">
		    					<strong>Proyección</strong>
				    			<p><?php echo $datos['proyeccionIP']; ?></p>
		    				</div><!-- /.col-md-12 -->
		    			</div><!-- /.row -->
    				</div><!-- /.container -->
				</div>
				<div class="tab-pane fade" id="adjuntos">
					<div class="page-header">
						<h4>Archivos adjuntos a la propuesta  
							<small>
								<?php
									if ($datos['anexoIP1'] || $datos['anexoIP2'] || $datos['anexoIP3']) {
										echo "Haga clic en cada vínculo para descargarlo.";
									} else {
										echo "Esta iniciativa no incluye documentos adjuntos.";
									}
								?>
							</small>
						</h4>
					</div>
				    <div class="container">
						<div class="row">
		    				<div class="col-lg-4 well well-sm">
				    			<a href="uploads/<?php echo $datos['anexoIP1']; ?>" target="_blank"><?php echo $datos['anexoIP1']; ?></a>
		    				</div><!-- /.col-lg-4 -->
		    				<div class="col-lg-4 well well-sm">
				    			<a href="uploads/<?php echo $datos['anexoIP2']; ?>" target="_blank"><?php echo $datos['anexoIP2']; ?></a>
		    				</div><!-- /.col-lg-4 -->
		    				<div class="col-lg-4 well well-sm">
				    			<a href="uploads/<?php echo $datos['anexoIP3']; ?>" target="_blank"><?php echo $datos['anexoIP3']; ?></a>
		    				</div><!-- /.col-lg-4 -->
		    			</div><!-- /.row -->
    				</div><!-- /.container -->
				</div>
			</div><!-- /.tab-content -->
		</div><!-- /.modal-body -->
		<div class="modal-footer">
			<button id="aprobar" data-dismiss="modal" type="button" class="btn btn-success"><i class="fa fa-check-circle-o fa-lg"></i> Aprobar IP</button>
			<button id="descartar" data-dismiss="modal" type="button" class="btn btn-danger"><i class="fa fa-ban fa-lg"></i> Descartar IP</button>
			<button id="pendiente" data-dismiss="modal" type="button" class="btn btn-default"><i class="fa fa-circle-o fa-lg"></i> Dejar IP pendiente</button>
		</div><!-- /.modal-footer -->
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php
	$mysqli->close();
} elseif (isset($_GET['id']) && isset($_GET['accion'])) {
	$estado['aprobar'] = "1";
	$estado['descartar'] = "2";
	$estado['pendiente'] = "0";
	require_once 'lib/config.php';
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	$query = "UPDATE `registrodocentes` SET `estado`='".$estado[$_GET['accion']]."' WHERE `id`='".$_GET['id']."'";
	if ($resultado = $mysqli->query($query)) {
		echo json_encode(array("resultado"=>true, "id"=>$_GET['id']));
	} else {
		echo json_encode(array("resultado"=>false, "id"=>$_GET['id']));
	}
}
?>