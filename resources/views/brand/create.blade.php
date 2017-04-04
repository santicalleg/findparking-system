@extends('layout')

@section('content')

<div>

	<h2>Create Brand</h2>

	<form method="POST" action="/brand">
		{{ csrf_field() }}
		<input type="text" name="brand_name" />
		<button type="submit">Create a brand</button>
	</form>

</div>

@endsection