@extends('layouts.user.layout')

<?php $page_title = "$parking->parking_name" ?>

@section('content')

<div>
	<div id="success-message" class="alert alert-info hidden">
		Su comentario se ha guardado exitosamente
	</div>
	<div id="error-message" class="alert alert-danger hidden"></div>

	<fieldset class="form-group">
		<a id="favorite" href="#" class="btn btn-default" title="Agregar a favoritos" value="0">
			<span class="fa fa-plus-circle"></span>
			<span>Agregar a favoritos</span>
		</a>
	</fieldset>

	<fieldset>
		<label>Calificación</label>
		<p id="rating">{{ $parking->rating }}</p>
		<input id="parking-rating" type="text" class="rating-loading"
        value="{{ $parking->rating }}" data-size="xs" data-min="0" data-max="5" />
	</fieldset>

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
	<fieldset class="form-group">
		<h3>Califica este parqueadero</h3>
		<input id="user-rating" type="text" class="rating-loading" 
			data-size="xs" data-min="0" data-max="5" data-step="1" />

		<label for="comment">Deja tu comentario</label>
		<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
		<input type="hidden" id="parking_id" name="parking_id" value="{{ $parking->id }}">
		<intput type="hidden" id="id" name="id" value="0"></intput>
	</fieldset>

	<a href="{{ route('checkin.index')}}" class="btn btn-default">Cancelar</a>
	<button id="send" class="btn btn-primary" type="submit">Enviar</button>
</div>

@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset ('/js/rating.js') }}"></script>

@endsection