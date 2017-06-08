@extends('layouts.user.layout')

<?php $page_title = "$parking->parking_name" ?>

@section('content')

<div>
	<fieldset class="form-group">
		<label>Dirección</label>
		<div>
			<span>{{ $parking->address }}</span>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label>Teléfono</label>
		<div>
			<span>{{ $parking->phone_number }}</span>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label>Horario</label>
		<div>
			<span>{{ $parking->schedule }}</span>
		</div>
	</fieldset>
	
	<fieldset class="form-group">
		<label>Servicios</label>
		<div>
			<span>{{ $parking->services }}</span>
		</div>
	</fieldset>
</div>

<div>
	<form method="POST">
		<fieldset class="form-group">
			<h3>Califica este parqueadero</h3>
			<input id="input-id" type="text" class="rating" value="2" 
				data-size="xs" data-min="0" data-max="5" data-step="1" />

			<label for="comment">Deja tu comentario</label>
			<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
			<input type="hidden" name="parking_id" value="{{ $parking->id }}">
		</fieldset>
	</form>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(function() {
		$("#input-id").rating();
	});
</script>

@endsection