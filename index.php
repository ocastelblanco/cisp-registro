<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de registro para el curso CIUDADANÍAS de CISP">
    <meta name="author" content="Oliver Castelblanco M. para CISP">
    <link rel="shortcut icon" href="ico/favicon.png">
    <title>Ficha de convocatoria de docentes - CIUDADANÍAS</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Estilos propios -->
    <link href="css/registro-cisp.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->	
  </head>

  <body data-spy="scroll" data-target="#navegacion" data-offset="80">
  
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Abrir/cerrar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#instrucciones"><img src="img/ciudadanias.png" class="img-responsive"></a>
        </div>
        <div id="navegacion" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#ie">Datos de la Institución Educativa</a></li>
            <li><a href="#docente">Datos del docente</a></li>
            <li><a href="#ip">Iniciativa pedagógica</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    <div id="instrucciones" class="page-header">
		<h1>Ficha de convocatoria</h1>
		<p>A continuación encontrará una ficha que le solicitamos diligenciar sobre su iniciativa pedagógica.</p>
		<p>Agradecemos anexar cualquier material concerniente a la iniciativa pedagógica, como archivos adjuntos.</p>
		<p>Si tiene dudas sobre el diligenciamiento de este formulario, escíbanos a: <a href="mailto:cursociudadanias@gmail.com">cursociudadanias@gmail.com</a></p>
    </div><!-- /.page-header -->
	<form role="form" id="formulario" method="post" action="registro.php" enctype="multipart/form-data">
	    <div class="container">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
			    	<div id="ie" class="panel panel-primary">
			    		<div class="panel-heading"><strong>Datos de la Institución Educativa</strong></div>
			  			<div class="panel-body">
		    				<div class="form-group">
		    					<label for="nombreIE">Nombre de la Institución Educativa</label>
		    					<input type="text" class="form-control" name="nombreIE" id="nombreIE" placeholder="Ingrese el nombre de la Institución Educativa" required>
		  					</div>
		    				<div class="form-group">
		    					<label for="pais">País de la Institución Educativa</label>
		    					<select id="pais" name="pais" class="form-control">
									<option>Seleccione el país</option>
									<option>Argentina</option>
									<option>Bolivia</option>
									<option>Colombia</option>
									<option>Uruguay</option>
								</select>
		    				</div>
		    				<div class="row">
		    					<div class="col-md-5">
		    						<div class="form-group">
		    							<label for="departamento">Departamento/Provincia/Estado</label>
		    							<select id="departamento" name="departamento" class="form-control" disabled>
		    								<option>Seleccione el país para activar esta opción</option>
		    							</select>
		    						</div>
		    					</div><!-- /.col-md-5 -->
		    					<div class="col-md-5">
		    						<div class="form-group">
		    							<label for="municipio">Municipio/Ciudad</label>
		    							<select id="municipio" name="municipio" class="form-control" disabled>
		    								<option>Seleccione el departamento para activar esta opción</option>
		    							</select>
		    						</div>
		    					</div><!-- /.col-md-5 -->
		    					<div class="col-md-2">
		    						<div class="radio">
		    							<label>
		    								<input type="radio" name="zonaIE" id="Rural" value="Rural" checked>
		    								Zona rural
		    							</label>
		    						</div>
		    						<div class="radio">
		    							<label>
		    								<input type="radio" name="zonaIE" id="Urbana" value="Urbana">
		    								Zona urbana
		    							</label>
		    						</div>
		    					</div><!-- /.col-md-2 -->
		    				</div><!-- /.row -->
		    				<div class="row">
		    					<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="direccionIE">Dirección de la Institución Educativa</label>
				    					<input type="text" class="form-control" name="direccionIE" id="direccionIE" placeholder="Ingrese la dirección de la Institución Educativa" required>
				  					</div>
		    					</div><!-- /.col-md-4 -->
		    					<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="telefonoIE">Teléfono de la Institución Educativa</label>
				    					<input type="tel" class="form-control" name="telefonoIE" id="telefonoIE" placeholder="Ingrese el teléfono de la Institución Educativa" required>
				  					</div>
		    					</div><!-- /.col-md-4 -->
		    					<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="emailIE">Correo electrónico de la Institución Educativa</label>
				    					<input type="email" class="form-control" name="emailIE" id="emailIE" placeholder="Ingrese el correo electrónico de la Institución Educativa" required>
				  					</div>
		    					</div><!-- /.col-md-4 -->
		    				</div><!-- /.row -->
						</div><!-- /.panel-body -->
		    		</div><!-- /.panel #ie -->
			    	<div id="docente" class="panel panel-primary">
			    		<div class="panel-heading"><strong>Datos del docente</strong></div>
			  			<div class="panel-body">
			  				<div class="row">
			    				<div class="col-md-6">
				    				<div class="form-group">
				    					<label for="nombres">Nombres</label>
				    					<input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese sus nombres completos" required>
				  					</div>
			  					</div><!-- /.col-md-6 -->
			    				<div class="col-md-6">
				    				<div class="form-group">
				    					<label for="apellidos">Apellidos</label>
				    					<input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos completos" required>
				  					</div>
			  					</div><!-- /.col-md-6 -->
		  					</div><!-- /.row -->
			  				<div class="row">
			    				<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="cargo">Cargo/s</label>
				    					<input type="text" class="form-control" name="cargo" id="cargo" placeholder="Ingrese su/s cargo/s en la Institución Educativa" required>
				  					</div>
			  					</div><!-- /.col-md-4 -->
			    				<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="area">Área de Conocimiento</label>
				    					<input type="text" class="form-control" name="area" id="area" placeholder="Ingrese su Área de conocimiento" required>
				  					</div>
			  					</div><!-- /.col-md-4 -->
			    				<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="grado">Grado/s o Año/s a cargo</label>
				    					<input type="text" class="form-control" name="grado" id="grado" placeholder="Ingrese los grados o años a cargo" required>
				  					</div>
			  					</div><!-- /.col-md-4 -->
		  					</div><!-- /.row -->
		    				<div class="row">
		    					<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="direccion">Dirección Residencia</label>
				    					<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese la dirección de su residencia" required>
				  					</div>
		    					</div><!-- /.col-md-4 -->
		    					<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="telefono">Teléfono fijo / Celular</label>
				    					<input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Ingrese su teléfono fijo o celular" required>
				  					</div>
		    					</div><!-- /.col-md-4 -->
		    					<div class="col-md-4">
				    				<div class="form-group">
				    					<label for="email">Correo electrónico</label>
				    					<input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su correo electrónico" required>
				  					</div>
		    					</div><!-- /.col-md-4 -->
		    				</div><!-- /.row -->
				    		<div class="form-group">
				    			<label for="descripcionperfil">Descripción breve de su perfil<br><small>(Nivel de estudios, áreas de interés, trayectoria)</small></label>
		    					<textarea name="descripcionperfil" id="descripcionperfil" class="form-control" rows="5" placeholder="Describa su perfil" required></textarea>
		    				</div>
			  			</div><!-- /.panel-body -->
			  		</div><!-- /.panel #docente -->
			    	<div id="ip" class="panel panel-primary">
			    		<div class="panel-heading"><strong>Iniciativa Pedagógica</strong></div>
			  			<div class="panel-body">
			  				<div class="row">
			    				<div class="col-md-12">
						    		<div class="form-group">
						    			<label for="nombreIP">Nombre de la Iniciativa</label>
				    					<input type="text" class="form-control" name="nombreIP" id="nombreIP" placeholder="Ingrese el nombre de su Iniciativa pedagógica" required>
				    				</div>
			    				</div><!-- /.col-md-12 -->
			    			</div><!-- /.row -->
			    			<div class="row">
			    				<div class="col-md-6">
		    						<div class="row">
		    							<div class="col-md-12">
				    						<strong>Nivel en que se ejecuta la Iniciativa</strong>
			    						</div><!-- /.col-md-12 -->
		    							<div class="col-md-12">
				    						<div class="radio">
				    							<label>
				    								<input type="radio" name="nivelIP" id="Pre-escolar" value="Pre-escolar" checked>
				    								Pre-escolar
				    							</label>
				    						</div>
			    						</div><!-- /.col-md-12 -->
		    							<div class="col-md-12">
				    						<div class="radio">
				    							<label>
				    								<input type="radio" name="nivelIP" id="Primaria" value="Primaria">
				    								Primaria
				    							</label>
				    						</div>
			    						</div><!-- /.col-md-12 -->
		    							<div class="col-md-12">
				    						<div class="radio">
				    							<label>
				    								<input type="radio" name="nivelIP" id="Secundaria" value="Secundaria">
				    								Secundaria
				    							</label>
				    						</div>
			    						</div><!-- /.col-md-12 -->
		    							<div class="col-md-2">
				    						<div class="radio">
				    							<label>
				    								<input type="radio" name="nivelIP" id="Otro" value="Otro">
				    								Otro
				    							</label>
				    						</div>
				    					</div><!-- /.col-md-2 -->
				    					<div class="col-md-10">
					    					<input disabled type="text" class="form-control" name="otroNivelIP" id="otroNivelIP" placeholder="Ingrese el nombre del otro nivel educativo">
				    					</div><!-- /.col-md-10 -->
				    				</div><!-- /.row -->
			    				</div><!-- /.col-md-6 -->
			    				<div class="col-md-6">
			    					<div class="control-group" id="poblacionIP">
			    						<label class="control-label">Población hacia la que se dirige la iniciativa<br><small>(Puede señalar varias opciones. Por favor indique la cantidad aproximada.)</small></label>
			    						<div class="controls">
				    						<div class="row">
				    							<div class="col-md-6">
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="poblacionIP_estudiantes" value="poblacionIP_estudiantes">
															Estudiantes
														</label>
													</div>	
												</div><!-- /.col-md-6 -->
				    							<div class="col-md-3">
				    								<input disabled type="number" min="1" class="form-control" name="poblacionIP_estudiantesCant" id="poblacionIP_estudiantesCant" placeholder="Cantidad">
												</div><!-- /.col-md-3 -->
						    				</div><!-- /.row -->
				    						<div class="row">
				    							<div class="col-md-6">
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="poblacionIP_docentes" value="poblacionIP_docentes">
															Docentes
														</label>
													</div>
												</div><!-- /.col-md-6 -->
				    							<div class="col-md-3">
				    								<input disabled type="number" min="1" class="form-control" name="poblacionIP_docentesCant" id="poblacionIP_docentesCant" placeholder="Cantidad">
												</div><!-- /.col-md-3 -->
						    				</div><!-- /.row -->
				    						<div class="row">
				    							<div class="col-md-6">
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="poblacionIP_directivas" value="poblacionIP_directivas">
															Directivas
														</label>
													</div>
												</div><!-- /.col-md-6 -->
				    							<div class="col-md-3">
				    								<input disabled type="number" min="1" class="form-control" name="poblacionIP_directivasCant" id="poblacionIP_directivasCant" placeholder="Cantidad">
												</div><!-- /.col-md-3 -->
						    				</div><!-- /.row -->
				    						<div class="row">
				    							<div class="col-md-6">
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="poblacionIP_padres" value="poblacionIP_padres">
															Padres de Familia
														</label>
													</div>
												</div><!-- /.col-md-6 -->
				    							<div class="col-md-3">
				    								<input disabled type="number" min="1" class="form-control" name="poblacionIP_padresCant" id="poblacionIP_padresCant" placeholder="Cantidad">
												</div><!-- /.col-md-3 -->
						    				</div><!-- /.row -->
				    						<div class="row">
				    							<div class="col-md-6">
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="poblacionIP_miembros" value="poblacionIP_miembros">
															Personas de la Comunidad
														</label>
													</div>
												</div><!-- /.col-md-6 -->
				    							<div class="col-md-3">
				    								<input disabled type="number" min="1" class="form-control" name="poblacionIP_miembrosCant" id="poblacionIP_miembrosCant" placeholder="Cantidad">
												</div><!-- /.col-md-3 -->
						    				</div><!-- /.row -->
				    						<div class="row">
				    							<div class="col-md-2">
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="poblacionIP_otros" value="poblacionIP_otros">
															Otros
														</label>
													</div>
												</div><!-- /.col-md-2 -->
				    							<div class="col-md-7">
								    				<input disabled type="text" class="form-control" name="poblacionIP_otrosTexto" id="poblacionIP_otrosTexto" placeholder="Otro tipo de población">
												</div><!-- /.col-md-7 -->
				    							<div class="col-md-3">
				    								<input disabled type="number" min="1" class="form-control" name="poblacionIP_otrosCant" id="poblacionIP_otrosCant" placeholder="Cantidad">
												</div><!-- /.col-md-3 -->
						    				</div><!-- /.row -->
				    					</div><!-- /.controls -->
				    				</div><!-- /.control-group -->
			    				</div><!-- /.col-md-6 -->
			    			</div><!-- /.row -->
			    			<br><br>
			    			<div class="row">
			    				<div class="col-md-6">
			    					<strong>Tiempo de ejecución<br><small>¿Hace cuánto desarrolla esta iniciativa?</small></strong>
		    						<div class="radio">
		    							<label>
		    								<input type="radio" name="tiempoIP" id="planificacion" value="planificacion" checked>
		    								Está en su fase de planificación todavía
		    							</label>
		    						</div>
		    						<div class="radio">
		    							<label>
		    								<input type="radio" name="tiempoIP" id="menos1" value="menos1">
		    								Menos de 1 año
		    							</label>
		    						</div>
		    						<div class="radio">
		    							<label>
		    								<input type="radio" name="tiempoIP" id="1y2" value="1y2">
		    								Entre 1 año y 2 años
		    							</label>
		    						</div>
		    						<div class="radio">
		    							<label>
		    								<input type="radio" name="tiempoIP" id="2y3" value="2y3">
		    								Entre 2 años y 3 años
		    							</label>
		    						</div>
		    						<div class="radio">
		    							<label>
		    								<input type="radio" name="tiempoIP" id="mas3" value="mas3">
		    								Más de 3 años
		    							</label>
		    						</div>
			    				</div><!-- /.col-md-6 -->
			    				<div class="col-md-6">
					    			<div class="form-group">
						    			<label for="resumenIP">Resumen<br><small>Describa brevemente de qué se trata la iniciativa teniendo en cuenta lo siguiente: tema, objetivos, población con la que trabaja, resultados esperados y logrados, metodología utilizada, lecciones aprendidas.<br>Máximo 300 palabras.</small></label>
				    					<textarea id="resumenIP" name="resumenIP" class="form-control" rows="5" placeholder="Describa la iniciativa brevemente" required></textarea>
			    					</div>
			    				</div><!-- /.col-md-6 -->
			    			</div><!-- /.row -->
			    			<div class="row">
			    				<div class="col-md-12">
					    			<div class="form-group">
						    			<label for="contextoIP">Descripción de la situación o contexto<br><small>¿Cuál es la situación que ha dado origen a la iniciativa pedagógica?, ¿cuál es el escenario o el contexto donde se ha desarrollado dicha situación?. Indague los posibles factores asociados a la realidad que se ha abordado o busca abordar en esta propuesta pedagógica. Por favor, descríbalos.</small></label>
				    					<textarea name="contextoIP" id="contextoIP" class="form-control" rows="5" placeholder="Describa la situación o contexto"></textarea>
			    					</div>
					    			<div class="form-group oculto" id="antecedentesIP"><!-- Oculto temporalmente -->
						    			<label for="antecedentesIP">Antecedentes<br><small>Por favor describa brevemente la experiencia (actividades, aprendizajes, aciertos o logros, desafíos, etc.)</small></label>
				    					<textarea id="antecedentesIP" class="form-control" rows="5" placeholder="Describa los antecedentes"></textarea>
			    					</div>
					    			<div class="form-group">
						    			<label for="justificacionIP">Justificación<br><small>¿Por qué es interesante esta situación en particular?, ¿por qué se escogió?, ¿cuáles son las motivaciones para desarrollar una iniciativa pedagógica al respecto?</small></label>
				    					<textarea name="justificacionIP" id="justificacionIP" class="form-control" rows="5" placeholder="Describa la justificación"></textarea>
			    					</div>
					    			<div class="form-group">
						    			<label for="marcoIP">Marco conceptual<br><small>¿Cuáles son las bases pedagógicas, académicas y/o prácticas en las que se basa la iniciativa pedagógica?</small></label>
				    					<textarea name="marcoIP" id="marcoIP" class="form-control" rows="5" placeholder="Describa el marco conceptual"></textarea>
			    					</div>
					    			<div class="form-group">
						    			<label for="objetivosIP">Objetivos<br><small>¿Qué se quiere lograr con la iniciativa? ¿Qué aspectos de la situación se busca transformar?</small></label>
				    					<textarea name="objetivosIP" id="objetivosIP" class="form-control" rows="5" placeholder="Describa los objetivos"></textarea>
			    					</div>
					    			<div class="form-group">
						    			<label for="metodologiaIP">Metodología<br><small>¿Cómo se lleva a cabo la iniciativa pedagógica?, ¿qué estrategias pedagógicas y/o didácticas se han desarrollado para cumplir los propósitos?, ¿qué habilidades o desempeños específicos se busca desarrollar con estas estrategias?</small></label>
				    					<textarea name="metodologiaIP" id="metodologiaIP" class="form-control" rows="5" placeholder="Describa la metodología"></textarea>
			    					</div>
			    				</div><!-- /.col-md-12 -->
			    			</div><!-- /.row -->
			    			<div class="row">
			    			 <!-- Oculto temporalmente -->
			    				<div class="col-md-12 oculto" id="plandeaccion">
			    					<strong>Plan de Acción 2013<br><small>(Por favor, organice cronológicamente las actividades que ha desarrollado o planea desarrollar en el año 2013 y 2014 en el marco de la inicitiva)</small></strong>
			    					<br><br>
			    					<div class="row filaPar" id="plandeaccion0">
			    						<div class="col-md-12">
			    							<div class="row fila01">
					    						<div class="col-md-4">
					    							<div class="form-group">
						    							<label for="actividades0">ACTIVIDADES (Descripción)</label>
						    							<textarea id="actividades0" class="form-control" rows="2"></textarea>
					    							</div>
					    						</div><!-- /.col-md-4 -->
					    						<div class="col-md-4">
					    							<div class="form-group">
						    							<label for="metas0">METAS</label>
					    								<textarea id="metas0" class="form-control" rows="2"></textarea>
					    							</div>
					    						</div><!-- /.col-md-4 -->
					    						<div class="col-md-4">
					    							<div class="form-group">
						    							<label for="actores0">ACTORES INVOLUCRADOS</label>
					    								<textarea id="actores0" class="form-control" rows="2"></textarea>
					    							</div>
					    						</div><!-- /.col-md-4 -->
					    					</div><!-- /.row fila01 -->
			    							<div class="row fila02">
					    						<div class="col-md-4">
					    							<div class="form-group">
						    							<label for="disponibles0">RECURSOS DISPONIBLES</label>
					    								<textarea id="disponibles0" class="form-control" rows="2"></textarea>
					    							</div>
						    					</div><!-- /.col-md-4 -->
						    					<div class="col-md-4">
					    							<div class="form-group">
						    							<label for="nodisponibles0">RECURSOS NO DISPONIBLES</label>
					    								<textarea id="nodisponibles0" class="form-control" rows="2"></textarea>
					    							</div>
						    					</div><!-- /.col-md-4 -->
					    						<div class="col-md-4">
					    							<div class="form-group">
						    							<label for="cronograma0">CRONOGRAMA</label>
					    								<textarea id="cronograma0" class="form-control" rows="2"></textarea>
					    							</div>
					    						</div><!-- /.col-md-4 -->
					    					</div><!-- /.row fila02 -->
			    						</div><!-- /.col-md-12 -->
			    						<div class="col-md-12 botonesAccion">
			    							<button type="button" class="anadir btn btn-default">
			    								<span class="glyphicon glyphicon-plus"></span> Añadir nueva fila
			    							</button>
			    							<button type="button" class="eliminar btn btn-danger oculto">
			    								<span class="glyphicon glyphicon-minus"></span> Eliminar esta fila
			    							</button>
			    						</div><!-- /.col-md-12 -->
			    					</div><!-- /.row filaImpar -->
			    				</div><!-- /.col-md-12 #plandeaccion -->
			    				<div class="col-md-12">
					    			<div class="form-group">
						    			<label for="seguimientoIP">Seguimiento, evaluación y monitoreo<br><small>¿Qué mecanismos se utilizan para dar cuenta del cumplimiento de los objetivos y metas propuestos para la iniciativa? En caso que aún no realice tareas de seguimiento y evaluación, ¿considera que lo hará en el futuro cercano?   </small></label>
				    					<textarea name="seguimientoIP" id="seguimientoIP" class="form-control" rows="5" placeholder="Describa el seguimiento, evaluación y monitoreo de la iniciativa"></textarea>
			    					</div>
					    			<div class="form-group oculto" id="monitoreoIP"><!-- Oculto temporalmente -->
						    			<label for="monitoreoIP">Retroalimentación / Monitoreo<br><small>¿Se ha desarrollado algún proceso de valoración? Descríbalo. ¿Qué mecanismos de valoración de la iniciativa se han implementado?, ¿qué resultados arrojó?</small></label>
				    					<textarea name="monitoreoIP" id="monitoreoIP" class="form-control" rows="5" placeholder="Describa la retroalimentación o monitoreo"></textarea>
			    					</div>
					    			<div class="form-group">
						    			<label for="proyeccionIP">Proyección<br><small>Una vez ejecutada la iniciativa, ¿qué otras acciones se pueden realizar?, ¿qué otros actores pueden involucrarse?, ¿en qué otros escenarios se puede implementar esta iniciativa?</small></label>
				    					<textarea name="proyeccionIP" id="proyeccionIP" class="form-control" rows="5" placeholder="Describa la proyección de la iniciativa"></textarea>
			    					</div>
			    					<br>
			    					<strong>A continuación podrá anexar cualquier material concerniente a la iniciativa pedagógica (imágenes y archivo, máximo tres).</strong>
									<br><br>
									<div class="row">
										<div class="form-group col-md-10">
											<input type="file" name="anexoIP1" class="form-control">
										</div>
										<div class="col-md-1">
											<button type="button" id="masAnexoIP1" class="btn btn-success btn-block"><i class="fa fa-plus"></i></button>
										</div>
									</div><!-- /.row -->
									<div class="row oculto" id="filaAnexoIP2">
										<div class="form-group col-md-10">
											<input type="file" name="anexoIP2" id="anexoIP2" class="form-control">
										</div>
										<div class="col-md-1">
											<button type="button" id="masAnexoIP2" class="btn btn-success btn-block"><i class="fa fa-plus"></i></button>
										</div>
										<div class="col-md-1">
											<button type="button" id="menosAnexoIP2" class="btn btn-danger btn-block"><i class="fa fa-minus"></i></button>
										</div>
									</div><!-- /.row -->
									<div class="row oculto" id="filaAnexoIP3">
										<div class="form-group col-md-10">
											<input type="file" name="anexoIP3" id="anexoIP3" class="form-control">
										</div>
										<div class="col-md-1"></div>
										<div class="col-md-1">
											<button type="button" id="menosAnexoIP3" class="btn btn-danger btn-block"><i class="fa fa-minus"></i></button>
										</div>
									</div><!-- /.row -->
									<div class="row">
										<div class="col-md-3">
											<button type="submit" id="enviarForm" class="btn btn-primary">Enviar información</button>
										</div>
										<div class="col-md-9">
											<div id="alertaPoblacionIP" class="alert alert-danger hidden">
												¡Debe seleccionar al menos un tipo de población hacia la que se dirige la iniciativa!<br><a href="#poblacionIP" class="alert-link">Haga clic aquí para solucionar este problema</a>
											</div>
										</div>
									</div><!-- /.row -->
			    				</div><!-- /.col-md-12 -->
			    			</div><!-- /.row -->
			    		</div><!-- /.panel-body -->
			    	</div><!-- /.panel #ip -->
	  			</div><!-- /.col-md-10 -->
				<div class="col-md-1"></div>
	    	</div><!-- /.row -->
	    </div><!-- /.container -->
	</form><!-- /.form -->
	<div class="footer">
		<div class="container">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-6 copyright">2014® CIUDADANÍAS</div>
			<div class="col-md-4">
				<img src="img/logoOEI.jpg">
				<img src="img/logoMercosur.jpg">
				<img src="img/logoParlamentoJuvenil2014.jpg">
			</div><!-- /.col-md-4 -->
			<div class="col-md-1">&nbsp;</div>
		</div><!-- /.container -->
	</div><!-- /.footer -->
	<div class="modal fade" id="ventanaProgreso" tabindex="-1" role="dialog" aria-labelledby="Registro de datos" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Registrando datos</h4>
	      </div>
	      <div class="modal-body">
	        <p>Validando datos&hellip;</p>
	        <div id="progreso"></div>
	      </div>
	      <div class="modal-footer">
	        <button id="cerrarModal" data-dismiss="modal" type="button" class="btn btn-primary">Cerrar ventana</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="guardando" class="alert alert-warning hidden"><i class="fa fa-spinner fa-spin"></i> <span>Almacenando datos temporalmente&hellip;</span></div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--
    <script src="js/jqBootstrapValidation.min.js"></script>
    -->
    <script src="js/jquery.form.min.js"></script>
    <script src="js/registro-cisp.js"></script>
	<script type="text/javascript">
		if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) { //test for MSIE x.x;
			var ieversion=new Number(RegExp.$1); // capture x.x portion and store as a number
			if (ieversion<9) {
				$('body').html('<div style="color: #FFFFFF;">Su navegador es obsoleto y no es compatible con esta plataforma. Por favor actualice su sistema <a href="http://windows.microsoft.com/es-co/internet-explorer/download-ie-MCM?FORM=MI09JK&amp;OCID=MI09JK">haciendo clic aquí</a></div>');
			}  
		}
	</script> 
  </body>
</html>