<?php
    require_once 'lib/config.php';
	
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	$query = "INSERT INTO `registrodocentes` (";
	foreach ($_POST as $clave => $valor) {
		if ($valor) 
			$query .= "`$clave`, ";
	}
	//$query = substr($query,0,-2);
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
			} else {
				$query .= "'$valor', ";
			}
		}
	}
	//$query = substr($query,0,-2);
	$query .= "0, 0, NOW());";
    if (!$mysqli->query($query)) {
        printf("Error: %s\n", $mysqli->error);
    }
	if (count($_FILES) > 0) {
		$query2 = "SELECT * FROM `registrodocentes` WHERE `nombres`='".$_POST["nombres"]."' AND `apellidos`='".$_POST["apellidos"]."' AND `nombreIP`='".$_POST["nombreIP"]."'";
		$resultado = $mysqli->query($query2);
		$fila = $resultado->fetch_assoc();
		$id = "id".$fila['id']."_";
		$uploads_dir = '/uploads';
		$query3 ="UPDATE `registrodocentes` SET ";
		foreach ($_FILES as $archivo => $infoArchivo) {
		    if ($_FILES[$archivo]["error"] == UPLOAD_ERR_OK) {
		        $tmp_name = $_FILES[$archivo]["tmp_name"];
		        $name = $id.$_FILES[$archivo]["name"];
				$query3 .= "`$archivo`='$name', ";
				$archs[$archivo] = $name;
		        move_uploaded_file($tmp_name, getcwd()."$uploads_dir/$name");
			}
		}
		$query3 = substr($query3,0,-2);
		$query3 .= " WHERE `id`='".$fila['id']."';";
	    if (!$mysqli->query($query3)) {
	        printf("Error: %s\n", $mysqli->error);
	    }
	}
	echo "{";
	foreach ($_POST as $clave => $valor)
		echo "\"$clave\":\"$valor\",";
	echo "\"registro\":\"exitoso\"}";
	$mysqli->close();
?>