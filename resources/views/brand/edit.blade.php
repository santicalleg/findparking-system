@extends('layout')

@section('content')

<div>

	<h2>Edit Brand</h2>
	
	@include('partials/errors')

	<form method="POST" action="{{ route('brand.update', [$brand->brand_id]) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<fieldset class="form-group">
			<label for="brand_name">Nombre</label>
			<input class="form-control" type="text" name="brand_name" value="{{ $brand->brand_name }}" />	
		</fieldset>
		
		<a href="{{ route('brand.index')}}" class="btn btn-danger" type="submit">Cancelar</a>
		<button class="btn btn-primary" type="submit">Editar</button>
	</form>

</div>

@endsection