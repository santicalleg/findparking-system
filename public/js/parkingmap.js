function initMap() {

    var defaultLocation = new google.maps.LatLng(6.235925, -75.57513699999998);

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: defaultLocation,
    });

    getParkings(map);
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
		'<p><b>Teléfono: </b>'+parking.phone_number+'</p>'+
		'<p><b>Dirección: </b>'+parking.address+'</p>'+
		'<p><b>Servicios: </b>'+parking.services+'</p>'+
		'<p><b>Horario: </b>'+parking.schedule+'</p>'+
        '</div>'+
        '</div>';

	return content;
}