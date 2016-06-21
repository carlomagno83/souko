<html>
<head>
<body>


<table>
<thead>
	<tr>
		<td>Doc ID</td>
		<td>Fecha</td>
		<td>Anho</td>
		<td>Mes</td>
		<td>Dia</td>
		<td>Vendedora</td>
		<td>Stand</td>
		<td>Id mercaderia</td>
		<td>Descripcion</td>
		<td>P. Venta</td>
		<td>Subtotal</td>
		<td>P Costo</td>
		<td>Ganancia</td>
		<td>Sub Ganancia</td>
	</tr>
</thead>
<tbody>

<?php 
	$max=count($mercaderias);
	$i=1;
	$subtotal=0;
	$gantot=0;
?>
@foreach( $mercaderias as $key=>$value)
    <tr> 
    	<td> {{$value->id}}</td>
        <td> {{$value->fechadocumento}}</td> 
        <td> {{date("Y", strtotime($value->fechadocumento))}}</td> 
        <td> {{date("n", strtotime($value->fechadocumento))}}</td> 
        <td> {{date("j", strtotime($value->fechadocumento))}}</td> 
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
        <td> {{$value->compra}}</td> 
        <td> {{$value->ganancia}}</td> 
        <?php $gantot = $gantot + $value->ganancia; ?>
        @if($i==$max)
        	<td>{{$gantot}}</td>
        @else
	        @if($mercaderias[$i]->id==$value->id)
	        	<td></td>
	        @else
	        	<td>{{$gantot}}</td>
	        	<?php $gantot = 0; ?>
	        @endif
	    @endif    
	    <?php $i++ ?>        
    </tr>
@endforeach
</tbody>
</table>
</div>

</body>
</html>
