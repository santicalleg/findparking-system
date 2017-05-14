//******************************************************************************************************************************************************
//******************************************************************************************************************************************************
//FUNCIONES UTILIZADAS PARA LOS MAPAS DE GOOGLE
//******************************************************************************************************************************************************
//******************************************************************************************************************************************************

var apikey = 'AIzaSyBXAvarIf2XRk1An2XF-eRR1cTbRF5d-qA';
//variable que se utliza para la funcion de busqueda por direccion
var geocoder = new google.maps.Geocoder();
//Direccion de medellin
var latLng = new google.maps.LatLng(6.235925, -75.57513699999998);
//Array para guardar los puntos
var puntos = [];
var auxPuntos = [];

var lineaRuta = new google.maps.Polyline({
    strokeColor: "#FF0000",
    strokeOpacity: 0.5,
    strokeWeight: 4
});

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

//Inicializa el mapa y adiciona el point que permite ser arrastrado por el mapa, tambien pinta los puntos que el usuario tenga guardados
function initialize() {
    //le asigna el mapa al div mapCanvas
    var mapaNodo = document.getElementById('mapaNodo');
    //latLng = new google.maps.LatLng(document.getElementById("LatCiudad").value, document.getElementById("LonCiudad").value);
    if (mapaNodo == null) {
        var map = new google.maps.Map(document.getElementById('mapaRuta'), {
            zoom: 13,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP    
        });
        GetMarkers(map);
        // GetRutas(map);
        // $("#hora").spinner({ min: 0, max: 23 });
        // $("#minutos").spinner({ min: 0, max: 59 });
        // $("#puestos").spinner({ min: 1, max: 4 });
    }
    else {
        var map = new google.maps.Map(mapaNodo, {
            zoom: 13,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP    
        });
        //punto que permite ser arrastrado por el mapa
        var marker = new google.maps.Marker({
            position: latLng,
            title: 'Estacionamiento',
            map: map,
            draggable: true,
            //icon: "../Content/Icons/car1.gif"
        });

        //funcion para autocompletar direcciones en el campo. No funciona muy bien pero es util
        var input = document.getElementById('addressinput');
        var options = {
            types: ['geocode']
        };
        var autocomplete = new google.maps.places.Autocomplete(input, options);

        // actualiza la informacion actual del punto que permite ser arrastrado
        updateMarkerPosition(latLng);
        geocodePosition(latLng);

        //Adiciona el evento que al empezar a arrastrar el punto muestre el mensaje.
        google.maps.event.addListener(marker, 'dragstart', function () {
            updateMarkerAddress('Buscando la ubicación...');
        });
        //Adiciona el evento que permite arrastrar el punto
        google.maps.event.addListener(marker, 'drag', function () {
            updateMarkerPosition(marker.getPosition());
        });
        //Adiciona el evento que al soltar el punto en dicha posicion calcula su correspondiente lat y lon
        google.maps.event.addListener(marker, 'dragend', function () {
            geocodePosition(marker.getPosition());
        });
        //llama la funcion para pintar todos los punto que tenga el usuario guardados
        //GetMarkers(map);

        var userLat = document.getElementById("latitude").value;
        var userLng = document.getElementById("longitude").value;

        if (document.getElementById("id") !== null && document.getElementById("id").value > 0) {
            SearchAddress(true);
        }
    }
}

//Se trato de utilizar en el modulo de busqueda de rutas para mostrar el mapa en una ventana modal diferente a la jquery
function MostrarModal() {
    el = document.getElementById("detalleRC");
    if (el.style.visibility == "hidden") {
        mapaDetalleRuta();
    }
    el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";

}


//Funcion que permite obtener la ubicacion de un lugar dada su direccion
function geocodePosition(pos, isPolitical) {
        geocoder.geocode({
            latLng: pos
        }, function (responses) {
            if (responses && responses.length > 0) {
                updateMarkerAddress(responses[0].formatted_address);
            } else {
                updateMarkerAddress('No se logro ubicar la dirección.');
            }
        });
    
}

