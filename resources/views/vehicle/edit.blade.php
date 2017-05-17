@extends('layouts.user.layout')
<?php $brand_class_active = "active" ?>
<?php $page_title = "Editar vehículo" ?>
@section('content')

<div>
	@include('partials/errors')
	
	<form method="POST" action="{{ route('vehicle.update', [$vehicle->id]) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		{{ csrf_field() }}

		<fieldset class="form-group">
			<label for="vehicle_type_id">Tipo</label>
			<select id="vehicle_type_id" name="vehicle_type_id" class="form-control">
				<option value="0">--Seleccione--</option>
				@foreach($types as $type)
          			<option value="{{$type->id}}" 
          				{{ $type->id == $vehicle->vehicle_type_id ? 'selected' : ''}}>
          				{{$type->vehicle_type_name}}</option>
        		@endforeach
			</select>
		</fieldset>

		<fieldset class="form-group">
			<label for="last_digit">Placa</label>
			<input class="form-control" type="text" name="last_digit" value="{{ $vehicle->last_digit }}" />	
		</fieldset>

		<fieldset class="form-group">
			<label for="brand_id">Marca</label>
			<select id="brand_id" name="brand_id" class="form-control">
				<option value="0">--Seleccione--</option>
				@foreach($brands as $brand)
          			<option value="{{$brand->id}}"
          			{{ $brand->id == $vehicle->brand_id ? 'selected' : ''}}>
          			{{$brand->brand_name}}</option>
        		@endforeach
			</select>
		</fieldset>

		<fieldset class="form-group">
			<label for="color_id">Color</label>
			<select id="color_id" name="color_id" class="form-control">
				<option value="0">--Seleccione--</option>
				@foreach($colors as $color)
					<option value="{{$color->id}}"
          			{{ $color->id == $vehicle->color_id ? 'selected' : ''}}>
          			{{ $color->color_name }}</option>
        		@endforeach
			</select>
		</fieldset>

		<a href="{{ route('vehicle.index') }}" class="btn btn-default">Cancelar</a>
		<button class="btn btn-primary" type="submit">Guardar</button>
	</form>

</div>

@endsection