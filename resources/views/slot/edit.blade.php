@extends('layout')
<?php $page_title = "Editar Espacio" ?>
@section('content')

<div>

	@include('partials/errors')

	<form method="POST" action="{{ route('slot.update', [$slot->id]) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<fieldset class="form-group">
			<label for="parking_name">Nombre</label>
			<input class="form-control" type="text" name="slot_name" value="{{ $slot->slot_name }}" />	
		</fieldset>
		
		<fieldset class="form-group">
			<label>Vehículo</label>
			<input class="form-control" type="text" name="vehicle_id" value="{{ $slot->vehicle_id }}" />
		</fieldset>
		
		<a href="{{ route('slot.index', [Request::segment(4)])}}" class="btn btn-default">Cancelar</a>
		<button class="btn btn-primary" type="submit">Guardar</button>
	</form>

</div>

@endsection