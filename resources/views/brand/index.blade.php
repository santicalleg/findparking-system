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
			<span>{{ $brand->brand_name }}</span>
			<a href="/brand/edit/{{ $brand->brand_id }}">Edit</a>
			<a href="/brand/delete/{{ $brand->brand_id }}">Edit</a>
		</li>
		@endforeach
	</ul>
	
	{{ $brands->links() }}

</div>

@endsection