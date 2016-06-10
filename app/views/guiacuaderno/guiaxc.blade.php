<html>
<head>
<body>


<table>
<thead>
	<tr>
		<td>Origen</td>
		<td>Fecha</td>
		<td>Num doc</td>
		<td>Doc fisico</td>
		<td>Destino</td>
		<td>Cantidad</td>
		<td>Descripcion</td>
		<td>Costo</td>
	</tr>
</thead>
<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td> {{$value->origen}}</td> 
        <td> {{$value->fechadocumento}}</td> 
        <td> {{$value->id}}</td> 
        <td> {{$value->numdocfisico}}</td> 
        <td> {{$value->destino}}</td> 
        <td> {{$value->cantidad}}</td> 
        <td> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}}</td> 
        <td> {{$value->pcompra}}</td> 
    </tr>
@endforeach
</tbody>
</table>
</div>

</body>
</html>
