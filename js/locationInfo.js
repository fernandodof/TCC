function getLocation() {
    navigator.geolocation.getCurrentPosition(showLocation);
}

function showLocation(position){
    document.getElementById('loc').innerHTML = position.coords.latitude+","+position.coords.longitude;
    var from = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var to = new google.maps.LatLng(-6.889332,-38.545292);
    document.getElementById('dis').innerHTML = google.maps.geometry.spherical.computeDistanceBetween(from,to);
}