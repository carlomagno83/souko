<html>
<head>
<body>


<table>
<thead>
	<tr>
		<td>Doc ID</td>
		<td>Fecha</td>
		<td>Vendedora</td>
		<td>Stand</td>
		<td>Id mercaderia</td>
		<td>Descripcion</td>
		<td>P. Venta</td>
		<td>Subtotal</td>
		<td>P Costo</td>
		<td>Ganancia</td>
	</tr>
</thead>
<tbody>

<?php 
	$max=count($mercaderias);
	$i=1;
	$subtotal=0;
?>
@foreach( $mercaderias as $key=>$value)
    <tr> 
    	<td> {{$value->id}}</td>
        <td> {{$value->fechadocumento}}</td> 
        <td> {{$value->desusuario}}</td> 
        <td> {{$value->codlocal3}}</td> 
        <td> {{$value->merca_id}}</td> 
        <td> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}}</td> 
        <td> {{$value->venta}}</td> 
        <?php $subtotal = $subtotal + $value->venta; ?>
        @if($i==$max)
        	<td>{{$subtotal}}</td>
        @else
	        @if($mercaderias[$i]->id==$value->id)
	        	<td></td>
	        @else
	        	<td>{{$subtotal}}</td>
	        	<?php $subtotal = 0; ?>
	        @endif
	    @endif    
	    <?php $i++ ?>
        <td> {{$value->compra}}</td> 
        <td> {{$value->ganancia}}</td> 
    </tr>
@endforeach
</tbody>
</table>
</div>

</body>
</html>
