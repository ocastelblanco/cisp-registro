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
    <!-- Estilos propios -->
    <link href="css/registro-cisp.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

<body id="exportar">

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
            <li><a href="notificar.php?ses=<?php echo session_id(); ?>"><i class="fa fa-envelope-o"></i> Notificar docentes</a></li>
            <li class="active"><a href="exportar.php?ses=<?php echo session_id(); ?>"><i class="fa fa-download"></i> Descargar listados</a></li>
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
            <h1>Descargar listados<small> de todos los docentes, o de los docentes aprobados, para cargar en el curso virtual</small></h1>
            <p>Con esta herramienta podrá descargar un listado en formato Microsoft Excel de todos los docentes registrados en la iniciativa, o un documento en formato CSV, de los docentes con iniciativas aprobadas, listo para ser cargado en el curso virtual Ciudadanías.</p>
          </div>
        </div><!-- /.row -->

		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Descargar listado total</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6">
								<button id="xls" class="btn btn-default btn-block"><i class="fa fa-download fa-2x"></i>&nbsp;&nbsp;&nbsp;MS Excel 95 (xls)</button>
							</div>
							<div class="col-sm-6">
								<button id="xlsx" class="btn btn-default btn-block"><i class="fa fa-download fa-2x"></i>&nbsp;&nbsp;&nbsp;MS Excel 2007 (xlsx)</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Descargar listado de carga Moodle</h3>
					</div>
					<div class="panel-body">
						<button id="csv" class="btn btn-default btn-block"><i class="fa fa-download fa-2x"></i>&nbsp;&nbsp;&nbsp;Archivo de carga para el curso virtual (csv)</button>
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
    
    
	<div class="modal fade" id="ventanaDescarga" tabindex="-1" role="dialog" aria-labelledby="Generación de listados de docentes" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Generación de listados de docentes</h4>
	      </div>
	      <div class="modal-body">
	      	<p>Se está generando el archivo, espere un momento.</p>
	        <div id="progreso">
	        	<div class="progress progress-striped active">
	        		<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
	        			<span class="sr-only">Generando archivo</span>
	        		</div>
	        	</div>
        	</div>
	      </div>
	      <div class="modal-footer">
	        <button data-dismiss="modal" type="button" class="btn btn-default"><i class="fa fa-times"></i> Cerrar ventana</button>
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
    <script type="text/javascript" src="js/exportar-admin.js"></script>
	</body>
</html>
<?php
	} else {
		$_SESSION = array();
		session_destroy();
		header('Location: admin.php');
	}
?>