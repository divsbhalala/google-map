<!DOCTYPE html>
<html>
    <head>
        <title>Place searches</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <style>
            html, body, #map-canvas {
                height: 100%;
                margin: 0px;
                padding: 0px
            }
        </style>

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
        <script>
           // var x = document.getElementById("demo");

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                   // x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }
 $lat='-33.8665433';
            $long='151.1956316';
            function showPosition(position) {
              //  x.innerHTML = "Latitude: " + position.coords.latitude +
                      //  "<br>Longitude: " + position.coords.longitude;
                       $lat=position.coords.latitude;
            $long=position.coords.longitude;
                        google.maps.event.addDomListener(window, 'load', initialize(position.coords.latitude,position.coords.longitude));
                      console.log(position.coords.latitude);
                      console.log(position.coords.longitude);
                  } 
                var map;
            var infowindow;
            
            function initialize() {
                var pyrmont = new google.maps.LatLng($lat,$long);

                map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: pyrmont,
                    zoom: 15
                });

                var request = {
                    location: pyrmont,
                    radius: 500,
                    types: ['store']
                };
                infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, callback);
            }

            function callback(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    for (var i = 0; i < results.length; i++) {
                        createMarker(results[i]);
                    }
                }
            }

            function createMarker(place) {
                var placeLoc = place.geometry.location;
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });

                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.setContent(place.name);
                    infowindow.open(map, this);
                });
            }
           
            google.maps.event.addDomListener(window, 'load', initialize);
            
            

        </script>
    </head>
    <body>
        <p>Click the button to get your coordinates.</p>

        <button onclick="getLocation()">Try It</button>

        <p id="demo"></p>

        <div id="map-canvas"></div>
    </body>
</html>