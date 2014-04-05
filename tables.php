<?php
if (isset($_GET['pais']) && isset($_GET['numero'])) {
	$estados = array("fa-circle-o","fa-check-circle-o","fa-ban");
	$notificaciones = array("&nbsp;&nbsp;&nbsp;<i class='fa fa-envelope-o fa-lg'></i>",
							"&nbsp;&nbsp;&nbsp;<i class='fa fa-envelope fa-lg'></i>");
	if ($_GET['numero'] == '10') {
		$limites = " LIMIT 0 , 10";
	} else {
		$limites = "";
	}
	require_once 'lib/config.php';
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	if ($_GET['pais'] == "Todos") {
		$th = "<th>Nombres&nbsp;<i class='fa fa-sort'></i></th><th>Apellidos&nbsp;<i class='fa fa-sort'></i></th><th>Iniciativa&nbsp;<i class='fa fa-sort'></i></th><th>Fecha&nbsp;<i class='fa fa-sort'></i></th><th>País&nbsp;<i class='fa fa-sort'></i></th><th>Estado</th><th>Ver</th>";
		$colFijas = "{\"5\": {\"sorter\": false}, \"6\": {\"sorter\": false}}";
		$colFijasOrg = array('5'=>array('sorter'=>false), '6'=>array('sorter'=>false));
		$colFijasJSON = json_encode($colFijasOrg);
		$partQuery = "";
		$whereRev = "";
	} else {
		$th = "<th>Nombres&nbsp;<i class='fa fa-sort'></i></th><th>Apellidos&nbsp;<i class='fa fa-sort'></i></th><th>Iniciativa&nbsp;<i class='fa fa-sort'></i></th><th>Fecha&nbsp;<i class='fa fa-sort'></i></th><th>Estado</th><th>Ver</th>";
		$colFijas = "{\"4\": {\"sorter\": false}, \"5\": {\"sorter\": false}}";
		$partQuery = "WHERE `pais`='".$_GET['pais']."'";
		$whereRev = "AND `pais`='".$_GET['pais']."'";
	}
	$query = "SELECT `id`,`nombres`,`apellidos`,`nombreIP`,LEFT(`fecha`, 10),`pais`, `estado`, `notificado` FROM `registrodocentes` $partQuery ORDER BY `fecha` DESC$limites";
	$resultado = $mysqli->query($query);
	$numRegistros = $resultado->num_rows;
	$cuerpoTabla = "";
	while ($fila = $resultado->fetch_assoc()) {
		$cuerpoTabla .= "<tr>";
		$cuerpoTabla .= "<td>".$fila['nombres']."</td>";
		$cuerpoTabla .= "<td>".$fila['apellidos']."</td>";
		$cuerpoTabla .= "<td>".$fila['nombreIP']."</td>";
		$cuerpoTabla .= "<td>".$fila['LEFT(`fecha`, 10)']."</td>";
		if ($_GET['pais'] == "Todos")
			$cuerpoTabla .= "<td>".$fila['pais']."</td>";
		$cuerpoTabla .= "<td><i class='fa ".$estados[$fila['estado']]."  fa-lg'></i>";
		$cuerpoTabla .= $notificaciones[$fila['notificado']]."</td>";
		$cuerpoTabla .= "<td><a class='abreModal' href='detalles.php?id=".$fila['id']."'><i class='fa fa-external-link fa-lg'></i></a></td>";
		$cuerpoTabla .= "</tr>";
	}
	$queryRev = "SELECT COUNT(*) FROM `registrodocentes` WHERE `estado`=0 $whereRev";
	$resultadoRev = $mysqli->query($queryRev);
	$fila = $resultadoRev->fetch_assoc();
	$numPendientes = $fila['COUNT(*)'];
	$queryNot = "SELECT COUNT(*) FROM `registrodocentes` WHERE `notificado`=1 $whereRev";
	$resultadoNot = $mysqli->query($queryNot);
	$fila = $resultadoNot->fetch_assoc();
	$numNotificados = $fila['COUNT(*)'];
	$salida = array('pendientes'=>$numPendientes, 'notificados'=>$numNotificados, 'th'=>$th, 'cuerpoTabla'=>$cuerpoTabla, 'headers'=>$colFijasOrg, 'registros'=>$numRegistros);
	$salidaJSON = json_encode($salida);
	echo $salidaJSON;
	//echo "{\"pendientes\": \"$numPendientes\", \"notificados\": \"$numNotificados\", \"th\": \"$th\", \"cuerpoTabla\": \"$cuerpoTabla\", \"headers\": $colFijas, \"registros\": \"$numRegistros\"}";
	$mysqli->close();
} // if (isset($_GET['pais']))
?>