//Actualiza la posicion en los campos Lat y Lon al mover el point en el mapa
function updateMarkerPosition(latLng) {
    document.getElementById('latitude').value = latLng.lat().toString();
    document.getElementById('longitude').value = latLng.lng().toString();
}

//Funcion que permite mostrar la direccion devuelta por google en el control que se llame address
function updateMarkerAddress(str) {
    document.getElementById('address').value = str;
}

//Funcion utilizada para trazar la ruta entre dos puntos que se escogen en los combos de busqueda o creacion de rutas
function TraceRoute() {
    var nodoSalida = $("#NodoSalida option:selected").text();
    var nodoLlegada = $("#NodoLlegada option:selected").text();
    var puestos = document.getElementById("puestos");
    var pointSal;
    var pointLle;
    var map = new google.maps.Map(document.getElementById('mapaRuta'), {
        zoom: 13,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    GetMarkers(map);

    if (nodoSalida != '' && nodoLlegada != '') {
       

        for (var j = 0; j < puntos.length; ++j) {
            var name = puntos[j].getTitle();
            if (name == nodoSalida) {
                pointSal = new google.maps.LatLng(puntos[j].getPosition().lat(), puntos[j].getPosition().lng());
                geocodePosition(puntos[j].getPosition(), 1);
            }
            if (name == nodoLlegada) {
                pointLle = new google.maps.LatLng(puntos[j].getPosition().lat(), puntos[j].getPosition().lng());
                geocodePosition(puntos[j].getPosition(), 2);
            }
            

        }

        directionsDisplay = new google.maps.DirectionsRenderer();

        var request =
                {
                    origin: pointSal,
                    destination: pointLle,
                    travelMode: google.maps.TravelMode.DRIVING
                };

        directionsService.route(
                    request, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay = new google.maps.DirectionsRenderer({ suppressMarkers: true, polylineOptions: lineaRuta });
                            directionsDisplay.setMap(map);
                            //directionsDisplay.setDirections(response);
                            directionsDisplay.setDirections(result);
                        }
                    }
                            );

        //Pinta la ruta en el mapa
        //lineaRuta.setMap(map);
        if (puestos != null) {
            GetRutas(map);
        }
    }
    else {
        if (nodoSalida != '') {
            for (var j = 0; j < puntos.length; ++j) {
                var name = puntos[j].getTitle();
                if (name == nodoSalida) {
                    geocodePosition(puntos[j].getPosition(), 1);
                }
            }
        }
        else {
            if (nodoLlegada != '') {
                for (var j = 0; j < puntos.length; ++j) {
                    var name = puntos[j].getTitle();
                    if (name == nodoLlegada) {
                        geocodePosition(puntos[j].getPosition(), 2);
                    }
                }
            }
        }
    }
    

}


//funcion asincrona de ajax que permite pintar los puntos del usuario en el mapa
function GetMarkers(map) {
    //google.maps.LatLngBounds, esta funcion permite pintar una especie de rectangulo para delimitar la vista del mapa
    var infoWindow = new google.maps.InfoWindow({ content: "Cargando..." });
           for (var i = 0; i < data.length; i++) {
                //obtiene la posicion del nodo
                var point = new google.maps.LatLng($("#latitude").val(), $("#longitude").val());
                var imagen = document.getElementById("iconr").value; // "../Content/Icons/parkinggarage.png";
                //declara el punto que se ira a pintar en el mapa
                var marker = new google.maps.Marker({
                    title: data[i].Nombre,
                    position: point,
                    map: map,
                    icon: imagen,
                    html: data[i].Nombre
                });

                // var sunCircle = {
                //     strokeColor: "#069ba5",
                //     strokeOpacity: 0.8,
                //     strokeWeight: 1,
                //     fillColor: "#069ba5",
                //     fillOpacity: 0.1,
                //     map: map,
                //     center: point,
                //     radius: 1500 // in meters
                // };

                // cityCircle = new google.maps.Circle(sunCircle);
                // cityCircle.bindTo('center', marker, 'position');

                //guarda el punto en el array
                puntos.push(marker);

                //adiciona el punto al mapa y declara el evento para que al dar click en el punto muestre la info
                google.maps.event.addListener(marker, "click", function () {
                    infoWindow.setContent(this.html);
                    infoWindow.open(map, this);
                });
            }
       
}

