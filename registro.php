<?php
    require_once 'lib/config.php';
	$mensajeError = "";
	$id = "";
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		$mensajeError = "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	$query0 = "SELECT * FROM `registrodocentes` WHERE `nombres`='".$_POST["nombres"]."' AND `apellidos`='".$_POST["apellidos"]."' AND `nombreIP`='".$_POST["nombreIP"]."'";
	$resultado = $mysqli->query($query0);
	$fila = $resultado->fetch_assoc();
	if ($fila['id'] == "") {
		$query = "INSERT INTO `registrodocentes` (";
		foreach ($_POST as $clave => $valor) {
			if ($valor) {
				if (substr($clave, 7) != "anexoIP") {
					$query .= "`$clave`, ";
				}
			}
		}
		$query .= "`estado`, `notificado`,`fecha`) VALUES (";
		foreach ($_POST as $clave => $valor) {
			if ($valor) {
				if ($valor == 'poblacionIP_estudiantes' ||
					$valor == 'poblacionIP_docentes' ||
					$valor == 'poblacionIP_directivas' ||
					$valor == 'poblacionIP_padres' ||
					$valor == 'poblacionIP_miembros' ||
					$valor == 'poblacionIP_otros') {
						$query .= "1,";		
				} elseif (substr($clave, 7) != "anexoIP") {
					$query .= "'$valor', ";
				}
			}
		}
		$query .= "0, 0, NOW());";
	    if (!$mysqli->query($query)) {
	        printf("Error: %s\n", $mysqli->error);
	        foreach ($mysqli->error as $elem => $cant) {
				$mensajeError .= "<br><br>Error: ".$elem." = ".$cant;
			}
	    }
		$query2 = "SELECT * FROM `registrodocentes` WHERE `nombres`='".$_POST["nombres"]."' AND `apellidos`='".$_POST["apellidos"]."' AND `nombreIP`='".$_POST["nombreIP"]."'";
		$resultado = $mysqli->query($query2);
		$fila = $resultado->fetch_assoc();
		if (count($_FILES) > 0 && isset($fila['id'])) {
			$id = $fila['id'];
			$uploads_dir = '/uploads';
			$query3 = "UPDATE `registrodocentes` SET ";
			$errorCargaArchivos = false;
			foreach ($_FILES as $archivo => $infoArchivo) {
			    if ($_FILES[$archivo]["error"] == UPLOAD_ERR_OK) {
			        $tmp_name = $_FILES[$archivo]["tmp_name"];
			        $name = "id".$id."_".$_FILES[$archivo]["name"];
					$query3 .= "`$archivo`='$name', ";
					$archs[$archivo] = $name;
			        move_uploaded_file($tmp_name, getcwd()."$uploads_dir/$name");
				} else {
					$errorCargaArchivos = true;
					$mensajeError .= "<br><br>Error: Los archivos adjuntos no se cargaron correctamente.";
				}
			}
			$query3 = substr($query3,0,-2);
			$query3 .= " WHERE `id`='$id';";
		    if (!$mysqli->query($query3)) {
		        printf("Error: %s\n", $mysqli->error);
		        foreach ($mysqli->error as $elem => $cant) {
					$mensajeError .= "<br><br>Error: ".$elem." = ".$cant;
				}
		    }
		}
	} else {
		$mensajeError .= "La iniciativa pedagógica ya está registrada con el ID: ".$fila['id'];
	}
	if ($mensajeError != ""){
		$salida = array('registro'=>'error', 'mensaje'=>$mensajeError);
	} else {
		$salida = array('registro'=>'exitoso', 'id'=>$id, 'nombres'=>$_POST['nombres'], 'apellidos'=>$_POST['apellidos']);
	}
	echo json_encode($salida);
	$mysqli->close();
	/*
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
    <title>Ficha de convocatoria de docentes - CIUDADANÍAS</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Estilos propios -->
    <link href="css/registro-cisp.css" rel="stylesheet">
    <style type="text/css">
    	.page-header {
    		margin-top: 50px;
    		color: #FFFFFF;
    	}
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->	
  </head>

  <body>
  
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="http://www.redeaprender.com/ciudadanias"><img src="img/ciudadanias.png" class="img-responsive"></a>
        </div>
      </div>
    </div>
    
    <div class="page-header">
	    <div class="container">
			<h1>¡Muchas gracias por su participación!</h1>
			<p>Su ficha fue enviada de manera correcta.</p>
			<p>Esta información será evaluada y los nombres de las personas seleccionadas para realizar el curso Ciudadanías serán publicadas en esta página el 17 de abril.</p>
			<p>Si tiene dudas, escíbanos a: <a href="mailto:cursociudadanias@gmail.com">cursociudadanias@gmail.com</a></p>
		</div>
    </div><!-- /.page-header -->
	
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
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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

<?php
	 */
?>