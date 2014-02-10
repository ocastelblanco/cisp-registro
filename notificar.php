<?php
	session_start();
	if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']) && session_id() == $_GET['ses']) {
		if ($_SESSION['pais'] == "Todos") {
			$adminGral = true;
			$administrador = "Administrador general";
			$icono = "fa-globe";
		} else {
			$adminGral = false;
			$administrador = "Administrador ".$_SESSION['pais'];
			$icono = "fa-user";
		}
	?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de registro para el curso CIUDADANÍAS de CISP">
    <meta name="author" content="Oliver Castelblanco M. para CISP">
    <link rel="shortcut icon" href="ico/favicon.png">
    <title>Sistema de administración de información - CIUDADANÍAS</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <!-- Estilos propios -->
    <link href="css/registro-cisp.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

<body id="notificar">

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Abrir/cerrar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="dashboard.php?ses=<?php echo session_id(); ?>"><img src="img/ciudadanias.png" class="img-responsive"></a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="dashboard.php?ses=<?php echo session_id(); ?>"><i class="fa fa-dashboard"></i> Panel de Control</a></li>
            <li><a href="revisar.php?ses=<?php echo session_id(); ?>"><i class="fa fa-tasks"></i> Revisar y aprobar iniciativas</a></li>
            <li class="active"><a href="notificar.php?ses=<?php echo session_id(); ?>"><i class="fa fa-envelope-o"></i> Notificar docentes</a></li>
            <li><a href="admin.php?logout=<?php echo session_id(); ?>"><i class="fa fa-sign-out"></i> Salir</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa <?php echo $icono; ?>"></i> <?php echo $administrador; ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="admin.php?logout=<?php echo session_id(); ?>"><i class="fa fa-sign-out"></i> Salir</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Notificar docentes<small> sobre iniciativas aprobadas o descartadas</small></h1>
            <p>Con esta herramienta podrá notificar a todos los docentes, tanto a los que ha aprobado su Iniciativa Pedagógica, como a los que no, directamente a sus correos electrónicos.</p>
            <p>Por lo anterior, le recomendamos que, antes de cualquier proceso de notificación, haya aprobado las 20 iniciativas deseadas y haya descartado las restantes.</p>
            <p>Debido a que queremos evitar ser clasificados como origen de correo spam, este proceso de envío puede durar, en promedio, un minuto por cada registro. Le recomendamos, por lo tanto, que cuando haga clic en el botón de <strong>Notificar docentes seleccionados</strong>, deje al sistema procesar los envíos, sin interrumpirlo, ni cerrar el navegador, ni apagar el computador.</p>
          </div>
        </div><!-- /.row -->
      	<div class="row">
          <div class="col-lg-12">
            <div id="panelTabla" class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">
                	<div class="row">
                		<div class="col-md-6">
                			<p id="tituloTabla"><i class="fa fa-bars"></i> Docentes registrados: </p>
            			</div>
	            		<div class="col-md-6 text-right">
		                	<button id="selectToggle" class="btn btn-warning">
		                		<i class="fa fa-square-o"></i> Deseleccionar todos
		            		</button>
	            		</div>
            		</div>
        		</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table id="tablaDocentes" class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                      	<th class="header">Sel.</th>
                      	<th class="header">Nombres</th>
                      	<th class="header">Apellidos</th>
                      	<th class="header">Iniciativa</th>
                      	<th class="header">País</th>
                      	<th class="header">Estado</th>
                  	  </tr>
                    </thead>
                    <tbody>
                    	<tr>
                    		<td colspan="6">
                    			<i class="fa fa-spinner fa-spin"></i> Cargando contenido...
                			</td>
            			</tr>
                    </tbody>
                  </table>
                  <div class="row">
                  	<div id="tablaPie" class="col-lg-8"></div>
                  	<div class="col-lg-4">
                  		<button id="accionNotificar" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;&nbsp;Notificar <span></span> docentes seleccionados</button>
                  	</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->

		<div class="footer">
			<div class="row">
				<div class="col-lg-5 copyright">2014® CIUDADANÍAS</div>
				<div class="col-lg-7">
					<img src="img/logoOEI.jpg">
					<img src="img/logoMercosur.jpg">
					<img src="img/logoParlamentoJuvenil2014.jpg">
				</div><!-- /.col-lg-7 -->
			</div><!-- /.row -->
		</div><!-- /.footer -->
		
      </div><!-- /#page-wrapper -->

		
    </div><!-- /#wrapper -->
    
    
	<div class="modal fade" id="ventanaProgreso" tabindex="-1" role="dialog" aria-labelledby="Notificación de docentes" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Notificación de docentes</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="paso paso-1 alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  	<i class="fa fa-exclamation-triangle fa-lg"></i> ¡Revise bien! Hay <span id="sinAprobar"></span> docentes con iniciativa pendiente de aprobación. Es mejor que apruebe y descarte todas las iniciativas antes de notificar a los docentes.
			</div>
	      	<div class="paso paso-2 alert alert-info">
			  	<i class="fa fa-exclamation-triangle fa-lg"></i> ¡Recuerde! No cancele esta operación, no cierre esta ventana, no cierre el navegador ni apague el computador hasta que el proceso haya finalizado.
			</div>
	        <p class="paso paso-1">El sistema está listo para iniciar el envío de notificaciones por correo electrónico a <span id="porNotificar"></span> docentes. Oprima el botón <strong>Iniciar envío</strong> para seguir con el proceso.</p>
	        <p class="paso paso-2 paso-3">Enviando <span id="envioActual"></span> de <span id="porNotificar"></span> notificaciones.</p>
	        <p class="paso paso-4">Proceso de envío finalizado. Cierre esta ventana.</p>
	        <div id="progreso"></div>
	        <p class="paso paso-2">Preparando correo electrónico</p>
	        <p class="paso paso-3">Enviando correo a <span class="nombreDocente"></span>.</p>
	      </div>
	      <div class="modal-footer">
	        <button id="cerrarModal" data-dismiss="modal" type="button" class="btn btn-warning paso paso-1 paso-4"><i class="fa fa-times"></i> Cerrar ventana</button>
	        <button id="continuarNotificacion" type="button" class="btn btn-primary paso paso-1">Iniciar envío <i class="fa fa-angle-double-right"></i></button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
    
    
   
    
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Page Specific Plugins -->
    <script type="text/javascript">
    	var pais = '<?php echo $_SESSION['pais']; ?>';
    </script>
    <script type="text/javascript" src="js/notificar-admin.js"></script>
	</body>
</html>
<?php
	} else {
		$_SESSION = array();
		session_destroy();
		header('Location: admin.php');
	}
?>