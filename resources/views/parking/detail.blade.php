@extends('layouts.user.layout')

<?php $page_title = "Detalle" ?>

@section('content')

<div>
	<h1>{{ $parking->parking_name}}</h1>
	
	<h2>Dirección</h2>
	<span>{{ $parking->address }}</span>

	<h2>Teléfono</h2>
	<span>{{ $parking->phone_number }}</span>

	<h2>Horario</h2>
	<span>{{ $parking->schedule }}</span>
	
	<h2>Servicios</h2>
	<span>{{ $parking->services }}</span>
</div>

@endsection