@extends('layouts.layout')
<?php $page_title = "Editar Espacio" ?>
@section('content')

<div>

	@include('partials/errors')

	<form method="POST" action="{{ route('slot.update', [$slot->id]) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<fieldset class="form-group">
			<label for="slot_name">Nombre</label>
			<input class="form-control" type="text" name="slot_name" value="{{ $slot->slot_name }}" />	
		</fieldset>
		
		<fieldset class="form-group">
			<label for="vehicle_id">Vehículo</label>
			<input class="form-control" type="text" name="vehicle_id" value="{{ $slot->vehicle_id }}" />
		</fieldset>
		
		<fieldset class="form-group">
			<label for="vehicle_type_id">Tipo</label>
			<select id="vehicle_type_id" name="vehicle_type_id" class="form-control">
				<option value="0">--Seleccione--</option>
				@foreach($types as $type)
          			<option value="{{$type->id}}" 
          				{{ $type->id == $slot->vehicle_type_id ? 'selected' : ''}}>
          				{{$type->vehicle_type_name}}</option>
        		@endforeach
			</select>
		</fieldset>

		<a href="{{ route('slot.index', [$slot->parking_id])}}" class="btn btn-default">Cancelar</a>
		<button class="btn btn-primary" type="submit">Guardar</button>
	</form>

</div>

@endsection