//Funcion para mostrar el detalle de la ruta con su correspondiente ubicacion en el mapa
function mapaDetalleRuta() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var NodoSalLat = document.getElementById('NodoSalLat').value;
    var NodoSalLon = document.getElementById('NodoSalLon').value;
    var NodoLleLat = document.getElementById('NodoLleLat').value;
    var NodoLleLon = document.getElementById('NodoLleLon').value;

    var pointSal = new google.maps.LatLng(NodoSalLat, NodoSalLon);
    var pointLle = new google.maps.LatLng(NodoLleLat, NodoLleLon);

    var map = new google.maps.Map(document.getElementById('mapaRutaDetalle'), {
        zoom: 12,
        center: pointSal,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var point = pointSal;
    var imagen = document.getElementById("iconr").value;
    for (var i = 0; i < 2; i++) {
        if (i == 1) {
            point = pointLle;
        }
        var marker = new google.maps.Marker({
            title: 'Nodo',
            position: point,
            icon: imagen,
            map: map
        });

    }

//    //Se define el nodo de salida y el de llegada
//    var ruta = [
//                    pointSal,
//                    pointLle
//                ];

//    //    //A partir de las direcciones de los nodos se instancia el objeto que pintara una linea naranja
//    var lineaRuta = new google.maps.Polyline({
//        path: ruta,
//        strokeColor: "#a3c02f",
//        strokeOpacity: 1.0,
//        strokeWeight: 4
//    });

//    //    //Pinta la ruta en el mapa
//    lineaRuta.setMap(map);

    var request =
                {
                    origin: pointSal,
                    destination: pointLle,
                    travelMode: google.maps.TravelMode.DRIVING
                };

    lineaRuta = new google.maps.Polyline({
        strokeColor: "#a3c02f",
        strokeOpacity: 1.0,
        strokeWeight: 4
    });



    directionsService.route(
                    request, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay = new google.maps.DirectionsRenderer({ suppressMarkers: true, polylineOptions: lineaRuta });
                            directionsDisplay.setMap(map);
                            //directionsDisplay.setDirections(response);
                            directionsDisplay.setDirections(result);
                        }
                    }
                            );

}

//Funcion para buscar un lugar dada su direccion
function SearchAddress(hasAddress) {
    geocoder = new google.maps.Geocoder();
    var address = "";
    if (hasAddress) {
        address = document.getElementById("address").value;
    }
    else
    {
        address = document.getElementById("addressinput").value;
    }
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latLng = results[0].geometry.location;
            var map = new google.maps.Map(document.getElementById('mapaNodo'), {
                zoom: 13,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: latLng,
                title: 'Estacionamiento',
                map: map,
                draggable: true
            });

            // Update current position info.
            updateMarkerPosition(latLng);
            geocodePosition(latLng);

            // Add dragging event listeners.
            google.maps.event.addListener(marker, 'dragstart', function () {
                updateMarkerAddress('Buscando la ubicación...');
            });

            google.maps.event.addListener(marker, 'drag', function () {
                updateMarkerPosition(marker.getPosition());
            });

            google.maps.event.addListener(marker, 'dragend', function () {
                geocodePosition(marker.getPosition());
            });
            //GetMarkers(map);
        }
        else {
            console.log("Geocode no fue satisfactorio por la siguiente razón: " + status);
        }
    });

}

//Evento para el boton buscar por direccion en la creacion de nodos
function BuscarDireccion() {
    SearchAddress();
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);


//*************************************
//DistanceMatrix es para calcular los kilometros entre dos puntos
//*************************************
