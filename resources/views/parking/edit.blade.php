@extends('layout')

@section('content')

<div>

	<h2>Editar Estacionamiento</h2>
	
	@include('partials/errors')

	<form method="POST" action="{{ route('parking.update', [$parking->id]) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<fieldset class="form-group">
			<label for="parking_name">Nombre</label>
			<input class="form-control" type="text" name="parking_name" value="{{ $parking->parking_name }}" />	
		</fieldset>
		
		<fieldset class="form-group">
			<label>Nit</label>
			<input class="form-control" type="text" name="nit" value="{{ $parking->nit }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Teléfono</label>
			<input class="form-control" type="text" name="phone_number" value="{{ $parking->phone_number }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Latitud</label>
			<input class="form-control" type="text" name="latitude" value="{{ $parking->latitude }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Longitud</label>
			<input class="form-control" type="text" name="longitude" value="{{ $parking->longitude }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Dirección</label>
			<input class="form-control" type="text" name="address" value="{{ $parking->address }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Cantidad de espacios</label>
			<input class="form-control" type="text" name="quantity_slots" value="{{ $parking->slots()->count() }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Servicios</label>
			<input class="form-control" type="text" name="services" value="{{ $parking->services }}" />
		</fieldset>

		<fieldset class="form-group">
			<label>Horario</label>
			<input class="form-control" type="text" name="schedule" value="{{ $parking->schedule }}" />
		</fieldset>
		
		<a href="{{ route('parking.index')}}" class="btn btn-danger">Cancelar</a>
		<button class="btn btn-primary" type="submit">Editar</button>
	</form>

</div>

@endsection