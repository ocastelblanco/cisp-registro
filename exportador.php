<?php
if (isset($_GET['tipo']) && isset($_GET['pais'])){
	$columnas = array("id",
					"nombreIE",
					"pais",
					"departamento",
					"municipio",
					"zonaIE",
					"direccionIE",
					"telefonoIE",
					"emailIE",
					"nombres",
					"apellidos",
					"cargo",
					"area",
					"grado",
					"direccion",
					"telefono",
					"email",
					"descripcionperfil",
					"nombreIP",
					"nivelIP",
					"otroNivelIP",
					"poblacionIP_estudiantes",
					"poblacionIP_docentes",
					"poblacionIP_directivas",
					"poblacionIP_padres",
					"poblacionIP_miembros",
					"poblacionIP_otros",
					"poblacionIP_otrosTexto",
					"poblacionIP_estudiantesCant",
					"poblacionIP_docentesCant",
					"poblacionIP_directivasCant",
					"poblacionIP_padresCant",
					"poblacionIP_miembrosCant",
					"poblacionIP_otrosCant",
					"tiempoIP",
					"resumenIP",
					"contextoIP",
					"justificacionIP",
					"marcoIP",
					"objetivosIP",
					"metodologiaIP",
					"seguimientoIP",
					"proyeccionIP",
					"anexoIP1",
					"anexoIP2",
					"anexoIP3",
					"estado",
					"notificado",
					"fecha");
	$titulos = array("ID",
					"Nombre de la Institución Educativa (IE)",
					"País",
					"Departamento/Provincia/Estado",
					"Municipio/Población",
					"Tipo de zona de la IE",
					"Dirección de la IE",
					"Teléfono de la IE",
					"Correo electrónico de la IE",
					"Nombres",
					"Apellidos",
					"Cargo/s",
					"Área de conocimiento",
					"Grado/s a cargo",
					"Dirección de residencia",
					"Teléfono fijo / Celular",
					"Correo electrónico del docente",
					"Descripción del perfil del docente",
					"Nombre de la Iniciativa Pedagógica (IP)",
					"Nivel en que se ejecuta la IP",
					"Otro nivel en que se ejecuta la IP",
					"¿Se dirige esta IP a estudiantes?",
					"¿Se dirige esta IP a docentes?",
					"¿Se dirige esta IP a directivos?",
					"¿Se dirige esta IP a padres de familia?",
					"¿Se dirige esta IP a miembros de la comunidad?",
					"¿Se dirige esta IP a otra población?",
					"¿Qué tipo de otra población?",
					"Cantidad de estudiantes hacia los que se dirige esta IP",
					"Cantidad de docentes hacia los que se dirige esta IP",
					"Cantidad de directivos hacia los que se dirige esta IP",
					"Cantidad de padres de familia hacia los que se dirige esta IP",
					"Cantidad de miembros de la comunidad hacia los que se dirige esta IP",
					"Cantidad de otra población hacia los que se dirige esta IP",
					"Tiempo de ejecución de la IP",
					"Resumen de la IP",
					"Descripción de la situación o contexto de la IP",
					"Justificación de la IP",
					"Marco conceptual de la IP",
					"Objetivos de la IP",
					"Metodología de la IP",
					"Seguimiento, evaluación y monitoreo de la IP",
					"Proyección de la IP",
					"Nombre del archivo anexo 1",
					"Nombre del archivo anexo 2",
					"Nombre del archivo anexo 3",
					"Aprobación de la IP",
					"¿El docente ha sido notificado por correo electrónico?",
					"Fecha de registro");
	require_once 'lib/PHPExcel.php';
	$objPHPExcel = new PHPExcel();
	if ($_GET['tipo'] != 'csv') {
		$objPHPExcel->getProperties()->setCreator("Oliver Castelblanco M.")
									 ->setLastModifiedBy("Oliver Castelblanco M.")
									 ->setTitle("Registro de iniciativas para el curso virtual CIUDADANÍAS")
									 ->setSubject("Registro de iniciativas para el curso virtual CIUDADANÍAS")
									 ->setDescription("Registro de iniciativas para el curso virtual CIUDADANÍAS")
									 ->setKeywords("registro iniciativas ciudadanias curso virtual")
									 ->setCategory("Sistema de registro");
		for ($i=0;$i<count($titulos);$i++) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue(letraCelda($i)."1", $titulos[$i]);
			$objPHPExcel->getActiveSheet()->getColumnDimension(letraCelda($i))->setWidth(strlen($titulos[$i])+2);
			$objPHPExcel->getActiveSheet()->getStyle(letraCelda($i)."1")->getFont()->setBold(true);
		}								 
	} else {
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", 'username');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B1", 'password');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C1", 'firstname');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D1", 'lastname');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1", 'email');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F1", 'course1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", 'group1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H1", 'city');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I1", 'phone1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J1", 'address');
	}
	$hoy = date('Y-m-d');
	require_once 'lib/config.php';
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	if ($_GET['pais'] != 'Todos') {
		$comp = " WHERE `pais`='".$_GET['pais']."'";		
	} else {
		$comp = "";
	}
	$query = "SELECT * FROM `registrodocentes`".$comp;
	$resultado = $mysqli->query($query);
	$numFila = 2;
	$numFilas = 0;
	while($fila = $resultado->fetch_assoc()) {
		$boleano = array('NO', 'SI');
		$tiempoIP = array(	'planificacion'=>'Está en su fase de planificación todavía',
							'menos1'=>'Menos de 1 año',
							'1y2'=>'Entre 1 año y 2 años',
							'2y3'=>'Entre 2 años y 3 años',
							'mas3'=>'Más de 3 años');
		$estado = array('Pendiente de aprobación', 'Aprobado', 'Descartado');
		if($_GET['tipo'] != 'csv') {
			for ($i=0;$i<count($columnas);$i++) {
				$celda = letraCelda($i).$numFila;
				$contenidoCelda = $fila[$columnas[$i]];
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($celda, $contenidoCelda);
				if (substr($columnas[$i],0,8) == 'telefono') {
					$objPHPExcel->getActiveSheet()->getCell($celda)->setValueExplicit($contenidoCelda, PHPExcel_Cell_DataType::TYPE_STRING);
				}
				if ($columnas[$i] == 'fecha') {
					$objPHPExcel->getActiveSheet()->getStyle($celda)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
				}
				if ((substr($columnas[$i],0,11) == 'poblacionIP' && substr($columnas[$i],-4) != 'Cant' && substr($columnas[$i],-5) != 'Texto') || $columnas[$i] == 'notificado') {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($celda, $boleano[$contenidoCelda]);
				}
				if ($columnas[$i] == 'tiempoIP') {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($celda, $tiempoIP[$contenidoCelda]);
				}
				if ($columnas[$i] == 'estado') {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($celda, $estado[$contenidoCelda]);
				}

			}
			$numFila++;		
			$numFilas++;
		} else {
			if ($fila['estado'] == '1') {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$numFila, $fila['email']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$numFila, substr($fila['email'], 0,strpos($fila['email'], '@')));
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$numFila, $fila['nombres']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$numFila, $fila['apellidos']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$numFila, $fila['email']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$numFila, 'CursoCiudadanias');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$numFila, $fila['pais']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$numFila, $fila['municipio']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$numFila, $fila['telefono']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$numFila, $fila['direccion']);
				$numFila++;		
				$numFilas++;
			}
		}					 
	}
	$mysqli->close();
	$objPHPExcel->getActiveSheet()->setTitle('Registro');
	$objPHPExcel->setActiveSheetIndex(0);
	$nombreArchivo = 'uploads/RegistroCiudadanias-'.$hoy.'.'.$_GET['tipo'];
	if ($_GET['tipo'] == 'xlsx') {
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	}
	if ($_GET['tipo'] == 'xls') {
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	}
	if ($_GET['tipo'] == 'csv') {
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setDelimiter(',')
	                                                                  ->setEnclosure('')
	                                                                  ->setLineEnding("\r\n")
	                                                                  ->setSheetIndex(0);
	}
	$objWriter->save($nombreArchivo);
	echo json_encode(array("resultado"=>true, "nombreArchivo"=>$nombreArchivo, "numFilas"=>$numFilas));
}
function letraCelda($num) {
	$letras = floor(($num+1)/27);
	if($letras>0) {
		$letra1 = "A";
		$letra2 = chr(($num-26)+65);
	} else {
		$letra1 = "";
		$letra2 = chr($num+65);
	}
	$salida = $letra1.$letra2;
	return $salida;
}
?>