@extends('layouts.user.layout')
<?php $favorite_class_active = "active" ?>
<?php $page_title = "Mis favoritos" ?>
@section('content')

<!--<div class="row placeholders">-->
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
  <div class="table-responsive">
            
         
  <table id="grid" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Telefono</th>
                  <th>Horario</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
			    @foreach ($parkings as $parking)
                  <tr>
                    <td>{{ $parking->id }}</td>
                    <td>{{ $parking->parking_name }}</td>
                    <td>{{ $parking->phone_number }}</td>
                    <td>{{ $parking->schedule }}</td>
                    <td>
                        <a href="{{ route('parking.detail', [$parking->id]) }}" class="btn btn-default">
                          Detalle
                        </a>
                    </td>
                    
                  </tr>
                @endforeach
              </tbody>
  </table>
	 </div>
	{{ $parkings->links() }}
<!--</div>-->


@endsection