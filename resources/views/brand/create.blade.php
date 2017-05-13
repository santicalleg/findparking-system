@extends('layouts.layout')
<?php $brand_class_active = "active" ?>
<?php $page_title = "Crear Marca" ?>
@section('content')

<div>

	@include('partials/errors')

	<form method="POST" action="{{ route('brand.store') }}">
		{{ csrf_field() }}
		<fieldset class="form-group">
			<label for="brand_name">Nombre</label>
			<input class="form-control" type="text" name="brand_name" value="{{ old('brand_name') }}" />
		</fieldset>

		<a href="{{ route('brand.index')}}" class="btn btn-default" type="submit">Cancelar</a>
		<button class="btn btn-primary" type="submit">Crear</button>
	</form>

</div>

@endsection