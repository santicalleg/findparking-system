@extends('layout')

<?php 
  $page_title = "Listado de Espacios";
?>

@section('content')

<!--<div class="row placeholders">-->
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<p>
		<a class="btn btn-primary" href="{{ route('slot.create', [Request::segment(3)]) }}">Crear espacio</a>
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
			          @foreach ($slots as $slot)
                  <tr>
                    <td>{{ $slot->id }}</td>
                    <td>{{ $slot->slot_name }}</td>
                    <td>
                      <a href="{{ route('slot.edit', [$slot->id]) }}" title="Editar" class="btn btn-default">
                        <span class="fa fa-pencil"></span>
                      </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('slot.destroy', [$slot->id]) }}">
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
	{{ $slots->links() }}
<!--</div>-->


@endsection