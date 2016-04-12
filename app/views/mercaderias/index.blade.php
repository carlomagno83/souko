@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Mercaderias</h3>
<!--
<p>{{ link_to_route('mercaderias.create', 'Agregar Nueva Mercaderia', null, array('class' => 'btn btn-lg btn-success')) }}</p>
-->
<form method="POST" action="{{url('mercaderias-filtrar')}}">
<div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="provider_id">Proveedor</span>
                {{Form::select('provider_id', [0=>''] + DB::table('providers')->orderby('desprovider')->lists('desprovider','id'), Input::get('provider_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="marca_id">Marca</span>
                {{Form::select('marca_id',[0=>''] + DB::table('marcas')->orderby('desmarca')->lists('desmarca','id'), Input::get('marca_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="tipo_id">Tipo</span>
                {{Form::select('tipo_id', [0=>''] + DB::table('tipos')->orderby('destipo')->lists('destipo','id'), Input::get('tipo_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="rango_id">Rango</span>
                {{Form::select('rango_id',[0=>''] + DB::table('rangos')->orderby('desrango')->lists('desrango','id'), Input::get('rango_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="modelo_id">Modelo</span>
                {{Form::select('modelo_id',[0=>''] + DB::table('modelos')->orderby('desmodelo')->lists('desmodelo','id'), Input::get('modelo_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="material_id">Material</span>
                {{Form::select('material_id', [0=>''] + DB::table('materials')->orderby('desmaterial')->lists('desmaterial','id'), Input::get('material_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="color_id">Color</span>
                {{Form::select('color_id',[0=>''] + DB::table('colors')->orderby('descolor')->lists('descolor','id'), Input::get('color_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
        </div>

        <br>
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="material_id">Local</span>
                {{Form::select('local_id', [0=>''] + DB::table('locals')->orderby('codlocal3')->lists('codlocal3','id'), Input::get('local_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="color_id">Estado</span>
                {{Form::select('estado_id',[0=>''] + DB::table('estados')->orderby('codestado3')->lists('codestado3','id'), Input::get('estado_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->        
</div>  
<br>
<div class="row">
    <div class="col-lg-10">
    </div>
    <div class="col-lg-2">
                <button type="submit" class="btn btn-info">Filtrar</button>
    </div><!-- /.col-lg-6 -->     
</div> 
</form>

@if (count($mercaderias)>0)
<div>Mostrando {{count($mercaderias)}} Mercadería(s)</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Proveed</th>
				<th>Id</th>
				<th>Producto cod 31</th>
				<th>Local id</th>
				<th>Estado</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($mercaderias as $mercaderia)
				<tr>
					<td>{{{ $mercaderia->codprovider3 }}}</td>
					<td>{{{ $mercaderia->id }}}</td>
					<td>{{{ $mercaderia->codproducto31 }}}</td>
					<td>{{{ $mercaderia->codlocal3 }}}</td>
					@if ($mercaderia->estado=='ACT')
					    <td><input type="text" value="{{ $mercaderia->estado }}" readonly class="form-control"></td>
					@else
					    <td class="danger"><input value="{{ $mercaderia->estado }}" readonly class="form-control"></td>
					@endif  
					<td>{{{ $mercaderia->desusuario }}}</td>
                    <td>
                        {{ link_to_route('mercaderias.edit', 'Editar', array($mercaderia->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
No hay mercaderías con esas características
@endif

@stop
