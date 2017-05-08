@extends('layout')
<?php $parking_class_active = "active" ?>
<?php $page_title = "Listado de Estacionamientos" ?>
@section('content')

<!--<div class="row placeholders">-->
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<p>
		<a class="btn btn-primary" href="{{ route('parking.create') }}">Crear Estacionamiento</a>
	</p>
  <div class="table-responsive">

  <table id="grid" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Nit</th>
                  <th colspan="3">Acciones</th>
                </tr>
              </thead>
              <tbody>
			          @foreach ($parkings as $parking)
                  <tr>
                    <td>{{ $parking->id }}</td>
                    <td>{{ $parking->parking_name }}</td>
                    <td>{{ $parking->nit }}</td>
                    <td>
                      <a href="{{ route('parking.edit', [$parking->id]) }}" title="Editar" class="btn btn-default">
                        <span class="fa fa-pencil"></span>
                      </a>
                    </td>
                    <td>
                      <a href="{{ route('slot.index', [$parking->id]) }}" title="Espacios" class="btn btn-default">
                        <span class="fa fa-automobile"></span>
                      </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('parking.destroy', [$parking->id]) }}">
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
	{{ $parkings->links() }}
<!--</div>-->


@endsection