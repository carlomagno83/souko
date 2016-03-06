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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


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

    <style>
        .error{
            color: red;
        }
    </style>


	<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>

    <!-- Validate Forms -->
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/additional-methods.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/messages_es.js')}}"></script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


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

						@if( Auth::user()->rolusuario!='VENDE' )	
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
                                @endif

                                <li role="presentation" class="divider"></li>
                                <li>
                                    <a href="{{URL::to('/productos')}}">Productos</a>
                                </li>
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
								<!--<li>
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
						@endif					

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<strong class="caret"></strong></a>
							<ul class="dropdown-menu">

								@if( Auth::user()->rolusuario!='VENDE' )		
								<li>
									<a href="{{URL::to('/consultastockadm')}}">Consulta stock (Administ)</a>
								</li>
								<li>
									<a href="{{URL::to('/consultastockdet')}}">Consulta stock (Detallado)</a>
								</li>

								<li>
									<a href="{{URL::to('/consultaventa')}}">Consulta de Ventas por vendedor</a>
								</li>
								@endif

								<li>
									<a href="{{URL::to('/reportestock')}}">Reporte de stock (descarga Excel)</a>
								</li>


							</ul>
						</li>



                        @if( Auth::user()->rolusuario=='SUPER' )							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Correcciones<strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="documentoeditar">Editar documento</a>
									</li>
									<li role="presentation" class="divider"></li>
									<li>
										<a href="{{URL::to('/registroagregar')}}">Agregar registro</a>
									</li>
									<li>
										<a href="{{URL::to('/registroeliminar')}}">Eliminar registro</a>
									</li>
									<li>
										<a href="{{URL::to('/registroeditar')}}">Editar registro (P. venta)</a>
									</li>
								</ul>
							</li>
						@endif			

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
