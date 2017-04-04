@extends('layout')

@section('content')

<div>
	<h2>Brands</h2>

	<p>
		<a class="btn btn-primary" href="/brand/create">Add a brand</a>
	</p>

	<ul>
		@foreach ($brands as $brand)
		<li>
			{{ $brand->brand_name}}
		</li>
		@endforeach
	</ul>

</div>

@endsection