<?php
	session_start();
	if (isset($_GET['logout']) &&  $_GET['logout'] == session_id()) {
		$_SESSION = array();
		session_destroy();
		header('Location: admin.php');
	}
	if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
		header('Location: dashboard.php?ses='.session_id());
	} else {
		$modal = "Validando datos&hellip;";
		$script = "$('#login').submit(function(e) { $('#ventanaProgreso').modal();});";
		if(!empty($_POST['usuario']) && !empty($_POST['clave'])) {
		    require_once 'lib/config.php';
			$user = $_POST['usuario'];
			$password = $_POST['clave'];
			if (isset($_POST['recordar-sesion']) && $_POST['recordar-sesion'] == 'recordar-sesion') {
				$recordarSes = true;
			} else {
				$recordarSes = false;
			}
			$acceso = false;
			$motivo = "";
			$pais = "";
			$id = "";
			$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
			if ($mysqli->connect_errno) {
			    exit("Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error);
			}
			$mysqli->query("SET NAMES 'utf8'");
			$query = "SELECT * FROM `admin` WHERE `usuario`='$user'";
			if ($resultado = $mysqli->query($query)) {
				if ($resultado->num_rows < 1)
					$motivo = "El usuario no existe en la base de datos.";
				while($fila = $resultado->fetch_assoc()) {
					$motivo = "La contraseña es inválida.";
					if (md5($password) == $fila['clave']) {
		   				$acceso = true;
						$pais = $fila['pais'];
						$id = $fila['id'];
					}
				}
				$resultado->free();
			} else {
				$motivo = "No se pudo consultar la base de datos.";
			}
			$query = "UPDATE  `admin` SET  `acceso` = NOW( ) WHERE  `id` =$id;";
			if ($acceso) {
				if (!$recordarSes)
					session_set_cookie_params('1800');
				$_SESSION['Username'] = $user; 
		        $_SESSION['LoggedIn'] = $id;
				$_SESSION['pais'] = $pais;
				$modal = "Datos validados. Cierre esta ventana para ingresar a su Panel de control.";
				$script = "$('#ventanaProgreso').modal();
						   $('#ventanaProgreso').on('hidden.bs.modal', function (e) {
  								window.location.replace('admin.php');
						   });
						   var cont = window.setInterval(cierraVentana, 1500);
						   function cierraVentana(){
						   		$('#ventanaProgreso').modal('hide');
						   }";
				$mysqli->query($query);
			} else {
				$modal = "Error en la autenticación: $motivo";
				$script = "$('#ventanaProgreso').modal();";
				$_SESSION = array();
			}
			$mysqli->close();
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
    <!-- Estilos propios -->
    <link href="css/registro-cisp.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div id="login" class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form class="form-signin" action="admin.php" role="form" method="post">
					<h2 class="form-signin-heading">Ingrese con su usuario y contraseña</h2>
					<input name="usuario" type="text" class="form-control" placeholder="Usuario" required autofocus>
					<input name="clave" type="password" class="form-control" placeholder="Contraseña" required>
					<label class="checkbox">
						<input type="checkbox" name="recordar-sesion" value="recordar-sesion"> Recordar sesión
					</label>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
				</form>
			</div><!-- /.col-md-4 -->
			<div class="col-md-4"></div>
		</div><!-- /.row -->
    </div> <!-- /#login .container -->
    
    <br><br><br><br>  

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
    
    
	<div class="modal fade" id="ventanaProgreso" tabindex="-1" role="dialog" aria-labelledby="Ventana avisos" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Registrando datos</h4>
	      </div>
	      <div class="modal-body">
	        <p><?php echo $modal; ?></p>
	        <div id="progreso">
	        	<div class="progress progress-striped active">
	        		<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
	        			<span class="sr-only">Validando</span>
        			</div>
    			</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button id="cerrarModal" data-dismiss="modal" type="button" class="btn btn-primary">Cerrar ventana</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
    
    
   
    
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
		$(function(){
		    <?php echo $script; ?>
		});
    </script>
  </body>
</html>
<?php		
	}
?>