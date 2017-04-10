@extends('layout')

@section('content')

<div>

	<h2>Create Brand</h2>
	
	@include('partials/errors')

	<form method="POST" action="/brand/store">
		{{ csrf_field() }}
		<input type="text" name="brand_name" value="{{ old('brand_name') }}" />
		<button type="submit">Create a brand</button>
	</form>

</div>

@endsection