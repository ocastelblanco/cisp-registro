<?php
require_once 'lib/config.php';
$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
	$queryRevision = "SELECT `estado`, COUNT(*) FROM `registrodocentes` GROUP BY `estado` ASC";
	$resultadoRevision = $mysqli->query($queryRevision);
	while($fila = $resultadoRevision->fetch_assoc()) {
		$porcentajeRev = round($fila['COUNT(*)'] / 17 * 100, 1);
		echo "{label: \"".$fila['estado']."\", value: ".$porcentajeRev."},\n";
	}
?>