@extends('layouts.layout')
<?php $page_title = "Perfil" ?>
@section('content')

<div>

	@include('partials/errors')

    @if (Session::has('message'))
    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<form method="POST" action="{{ route('admin.update', [$admin->id]) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<fieldset class="form-group">
			<label for="name">Nombre de usuario</label>
			<input class="form-control" type="text" name="name" value="{{ $admin->name }}" />	
		</fieldset>
		
        <fieldset class="form-group">
			<label for="email">Email</label>
			<input class="form-control" type="text" name="email" value="{{ $admin->email }}" />	
		</fieldset>

        <fieldset class="form-group">
			<label for="administrator_first_name">Nombres</label>
			<input class="form-control" type="text" name="administrator_first_name" value="{{ $admin->administrator_first_name }}" />	
		</fieldset>

        <fieldset class="form-group">
			<label for="administrator_last_name">Apellidos</label>
			<input class="form-control" type="text" name="administrator_last_name" value="{{ $admin->administrator_last_name }}" />	
		</fieldset>

        <fieldset class="form-group">
			<label for="password">Contraseña</label>
			<input class="form-control" type="password" name="password" />	
		</fieldset>

        <fieldset class="form-group">
			<label for="password">Confirmar contraseña</label>
			<input id="password-confirm" class="form-control" type="password" name="password_confirmation" />	
		</fieldset>

		<a href="{{ route('admin.dashboard') }}" class="btn btn-default">Cancelar</a>
		<button class="btn btn-primary" type="submit">Guardar</button>
	</form>

</div>

@endsection