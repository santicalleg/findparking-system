@extends('layout')
<?php $parking_class_active = "active" ?>
<?php $page_title = "Crear Parueadero" ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBXAvarIf2XRk1An2XF-eRR1cTbRF5d-qA&region=CO&libraries=places"></script>
<script src="{{ asset ("/js/gmaptools.js") }}" type="text/javascript"></script>

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
			<label>Dirección</label>
			<input class="form-control" type="text" id="address" name="address" value="{{ old('address') }}" readonly />
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
		{{-- <fieldset class="form-group">
			<label>Latitud</label>
		</fieldset>

		<fieldset class="form-group">
			<label>Longitud</label>
		</fieldset> --}}
			<input class="form-control" type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}" />
			<input class="form-control" type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}" />

		

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