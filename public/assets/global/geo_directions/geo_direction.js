var map,
    currentPosition,
    directionsDisplay,
    directionsService,
    currentLatitude = 59.3426606750,
    currentLongitude = 18.0736160278,
    destinationLatitude = 59.3426606750,
    destinationLongitude = 18.0736160278;

function initializeMapAndCalculateRoute(currentLatitude, currentLongitude, destinationLatitude, destinationLongitude) {
    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsService = new google.maps.DirectionsService();

    destinationLatitude = destinationLatitude;
    destinationLongitude = destinationLongitude;
    currentPosition = new google.maps.LatLng(currentLatitude, currentLongitude);

    map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 15.82,
        center: currentPosition,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    directionsDisplay.setMap(map);

    var currentPositionMarker = new google.maps.Marker({
        position: currentPosition,
        map: map,
        title: "Current position"
    });

    // current position marker info
    /*
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(currentPositionMarker, 'click', function() {
        infowindow.setContent("Current position: latitude: " + currentLatitude +" longitude: " + currentLongitude);
        infowindow.open(map, currentPositionMarker);
    });
    */

    // calculate Route
    calculateRoute(destinationLatitude, destinationLongitude);
}

function locError(error) {
    // the current position could not be located
}

function locSuccess(position) {
    // initialize map with current position and calculate the route
    initializeMapAndCalculateRoute(position.coords.latitude, position.coords.longitude);
}

function calculateRoute(destinationLatitude, destinationLongitude) {

    var targetDestination = new google.maps.LatLng(destinationLatitude, destinationLongitude);

    if (currentPosition != '' && targetDestination != '') {

        var request = {
            origin: currentPosition,
            destination: targetDestination,
            travelMode: google.maps.DirectionsTravelMode["DRIVING"]
        };

        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setPanel(document.getElementById("directions"));
                console.log(response);
                directionsDisplay.setDirections(response);

                /*
                    var myRoute = response.routes[0].legs[0];
                    for (var i = 0; i < myRoute.steps.length; i++) {
                        alert(myRoute.steps[i].instructions);
                    }
                */
                // $("#results").show();
            }
            else {
                // $("#results").hide();
            }
        });
    }
    else {
        // $("#results").hide();
    }
}