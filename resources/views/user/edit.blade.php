@extends('layouts.user.layout')
<?php $page_title = "Perfil" ?>
@section('content')

<div>

	@include('partials/errors')

    @if (Session::has('message'))
    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<form method="POST" action="{{ route('user.update', [$user->id]) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<fieldset class="form-group">
			<label for="name">Nombre de usuario</label>
			<input class="form-control" type="text" name="name" value="{{ $user->name }}" />	
		</fieldset>
		
        <fieldset class="form-group">
			<label for="email">Email</label>
			<input class="form-control" type="text" name="email" value="{{ $user->email }}" />	
		</fieldset>

        <fieldset class="form-group">
			<label for="first_name">Nombres</label>
			<input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}" />	
		</fieldset>

        <fieldset class="form-group">
			<label for="last_name">Apellidos</label>
			<input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}" />	
		</fieldset>

		<fieldset class="form-group">
			<label for="mobile_number">Celular</label>
			<input class="form-control" type="text" name="mobile_number" value="{{ $user->mobile_number }}" />	
		</fieldset>

        <fieldset class="form-group">
			<label for="password">Contraseña</label>
			<input class="form-control" type="password" name="password" />	
		</fieldset>

        <fieldset class="form-group">
			<label for="password">Confirmar contraseña</label>
			<input id="password-confirm" class="form-control" type="password" name="password_confirmation" />	
		</fieldset>

		<a href="/home" class="btn btn-default">Cancelar</a>
		<button class="btn btn-primary" type="submit">Guardar</button>
	</form>

</div>

@endsection