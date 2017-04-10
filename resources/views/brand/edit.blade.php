@extends('layout')

@section('content')

<div>

	<h2>Edit Brand</h2>
	
	@include('partials/errors')

	<form method="POST" action="/brand/update/{{ $brand->brand_id}}">
		{{ csrf_field() }}
		<input type="text" name="brand_name" value="{{ $brand->brand_name }}" />
		<button type="submit">edit brand</button>
	</form>

</div>

@endsection