var map = null;
var userPos = {};
var directionsService = null;
var directionsDisplay = null;

function initMap() {

    var defaultLocation = new google.maps.LatLng(6.235925, -75.57513699999998);

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: defaultLocation,
    });

	directionsService = new google.maps.DirectionsService;
	directionsDisplay = new google.maps.DirectionsRenderer;

    getParkings(map);
    getLocation(map);
}

function getLocation(map) {
	// Try HTML5 geolocation.
	if (navigator.geolocation) {
    	navigator.geolocation.getCurrentPosition(function(position) {
        	var pos = {
            	lat: position.coords.latitude,
              	lng: position.coords.longitude
            };

            userPos = pos;

            var marker = new google.maps.Marker({
          		position: userPos,
          		icon: {
            		path: google.maps.SymbolPath.CIRCLE,
            		scale: 5
          		},
          		title: 'Mi ubicación',
          		map: map
        	});

            map.setCenter(pos);
          }, function() {
			console.log("Geolocalization service failed");
          });
	} else {
          // Browser doesn't support Geolocation
    	console.log("Browser doesn't support geolocation");
	}
}

function getParkings(map) {
	$.ajax({
		type: 'GET',
  		url: 'parking/getAll',
  		contentType: 'application/json',
  		success: function(data, status, jqXHR) {
  			onSuccess(data, status, jqXHR, map);
  		},
  		error: onError
	});
}

function onSuccess(data, status, jqXHR, map)
{
	var parkings = jQuery.parseJSON(data);

	$.each(parkings, function(index, value) {
		var lat = parseFloat(value.latitude);
		var lng = parseFloat(value.longitude);

		var marker = new google.maps.Marker({
			position: { lat: lat, lng: lng },
			map: map,
			title: value.parking_name
		});

		marker.addListener('click', function() {
			var infowindow = getMarkerInfoWindow(value);
  			infowindow.open(map, marker);
		});
	});

}

function onError(textStatus, errorThrown) {
	console.log(errorThrown);
}

function getMarkerInfoWindow(parking) {
	var infowindow = new google.maps.InfoWindow({
    		content: getMarkerContent(parking)
  		});

	return infowindow;
}

function getMarkerContent(parking) {
	var content = '<div id="content">'+
      	'<div id="siteNotice">'+
      	'</div>'+
      	'<h2 id="firstHeading" class="firstHeading">'+parking.parking_name+'</h2>'+
		'<div id="bodyContent">'+
		'<p><b>Celdas disponibles: </b>'+parking.available_slots+'</p>'+
		'<p><b>Teléfono: </b>'+parking.phone_number+'</p>'+
		'<p><b>Dirección: </b>'+parking.address+'</p>'+
		'<p><b>Servicios: </b>'+parking.services+'</p>'+
		'<p><b>Horario: </b>'+parking.schedule+'</p>'+
		'<div>'+
		'<button data-parking-lat='+parking.latitude+' data-parking-lng='+parking.longitude+' class="col-md-4 btn btn-default" onclick="route(this)">Ruta</button>'+
		'<a class="col-md-4 btn btn-default" href="/parking/detail/'+parking.id+'">Detalle</a>'+
  		'<button data-parking-id='+parking.id +' class="col-md-4 btn btn-default" onclick="checkIn(this)">Estacionar</button>'+
		'</div>'+
        '</div>'+
        '</div>';

	return content;
}

function checkIn(data) {
	console.log("checkIn");
	var parking_id = data.getAttribute('data-parking-id');
	$.ajax({
		type: 'POST',
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
  		url: 'checkin/store',
  		contentType: 'application/json',
		data: JSON.stringify({ 'parking_id': parking_id }),
  		success: function(data, status, jqXHR) {
  			console.log("success");
  			$(".modal-title").html("Felicidades");
  			$("#modal-body-message").html("Has estacionado correctamente!");
  			$("#windowModal").modal();
  		},
  		error: function(textStatus, errorThrown) {
			console.log("error: " + textStatus.responseText);
			if (textStatus.status >= 400 || textStatus.status < 500) {
				$(".modal-title").html("Advertencia");
			}
			else {
				$(".modal-title").html("Error");
			}
  			$("#modal-body-message").html(textStatus.responseText);
  			$("#windowModal").modal();
		}
	});

	console.log("async");
}

function route(data) {
	var lat = data.getAttribute('data-parking-lat');
	var lng = data.getAttribute('data-parking-lng');

	var pos = { lat: parseFloat(lat), lng: parseFloat(lng) };
	
	if (userPos) {
        directionsDisplay.setMap(null);

        if (map != null) {
        	directionsDisplay.setMap(map);

        	directionsService.route({
        		origin: userPos,
        		destination: pos,
        		travelMode: 'DRIVING'
        	}, function(response, status){
        		if (status === 'OK') {
        			directionsDisplay.setDirections(response);
        		} else {
        			console.log('status: '+ status + '\n response: ' + response);
        		}
        	});
        }
	}
}