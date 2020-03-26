// This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      var start;
      var end;
      var waypts=[];

      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 20.6121228, lng: -100.4802576},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);

        var input2 = document.getElementById('pac-input2');
        var searchBox2 = new google.maps.places.SearchBox(input2);

        var input3 = document.getElementById('pac-input3');
        var searchBox3 = new google.maps.places.SearchBox(input3);
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          console.log(places);
          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            start=place.geometry.location;

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
        searchBox2.addListener('places_changed', function() {
          var places = searchBox2.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          // markers.forEach(function(marker) {
          //   marker.setMap(null);
          // });
          // markers = [];
          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            end=place.geometry.location;

            // if (place.geometry.viewport) {
            //   // Only geocodes have viewport.
            //   bounds.union(place.geometry.viewport);
            // } else {
            //   bounds.extend(place.geometry.location);
            // }
          });
          // map.fitBounds(bounds);
          //dibujar ruta
          calcRoute(start,end);
        });
        searchBox3.addListener('places_changed', function() {
          var places = searchBox3.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          // markers.forEach(function(marker) {
          //   marker.setMap(null);
          // });
          // markers = [];
          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            waypts.push({
              location: place.geometry.location,
              stopover: true
            });
            calcRoute(start,end,waypts);

            // if (place.geometry.viewport) {
            //   // Only geocodes have viewport.
            //   bounds.union(place.geometry.viewport);
            // } else {
            //   bounds.extend(place.geometry.location);
            // }
          });
          // map.fitBounds(bounds);
          //dibujar ruta
        });
      }
      function calcRoute(start,end,waypts) {

 var directionsService = new google.maps.DirectionsService();
 var directionsDisplay = new google.maps.DirectionsRenderer();
  var request = {
    origin: start,
    destination: end,
    waypoints: waypts,
    travelMode: 'DRIVING'
  };
  directionsService.route(request, function(result, status) {
    if (status == 'OK') {
      directionsDisplay.setDirections(result);
    }
  });
  var mapOptions = {
    zoom:20,
    center: start
  }
  var map = new google.maps.Map(document.getElementById('map'), mapOptions);
  directionsDisplay.setMap(map);
}

//
var salida=document.getElementById("pac-input");
    var destino=document.getElementById("pac-input2");
    var paradas=document.getElementById("pac-input3");
    var fecha=document.getElementById("fecha");
    var vuelta=document.getElementById("vuelta");
    var lugares=document.getElementById("lugares");
    var precio=document.getElementById("precio");

    var slider=document.getElementById("slider");
    var mensaje=document.getElementById("mensaje");

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
  precio.value = this.value;
}

function validar(){
  if(salida.value=="" || destino.value=="" || paradas.value=="" || fecha.value=="" || vuelta.value=="" || lugares.value=="" || precio.value==""){
    mensaje.innerHTML="Debes llenar todos los campos";
    mensaje.style.visibility = "visible";
    return false;
  }else{
    console.log(salida.value+"-"+destino.value+"-"+paradas.value+"-"+fecha.value+"-"+vuelta.value+"-"+lugares.value+"-"+precio.value);
    return true;
  }
}

document.addEventListener("click",function(){
   if (vuelta.checked == true){
    vuelta.value = "1";
  } else {
    vuelta.value="0";
  }
});
