@extends('layouts.user.layout')

<?php 
  $page_title = "Parquear";
?>

@section('content')

<div id="map" style="height:600px; width: 100%;"></div>

@endsection

@section('scripts')

<script src="{{ asset ("/js/parkingmap.js") }}" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBXAvarIf2XRk1An2XF-eRR1cTbRF5d-qA&region=CO&libraries=places&callback=initMap"></script>

@endsection