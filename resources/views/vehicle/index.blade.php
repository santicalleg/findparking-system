@extends('layouts.user.layout')
<?php $vehicle_class_active = "active" ?>
<?php $page_title = "Mis vehículos" ?>
@section('content')

<!--<div class="row placeholders">-->
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<p>
		<a class="btn btn-primary" href="{{ route('vehicle.create') }}">Crear vehículo</a>
	</p>
  <div class="table-responsive">
            
         
  <table id="grid" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Tipo</th>
                  <th>Marca</th>
                  <th>Color</th>
                  <th colspan="2">Acciones</th>
                </tr>
              </thead>
              <tbody>
			          @foreach ($vehicles as $vehicle)
                  <tr>
                    <td>{{ $vehicle->id }}</td>
                    <td>{{ $vehicle->last_digit }}</td>
                    <td>{{ $vehicle->vehicle_type->vehicle_type_name }}</td>
                    <td>{{ $vehicle->Brand->brand_name }}</td>
                    <td>{{ $vehicle->Color->color_name }}</td>
                    <td><a href="{{ route('vehicle.edit', [$vehicle->id]) }}" class="btn btn-default"><span class="fa fa-pencil"></span></a></td>
                    <td>
                        <form method="POST" action="{{ route('vehicle.destroy', [$vehicle->id]) }}">
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
	{{ $vehicles->links() }}
<!--</div>-->


@endsection