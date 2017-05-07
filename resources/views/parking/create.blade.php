@extends('layout')
<?php $parking_class_active = "active" ?>
<?php $page_title = "Crear Estacionamiento" ?>
@section('content')

<div>

	@include('partials/errors')

	<form method="POST" action="{{ route('parking.store') }}">
		{{ csrf_field() }}
		<fieldset class="form-group">
			<label for="parking_name">Nombre</label>
			<input class="form-control" type="text" name="parking_name" value="{{ old('parking_name') }}" />	
		</fieldset>
		
		<fieldset class="form-group">
			<label>Nit</label>
			<input class="form-control" type="text" name="nit" value="{{ old('nit') }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Teléfono</label>
			<input class="form-control" type="text" name="phone_number" value="{{ old('phone_number') }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Latitud</label>
			<input class="form-control" type="text" name="latitude" value="{{ old('latitude') }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Longitud</label>
			<input class="form-control" type="text" name="longitude" value="{{ old('longitude') }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Dirección</label>
			<input class="form-control" type="text" name="address" value="{{ old('address') }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Cantidad de espacios</label>
			<input class="form-control" type="text" name="quantity_slots" value="{{ old('quantity_slots') }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Servicios</label>
			<input class="form-control" type="text" name="services" value="{{ old('services') }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Horario</label>
			<input class="form-control" type="text" name="schedule" value="{{ old('schedule') }}" />
		</fieldset>
		
		<a href="{{ route('parking.index')}}" class="btn btn-default">Cancelar</a>
		<button class="btn btn-primary" type="submit">Crear</button>
	</form>

</div>

@endsection