@extends('layout')

@section('content')

<div>

	<h2>Edit Brand</h2>
	
	@include('partials/errors')

	<form method="POST" action="/brand/update/{{ $brand->brand_id}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="brand_name" value="{{ $brand->brand_name }}" />
		<button type="submit">edit brand</button>
	</form>

</div>

@endsection