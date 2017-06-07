@extends('layouts.user.layout')

<?php 
  $page_title = "Estacionar";
?>

@section('content')

<!--Modal-->
<div id="windowModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p id="modal-body-message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
</div>

<div id="map" style="height:600px; width: 100%;"></div>

@endsection

@section('scripts')

<script src="{{ asset ('/js/parkingmap.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBXAvarIf2XRk1An2XF-eRR1cTbRF5d-qA&region=CO&libraries=places&callback=initMap"></script>

@endsection