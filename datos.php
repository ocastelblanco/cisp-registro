<?php
// Genera los datos desde la base de datos, generales y país por país.
$queryNumReg = "";
$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre");
$estados = array("Sin revisar", "Aprobadas", "Descartadas");
$colores = array('#cccc06', '#06cc06', '#cc0606');
require_once 'lib/config.php';
$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
}
$mysqli->query("SET NAMES 'utf8'");
$queryPaises = "SELECT `pais`, COUNT(*) FROM `registrodocentes` GROUP BY `pais` ORDER BY `pais` ASC";
$resultadoPaises = $mysqli->query($queryPaises);
$paises = array();
$cantPaises = array();
while ($fila = $resultadoPaises->fetch_assoc()) {
	$paises[] = $fila['pais'];
	$cantPaises[] = $fila['COUNT(*)'];
}
if (isset($_GET['pais']) && $_GET['pais'] == "Todos") { // Aplica solo si es usuario super admin
	$queryFechas = "SELECT `pais`, LEFT(`fecha`, 10) FROM `registrodocentes` ORDER BY `fecha` ASC";
	$resultadoFechas = $mysqli->query($queryFechas);
	$filaFechas = array();
	$filaSola = "";
	$ultimaFecha = "";
	while ($fila = $resultadoFechas->fetch_assoc()) {
		if ($fila['LEFT(`fecha`, 10)'] != $ultimaFecha) {
			$numPaises = array('Argentina'=>'0', 'Bolivia'=>'0','Colombia'=>'0','Uruguay'=>'0');
			if ($ultimaFecha) {	
				$begin = new DateTime($ultimaFecha);
				$end = new DateTime($fila['LEFT(`fecha`, 10)']);
				$begin = $begin->modify('+1 day'); 
				$interval = new DateInterval('P1D');
				$daterange = new DatePeriod($begin, $interval ,$end);
				foreach($daterange as $date){
					$filaSola = "{d: '".$date->format("Y-m-d")."', ";
					foreach ($numPaises as $key => $value) {
						$filaSola .= "$key: $value, ";
					}
					$filaSola = substr($filaSola, 0, -2);
					$filaSola .= "},";
					$filaFechas[] = $filaSola;
				}
			}
			$ultimaFecha = $fila['LEFT(`fecha`, 10)'];
			$queryNumPaises = "SELECT `pais`, COUNT(*) FROM `registrodocentes` WHERE LEFT(`fecha`, 10)='".$ultimaFecha."' GROUP BY `pais`";
			$resultadoNumPaises = $mysqli->query($queryNumPaises);
			while ($filaNumPaises = $resultadoNumPaises->fetch_assoc()) {
				$numPaises[$filaNumPaises['pais']] = $filaNumPaises['COUNT(*)'];
			}
			$filaSola = "{d: '$ultimaFecha', ";
			foreach ($numPaises as $key => $value) {
				$filaSola .= "$key: $value, ";
			}
			$filaSola = substr($filaSola, 0, -2);
			$filaSola .= "},";
			$filaFechas[] = $filaSola;
		}
	}
	$numFilas = $resultadoFechas->num_rows - 1;
	$resultadoFechas->data_seek(0);
	$fechaInicial = $resultadoFechas->fetch_row();
	$resultadoFechas->data_seek($numFilas);
	$fechaFinal = $resultadoFechas->fetch_row();
	$fechaInicial = new DateTime($fechaInicial[1]);
	$fechaFinal = new DateTime($fechaFinal[1]);
	$queryNumReg = "SELECT COUNT(*) FROM `registrodocentes`";
?>
function activaGraficos() {
	$('#grafico-registro').html('');
Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'grafico-registro',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
<?php
$filaFechas[count($filaFechas)-1] = substr($filaFechas[count($filaFechas)-1],0,-1);
for ($i=0;$i<count($filaFechas);$i++) {
	echo $filaFechas[$i]."\n";
}
?>
  ],
  xkey: 'd',
  ykeys: ['Argentina', 'Bolivia', 'Colombia', 'Uruguay'],
  labels: ['Argentina', 'Bolivia', 'Colombia', 'Uruguay'],
  smooth: false,
  lineColors: ['#ff0000', '#00ff00', '#0000ff', '#ff00ff'],
});
<?php
	$queryParticipacion = "SELECT `pais`, LEFT(`fecha`, 10) FROM `registrodocentes` ORDER BY `fecha` ASC";
	$resultadoParticipacion = $mysqli->query($queryParticipacion);
} elseif (isset($_GET['pais'])) { // Aplica solo para los admins de cada país
	$queryFechas = "SELECT LEFT(`fecha`, 10), COUNT(*) FROM `registrodocentes` WHERE `pais`='".$_GET['pais']."' GROUP BY LEFT(`fecha`, 10)";
	if ($resultadoFechas = $mysqli->query($queryFechas)){
		$salidaFechas = "Morris.Line({element: 'grafico-registro',data: [";
		$ultimaFecha = "";
		while ($fila = $resultadoFechas->fetch_assoc()) {
			if ($ultimaFecha) {	
				$begin = new DateTime($ultimaFecha);
				$end = new DateTime($fila['LEFT(`fecha`, 10)']);
				$begin = $begin->modify('+1 day'); 
				$interval = new DateInterval('P1D');
				$daterange = new DatePeriod($begin, $interval ,$end);
				foreach($daterange as $date){
					$salidaFechas .= "{d:'".$date->format("Y-m-d")."',registros:0},";
				}
			}
			$salidaFechas .= "{d:'".$fila['LEFT(`fecha`, 10)']."',registros:".$fila['COUNT(*)']."},";
			$ultimaFecha = $fila['LEFT(`fecha`, 10)'];
		}
		$salidaFechas = substr($salidaFechas,0,-1);
		$salidaFechas .= "],xkey: 'd',ykeys: ['registros'],labels: ['Registros'],smooth: false});";
		echo $salidaFechas;
	}
	$numFilas = $resultadoFechas->num_rows - 1;
	$resultadoFechas->data_seek(0);
	$fechaInicial = $resultadoFechas->fetch_row();
	$resultadoFechas->data_seek($numFilas);
	$fechaFinal = $resultadoFechas->fetch_row();
	$fechaInicial = new DateTime($fechaInicial[0]);
	$fechaFinal = new DateTime($fechaFinal[0]);
	$queryNumReg = "SELECT COUNT(*) FROM `registrodocentes` WHERE `pais`='".$_GET['pais']."'";
}
if (isset($_GET['pais'])) { // Aplica para todos los admins
	$fechaInicial = $fechaInicial->format("j")." de ".$meses[$fechaFinal->format("n")]." de ".$fechaInicial->format("Y");
	$fechaFinal = $fechaFinal->format("j")." de ".$meses[$fechaFinal->format("n")]." de ".$fechaFinal->format("Y");
	$resultadoNumReg = $mysqli->query($queryNumReg);
	$numReg = $resultadoNumReg->fetch_row();
	$queryParticipacion = "SELECT `pais`, COUNT(*) FROM `registrodocentes` GROUP BY `pais`";
	$resultadoParticipacion = $mysqli->query($queryParticipacion);
?>
$('#fecha-grafico-registro').html('<?php echo "del $fechaInicial al $fechaFinal" ?>');
$('#panel-numReg .announcement-heading').html(<?php echo $numReg[0]; ?>);
$('#panel-partTotal .text-right span').html(<?php echo $numReg[0]; ?>);
$('#panel-revTotal .text-right span').html(<?php echo $numReg[0]; ?>);
<?php
	for($i = 0;$i<count($paises);$i++) {
		$pais = $paises[$i];
		$cantidad = $cantPaises[$i];
		echo "$('#panel-rev$pais .text-right span').html($cantidad);\n";
	}
	if ($_GET['pais'] == "Todos") { ?> 
Morris.Donut({
  element: 'grafico-partTotal',
  data: [
<?php
	while($fila = $resultadoParticipacion->fetch_assoc()) {
		$porcentajePart = round($fila['COUNT(*)'] / $numReg[0] * 100, 1);
		echo "{label: \"".$fila['pais']."\", value: ".$porcentajePart."},\n";
	}
?>
  ],
  colors: ['#ff0000', '#00ff00', '#0000ff', '#ff00ff'],
  formatter: function (y) { return y + "%" ;}
});
Morris.Donut({
  element: 'grafico-revTotal',
  data: [
<?php
	$queryRevision = "SELECT `estado`, COUNT(*) FROM `registrodocentes` GROUP BY `estado`";
	$resultadoRevision = $mysqli->query($queryRevision);
	$color = "";
	while($fila = $resultadoRevision->fetch_assoc()) {
		$porcentajeRev = round($fila['COUNT(*)'] / $numReg[0] * 100, 1);
		echo "{label: \"".$estados[$fila['estado']]."\", value: ".$porcentajeRev."},\n";
		$color .= "'".$colores[$fila['estado']]."',";
	}
	$color = substr($color,0,-1);
?>
  ],
  colors: [<?php echo $color; ?>],
  formatter: function (y) { return y + "%" ;}
});
<?php
	} // if ($_GET['pais'] == "Todos")
	for($i = 0;$i<count($paises);$i++) {
		$pais = $paises[$i];
		$cantidad = $cantPaises[$i];
		if ($_GET['pais'] == "Todos" || $_GET['pais'] == $pais) {		
?>
Morris.Donut({
  element: 'grafico-rev<?php echo $pais; ?>',
  data: [
<?php
		$queryRevision = "SELECT `estado`, COUNT(*) FROM `registrodocentes` WHERE `pais`='$pais'  GROUP BY `estado`";
		$resultadoRevision = $mysqli->query($queryRevision);
		$color = "";
		while($fila = $resultadoRevision->fetch_assoc()) {
			$porcentajeRev = round($fila['COUNT(*)'] / $cantidad * 100, 1);
			echo "{label: \"".$estados[$fila['estado']]."\", value: ".$porcentajeRev."},\n";
			$color .= "'".$colores[$fila['estado']]."',";
		}
		$color = substr($color,0,-1);
?>
  ],
  colors: [<?php echo $color; ?>],
  formatter: function (y) { return y + "%" ;}
});
<?php
		} // if ($_GET['pais'] == "Todos" || $_GET['pais'] == $pais)
	}// for($i = 0;$i<count($paises);$i++)
	echo "}";
	$mysqli->close();
} // if (isset($_GET['pais']))
?>