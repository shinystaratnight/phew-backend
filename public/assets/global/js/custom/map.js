function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: lati, lng: lngi },
    zoom: 15.82,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
     marker = new google.maps.Marker({
        position: new google.maps.LatLng(lati, lngi),
        map: map
      });

     marker = new google.maps.Marker({
        position: new google.maps.LatLng(lati2, lngi2),
        map: map
      });
    }