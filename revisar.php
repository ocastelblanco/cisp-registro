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

<body id="revisar">

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
            <li class="active"><a href="revisar.php?ses=<?php echo session_id(); ?>"><i class="fa fa-tasks"></i> Revisar y aprobar iniciativas</a></li>
            <li><a href="notificar.php?ses=<?php echo session_id(); ?>"><i class="fa fa-envelope-o"></i> Notificar docentes</a></li>
            <li><a href="exportar.php?ses=<?php echo session_id(); ?>"><i class="fa fa-download"></i> Descargar listados</a></li>
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
            <h1>Revisar, aprobar o descartar Iniciativas Pedagógicas</h1>
          </div>
        </div><!-- /.row -->
      	<div class="row">
          <div class="col-lg-12">
            <div id="panelTabla" class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bars"></i> Iniciativas registradas: </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table id="tablaIniciativas" class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr></tr>
                    </thead>
                    <tbody></tbody>
                  </table>
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
    
    
    
    
	<div class="modal fade" id="ventanaDetalles" tabindex="-1" role="dialog" aria-labelledby="Detalle de datos" aria-hidden="true">
		<!-- Esta ventana modal se carga dinámicamente con ajax -->
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
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/revisar-admin.js"></script>
  </body>
</html>
<?php
	} else {
		$_SESSION = array();
		session_destroy();
		header('Location: admin.php');
	}
?>