function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(-6.887496, -38.560768),
        zoom: 15
    };
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    google.maps.event.addDomListener(window, 'load', initialize);
}


