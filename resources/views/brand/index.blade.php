@extends('layout')

@section('content')

<div>
	<h2>Brands</h2>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<p>
		<a class="btn btn-primary" href="/brand/create">Add a brand</a>
	</p>

	<ul>
		@foreach ($brands as $brand)
		<li>
			<span>{{ $brand->brand_name }}</span>
			<a href="/brand/edit/{{ $brand->brand_id }}" class="btn btn-info">Edit</a>
			<form method="POST" action="/brand/destroy/{{ $brand->brand_id }}">
				<input type="hidden" name="_token" value={{ csrf_token() }}>
				<input type="hidden" name="_method" value="DELETE">
				<button type="submit" class="btn btn-danger">Eliminar</button>
			</form>
		</li>
		@endforeach
	</ul>
	
	{{ $brands->links() }}

</div>

@endsection