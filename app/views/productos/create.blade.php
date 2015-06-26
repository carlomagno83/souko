@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-0">
        <h3>Nuevo Producto</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'productos.store', 'class' => 'form-horizontal')) }}
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="form-group">
            {{ Form::label('provider_id', 'Proveedor:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-2">
              {{ Form::select('provider_id',[""=>'Escoja una opción'] + $providers, Input::old('provider_id'), array('class'=>'form-control')) }}
            </div>            

            {{ Form::label('marca_id', 'Marca:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-2">
              {{ Form::select('marca_id',[""=>'Escoja una opción'] + $marcas, Input::old('marca_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('tipo_id', 'Tipo:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-2">
              {{ Form::select('tipo_id',[""=>'Escoja una opción'] + $tipos, Input::old('tipo_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('modelo_id', 'Modelo:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-2">
              {{ Form::select('modelo_id',[""=>'Escoja una opción'] + $modelos, Input::old('modelo_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('material_id', 'Material:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-2">
              {{ Form::select('material_id',[""=>'Escoja una opción'] + $materials, Input::old('material_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('color_id', 'Color:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-2">
              {{ Form::select('color_id',[""=>'Escoja una opción'] + $colors, Input::old('color_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('rango_id', 'Rango:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-2">
              {{ Form::select('rango_id',[""=>'Escoja una opción'] + $rangos, Input::old('rango_id'), array('class'=>'form-control')) }}
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="form-group">
            {{ Form::label('precioventa', 'Precio Venta:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-2">
              <input type="text" name="precioventa" id="precioventa" class="form-control">
            </div>
        </div>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-0 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Crear Nuevo Rango de Productos', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
</div>
<br>
            {{ Form::label('talla_id', 'Talla:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-2">
                <select name="talla_id" class="form-control">
                  <option value="">Escoja uno...</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                  <option value="36">36</option>
                  <option value="37">37</option>
                  <option value="38">38</option>
                  <option value="39">39</option>
                  <option value="40">40</option>
                  <option value="41">41</option>
                  <option value="42">42</option>
                  <option value="43">43</option>
                  <option value="44">44</option>
                </select>
            </div>
            <br><br>
            <div>Ingrese el número de Talla si desea ingresar un solo producto, 
            de lo contrario se generará el rango establecido.</div>
            <div>A continuación pulse el botón Crear ... </div>

{{ Form::close() }}

@stop


