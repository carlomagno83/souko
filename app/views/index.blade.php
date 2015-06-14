<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootstrap 3, from LayoutIt!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
  
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default" role="navigation">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Maestros<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="marcas">Marcas</a>
								</li>
								<li>
									<a href="tipos">Tipos</a>
								</li>
								<li>
									<a href="modelos">Modelos</a>
								</li>
								<li>
									<a href="colors">Colores</a>
								</li>								
								<li>
									<a href="materials">Material</a>
								</li>
								<li>
									<a href="rangos">Rangos</a>
								</li>
								<li>
									<a href="tallas">Tallas</a>
								</li>
								<li>
									<a href="colors">Usuarios</a>
								</li>								
								<li>
									<a href="locals">Locales</a>
								</li>
								<li>
									<a href="mercaderias">Mercadería</a>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ingresos de mercaderia<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="ingresoproveedor">Desde Proveedor</a>
								</li>
<!--								<li>
									<a href="confirmacioningreso">Confirmación de ingreso</a>
								</li>-->
							</ul>
						</li>						
					
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operaciones con Pto de Vta<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Traslados de Almacén a Pto de Venta</a>
								</li>
								<li>
									<a href="#">Traslados de Pto a Pto</a>
								</li>
								<li>
									<a href="#">Ventas</a>
								</li>
								<li>
									<a href="#">Generar Excel</a>
								</li>								
							</ul>
						</li>	
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Devoluciones<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Devoluciones a Proveedor</a>
								</li>
								<li>
									<a href="#">Devoluciones de Pto de Venta</a>
								</li>
							</ul>
						</li>	
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Reporte por ....</a>
								</li>
								<li>
									<a href="#">Reporte por ...</a>
								</li>
								<li>
									<a href="#">Reporte por ...</a>
								</li>


							</ul>
						</li>
					</ul>					
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input class="form-control" type="text">
						</div> <button type="submit" class="btn btn-default">Submit</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#">Link</a>
						</li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Action</a>
								</li>
								<li>
									<a href="#">Another action</a>
								</li>
								<li>
									<a href="#">Something else here</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">Separated link</a>
								</li>
							</ul>
						</li>


					</ul>
				</div>
				
			</nav>
			<div class="jumbotron">
					@yield("main")
			</div>
		</div>
	</div>
	<a href="{{ action('AuthController@logOut') }}">Log out</a>
</div>

</body>
</html>
