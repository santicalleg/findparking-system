@extends('layout')

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
                  <th colspan="2">Acciones</th>
                </tr>
              </thead>
              <tbody>
			          @foreach ($parkings as $parking)
                  <tr>
                    <td>{{ $parking->parking_id }}</td>
                    <td>{{ $parking->parking_name }}</td>
                    <td>{{ $parking->nit }}</td>
                    <td><a href="{{ route('parking.edit', [$parking->parking_id]) }}" class="btn btn-info">Editar</a></td>
                    <td>
                        <form method="POST" action="{{ route('parking.destroy', [$parking->parking_id]) }}">
                          <input type="hidden" name="_token" value={{ csrf_token() }}>
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-danger">Eliminar</button>
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