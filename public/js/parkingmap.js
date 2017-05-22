function initMap() {

    var defaultLocation = new google.maps.LatLng(6.235925, -75.57513699999998);

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: defaultLocation,
    });
}

function getParkings() {
    
}