@extends('layout')
<?php $parking_class_active = "active" ?>
<?php $page_title = "Editar Parqueadero" ?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBXAvarIf2XRk1An2XF-eRR1cTbRF5d-qA&region=CO&libraries=places"></script>
<script src="{{ asset ("/js/gmaptools.js") }}" type="text/javascript"></script>

@section('content')

<div>

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
			<label>Dirección</label>
			<input class="form-control" type="text" id="address" name="address" value="{{ $parking->address }}" readonly />
		</fieldset>

		<div id="divMapNodo">
            <table>
                <tr>
                    <td>
                        <input id="addressinput" type="text" style="width: 250px" />
                    </td>
                    <td>
                        <button type="button" id="btnBuscarDir" class="btn btn-default" onclick="return BuscarDireccion()"><span class="fa fa-search"></span></button>
                    </td>
                </tr>
            </table>
            <div id="mapaNodo" style="height: 350px; width: 350px;">
            </div>
        </div>

		<input class="form-control" type="hidden" id="latitude" name="latitude" value="{{ $parking->latitude }}" />
		<input class="form-control" type="hidden" id="longitude" name="longitude" value="{{ $parking->longitude }}" />

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
		
		<a href="{{ route('parking.index')}}" class="btn btn-default">Cancelar</a>
		<button class="btn btn-primary" type="submit">Guardar</button>
	</form>

</div>

@endsection