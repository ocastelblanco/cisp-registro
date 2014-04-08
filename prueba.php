<?php
if (isset($_POST) && count($_POST)>0) {
	print_r($_POST);
	echo "<br><br>";
	print_r($_FILES);
} else {
?>
<!DOCTYPE html>
<html>
  <head>
<!--  	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de registro para el curso CIUDADANÍAS de CISP">
    <meta name="author" content="Oliver Castelblanco M. para CISP">
    <link rel="shortcut icon" href="ico/favicon.png">
-->    
    <title>Ficha de convocatoria de docentes - CIUDADANÍAS</title>
    <!-- Bootstrap core CSS -->
<!--
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Estilos propios -->
<!--
    <link href="css/registro-cisp.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->	
  </head>

  <body>
  	<form method="post" action="prueba.php"><!-- enctype="multipart/form-data"> -->
  		<input type="text" id="nombre" name="nombre">
  		<br>
  		<input type="file" id="archivo" name="archivo">
  		<br>
  		<input type="submit" value="NOW!" >
  	</form>
<!--  
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Abrir/cerrar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#instrucciones"><img src="img/ciudadanias.png" class="img-responsive"></a>
        </div>
        <div id="navegacion" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#ie">Datos de la Institución Educativa</a></li>
            <li><a href="#docente">Datos del docente</a></li>
            <li><a href="#ip">Iniciativa pedagógica</a></li>
          </ul>
        </div><!--/.nav-collapse -->
<!--        
      </div>
    </div>
    
    <div id="instrucciones" class="page-header">
		<h1>Ficha de convocatoria</h1>
		<p>A continuación encontrará una ficha que le solicitamos diligenciar sobre su iniciativa pedagógica.</p>
		<p>Agradecemos anexar cualquier material concerniente a la iniciativa pedagógica, como archivos adjuntos.</p>
		<p>Si tiene dudas sobre el diligenciamiento de este formulario, escíbanos a: <a href="mailto:cursociudadanias@gmail.com">cursociudadanias@gmail.com</a></p>
    </div><!-- /.page-header -->
<!--    
	<form role="form" id="formulario" method="post" action="prueba.php">
	    <div class="container">
			<div class="row">
				<div class="col-md-12">
    				<div class="form-group">
    					<label for="nombres">Nombres</label>
    					<input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese sus nombres completos" required>
  					</div>
				</div>
			</div><!-- /.row -->
<!--			
			<div class="row">
				<div class="form-group col-sm-12">
					<input type="file" name="anexoIP1" class="form-control">
				</div>
	    	</div><!-- /.row -->
<!--	    	
			<div class="row">
				<div class="col-md-3">
					<button type="submit" id="enviarForm" class="btn btn-primary">Enviar información</button>
				</div>
				<div class="col-md-9">
					<div id="alertaPoblacionIP" class="alert alert-danger">
						Texto de relleno
					</div>
				</div>
			</div><!-- /.row -->
<!--			
	    </div><!-- /.container -->
<!--	    
	</form><!-- /.form -->
<!--	
	<div class="footer">
		<div class="container">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-6 copyright">2014® CIUDADANÍAS</div>
			<div class="col-md-4">
				<img src="img/logoOEI.jpg">
				<img src="img/logoMercosur.jpg">
				<img src="img/logoParlamentoJuvenil2014.jpg">
			</div><!-- /.col-md-4 -->
<!--			
			<div class="col-md-1">&nbsp;</div>
		</div><!-- /.container -->
<!--		
	</div><!-- /.footer -->
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<!--    
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="js/registro-cisp.js"></script>
	<script type="text/javascript">
		if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) { //test for MSIE x.x;
			var ieversion=new Number(RegExp.$1); // capture x.x portion and store as a number
			if (ieversion<9) {
				$('body').html('<div style="color: #FFFFFF;">Su navegador es obsoleto y no es compatible con esta plataforma. Por favor actualice su sistema <a href="http://windows.microsoft.com/es-co/internet-explorer/download-ie-MCM?FORM=MI09JK&amp;OCID=MI09JK">haciendo clic aquí</a></div>');
			}  
		}
	</script> 
-->	
  </body>
</html>
<?php
}
?>