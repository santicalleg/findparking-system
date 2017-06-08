@extends('layouts.layout')
<?php 
	$page_title = "Crear Espacio";
?>
@section('content')

<div>

	@include('partials/errors')

	<form method="POST" action="{{ route('slot.store') }}">
		{{ csrf_field() }}
		<fieldset class="form-group">
			<label for="slot_name">Nombre</label>
			<input class="form-control" type="text" name="slot_name" value="{{ old('slot_name') }}" />	
		</fieldset>
		
		<fieldset class="form-group">
			<label for="vehicle_id">Vehículo</label>
			<input class="form-control" type="text" name="vehicle_id" value="{{ old('vehicle_id') }}" />
		</fieldset>
		
		<fieldset class="form-group">
			<label for="vehicle_type_id">Tipo</label>
			<select id="vehicle_type_id" name="vehicle_type_id" class="form-control">
				<option value="0">--Seleccione--</option>
				@foreach($types as $type)
          			<option value="{{$type->id}}">{{$type->vehicle_type_name}}</option>
        		@endforeach
			</select>
		</fieldset>

		<input type="hidden" name="parking_id" value="{{ $id }}">

		<a href="{{ route('slot.index', [Request::segment(4)]) }}" class="btn btn-default">Cancelar</a>
		<button class="btn btn-primary" type="submit">Crear</button>
	</form>

</div>

@endsection