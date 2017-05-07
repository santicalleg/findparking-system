@extends('layout')
<?php $brand_class_active = "active" ?>
<?php $page_title = "Listado de Marcas" ?>
@section('content')

<!--<div class="row placeholders">-->
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<p>
		<a class="btn btn-primary" href="{{ route('brand.create') }}">Crear marca</a>
	</p>
  <div class="table-responsive">
            
         
  <table id="grid" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th colspan="2">Acciones</th>
                </tr>
              </thead>
              <tbody>
			          @foreach ($brands as $brand)
                  <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->brand_name }}</td>
                    <td><a href="{{ route('brand.edit', [$brand->id]) }}" class="btn btn-default"><span class="fa fa-pencil"></span></a></td>
                    <td>
                        <form method="POST" action="{{ route('brand.destroy', [$brand->id]) }}">
                          <input type="hidden" name="_token" value={{ csrf_token() }}>
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-default"><span class="fa fa-trash"></span></button>
                        </form>
                    </td>
                    
                  </tr>
                @endforeach
              </tbody>
  </table>
	 </div>
	{{ $brands->links() }}
<!--</div>-->


@endsection