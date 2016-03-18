
<html>
<head>

<style type="text/css">
.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
</style>


</head>

<h1>All Movimientos</h1>

@if ($movimientos->count())
	<table class="tftable" border="1">

		<thead>
			<tr>
				<th>Movimientos_id</th>
				<th>Dcoumentos_fecha</th>
				<th>Mercaderia_id</th>
				<th>Producto_id</th>	
				<th>codProducto31</th>								
				<th>Precio Venta</th>
			

			</tr>
		</thead>
         
		<tbody>
			@foreach ($movimientos as $movimiento)
				<tr>
					<td>{{{ $movimiento->id }}}</td>
					<td>{{{ $movimiento->fechadocumento }}}</td>	
					<td>{{{ $movimiento->mercaderia_id }}}</td>					
					<td>{{{ $movimiento->producto_id }}}</td>
					<td>{{{ $movimiento->codproducto31 }}}</td>
					<td>{{{ $movimiento->precioventa }}}</td>

				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no movimientos
@endif


