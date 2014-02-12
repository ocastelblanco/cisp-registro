<?php
	$estados = array("<span class='label label-default'><span>0</span><i class='fa fa-circle-o'></i> Pendiente de aprobación</span>",
					"<span class='label label-success'><span>1</span><i class='fa fa-check-circle-o'></i> Aprobada</span>",
					"<span class='label label-danger'><span>2</span><i class='fa fa-ban'></i> Descartada</span>");
	$notificado = array("&nbsp;&nbsp;&nbsp;<i class='fa fa-envelope-o'></i>",
					"&nbsp;&nbsp;&nbsp;<i class='fa fa-envelope'></i>");
	require_once 'lib/config.php';
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	$query = "SELECT `id`,`nombres`,`apellidos`,`nombreIP`,`pais`, `estado`, `notificado` FROM `registrodocentes` ORDER BY `estado` ASC";
	$resultado = $mysqli->query($query);
	$numRegistros = $resultado->num_rows;
	$cuerpoTabla = "";
	$numNotificados = 0;
	$sinAprobar = 0;
	$porNotificar = 0;
	while ($fila = $resultado->fetch_assoc()) {
		if ($fila['notificado'] != '0') {
			$numNotificados++;			
		}
		if ($fila['estado'] == '0') {
			$sinAprobar++;
		}
		$cuerpoTabla .= "<tr>";
		if ($fila['notificado'] == '0' && $fila['estado'] != '0') {
			$cuerpoTabla .= "<td><input type='checkbox' checked value='".$fila['id']."'>";
			$cuerpoTabla .= $notificado[$fila['notificado']]."</td>";
			$porNotificar++;
		} else {
			$cuerpoTabla .= "<td><div><input type='checkbox' disabled value='".$fila['id']."'>";
			$cuerpoTabla .= $notificado[$fila['notificado']]."</div></td>";
		}
		$cuerpoTabla .= "<td>".$fila['nombres']."</td>";
		$cuerpoTabla .= "<td>".$fila['apellidos']."</td>";
		$cuerpoTabla .= "<td>".$fila['nombreIP']."</td>";
		$cuerpoTabla .= "<td>".$fila['pais']."</td>";
		$cuerpoTabla .= "<td>".$estados[$fila['estado']]."</td>";
		$cuerpoTabla .= "</tr>";
	}
	echo "{\"cuerpoTabla\": \"$cuerpoTabla\", \"registros\": \"$numRegistros\", \"notificados\": \"$numNotificados\", \"sinAprobar\": \"$sinAprobar\", \"porNotificar\": \"$porNotificar\"}";
	$mysqli->close();
?>