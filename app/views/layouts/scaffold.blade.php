<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sistema de Almacén</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

	<link href="{{url('css/neon.bootstrap.css')}}" rel="stylesheet">
	<link href="{{url('css/style.css')}}" rel="stylesheet">


  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('img/apple-touch-icon-144-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('img/apple-touch-icon-114-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('img/apple-touch-icon-72-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" href="{{asset('img/apple-touch-icon-57-precomposed.png')}}">
  <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
  
	<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>


	@yield('styles')

</head>

<body>
<div class="container">

	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default" role="navigation">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">

						<li class="dropdown">
							<a style="padding-top: 8px;" href="{{URL::to('/')}}"><img width="30px" src="{{asset('img/home2.png')}}"></a>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Maestros<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
							@if( Auth::user()->rolusuario=='SUPER' )
								<li>
									<a href="{{URL::to('/marcas')}}">Marcas</a>
								</li>
								<li>
									<a href="{{URL::to('/tipos')}}">Tipos</a>
								</li>
								<li>
									<a href="{{URL::to('/modelos')}}">Modelos</a>
								</li>
								<li>
									<a href="{{URL::to('/rangos')}}">Rangos</a>
								</li>
								<li>
									<a href="{{URL::to('/colors')}}">Colores</a>
								</li>								
								<li>
									<a href="{{URL::to('/materials')}}">Materiales</a>
								</li>
								<li role="presentation" class="divider"></li>
								<li>
									<a href="{{URL::to('/users')}}">Usuarios</a>
								</li>								
								<li>
									<a href="{{URL::to('/locals')}}">Locales</a>
								</li>
								<li>
									<a href="{{URL::to('/providers')}}">Proveedores</a>
								</li>
								<li role="presentation" class="divider"></li>
								<li>
									<a href="{{URL::to('/productos')}}">Productos</a>
								</li>	
							@endif							
								<li>
									<a href="{{URL::to('/mercaderias')}}">Mercaderias</a>
								</li>																
							</ul>
						</li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ingresos<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{URL::to('/ingresos-proveedor-create')}}">Nuevo ingreso Proveedor</a>
								</li>
 								<li>
									<a href="{{URL::to('/eliminacionguia')}}">Eliminar Guía de Ingreso</a>
								</li>
								<li role="presentation" class="divider"></li>								
 								<li>
									<a href="{{URL::to('/reimprimeguiaentrada')}}">Re-imprimir etiquetas</a>
								</li>
							</ul>
						</li>						
					
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operaciones con Pto de Vta<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{URL::to('/trasladoalmacpto')}}">Traslados de Almacén a Pto de Venta</a>
								</li>
								<li>
									<a href="{{URL::to('/trasladoptopto')}}">Traslados de Pto a Pto</a>
								</li>
								<li>
									<a href="{{URL::to('/ventas')}}">Ventas</a>
								</li>
							</ul>
						</li>	
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Devoluciones<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
<!--								<li>
									<a href="devolucionproveedor">Devoluciones a Proveedor</a>
								</li>-->
								<li>
									<a href="{{URL::to('/generaguiadev')}}">Genera guía de devolución</a>
								</li>
								<li>
									<a href="{{URL::to('/liquidacionguiadev')}}">Liquidación de Guía de Devolución</a>
								</li>								
								<li>
									<a href="{{URL::to('/devolucionptoventa')}}">Devoluciones de Pto de Venta</a>
								</li>
							</ul>
						</li>	
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{URL::to('/reporte-muestra')}}">Reporte de ingresos</a>
								</li>
								<li>
									<a href="{{URL::to('/reporteventa')}}">Reporte de Ventas</a>
								</li>
								<li>
									<a href="{{URL::to('/reportestock')}}">Reporte de stock</a>
								</li>
							</ul>
						</li>
					</ul>					

					<!--<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input class="form-control" type="text">
						</div> <button type="submit" class="btn btn-default">Buscar</button>
					</form>-->
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a >Hola, {{ Auth::user()->username }}</a>
						</li>						
						<li>
							<a href="{{ url('logout') }}">Salir</a>
						</li>
					</ul>
				</div>
			</nav>
			<div class="jumbotron">
			    <div class="row">
			        <div class="col-md-12">

			            @if (Session::has('message'))
			                <div style="color: #FE2E2E" class="alert">
			                    <p>{{ Session::get('message') }}</p>
			                </div>
			            @endif     

			        </div>
			    </div>
					@yield("main")
			</div>
		</div>
	</div>
</div>


	@yield('scripts')

</body>
</html>
