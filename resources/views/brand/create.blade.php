@extends('layout')

@section('content')

<div>

	<h2>Create Brand</h2>
	
	@include('partials/errors')

	<form method="POST" action="{{ route('brand.store') }}">
		{{ csrf_field() }}
		<fieldset class="form-group">
			<label for="brand_name">Nombre</label>
			<input class="form-control" type="text" name="brand_name" value="{{ old('brand_name') }}" />
		</fieldset>

		<a href="{{ route('brand.index')}}" class="btn btn-danger" type="submit">Cancelar</a>
		<button class="btn btn-primary" type="submit">Crear</button>
	</form>

</div>

@endsection