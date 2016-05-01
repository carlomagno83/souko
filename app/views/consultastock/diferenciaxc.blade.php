<html>
<head>
<body>


<table>
<thead> 
        <tr>
        <th>Fecha</th>
        <th>Vendedor</th>
        <th>Local</th>
        <th>Cod mercad</th>
        <th>Descrip Prod</th>
        <th>P. Suger</th>
        <th>P. Venta</th>
        <th>Diferencia</th>
        </tr>
</thead> 
<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td> {{$value->fechadocumento}}</td> 
        <td> {{$value->desusuario  }}</td>
        <td> {{$value->codlocal3}}</td> 
        <td> {{$value->mercaderia_id}}</td> 
        <td> {{$value->codproducto31}}</td> 
        <td> {{$value->sugerido}}</td> 
        <td> {{$value->precioventa}}</td> 
        <td> {{$value->diferencia}}</td> 
    </tr>
@endforeach
</tbody>
</table>
</div>

</body>
</html>
