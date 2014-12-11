var templateRoot;

function setLocation() {
    navigator.geolocation.getCurrentPosition(showLocation);
}

function showLocation(position) {
    document.getElementById('loc').innerHTML = position.coords.latitude + "," + position.coords.longitude;
    var from = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var to = new google.maps.LatLng(-6.889332, -38.545292);
    document.getElementById('dis').innerHTML = google.maps.geometry.spherical.computeDistanceBetween(from, to);
}

function getLocation() {
    navigator.geolocation.getCurrentPosition(obtainLocation);
}


function obtainLocation(pos) {
    var latLong = pos.coords.latitude + "," + pos.coords.longitude;
    var data = {latLong: latLong};
    var url = templateRoot + 'src/app/ajaxReceivers/setLocation.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
            alert(textStatus);
            alert(jqXHR);
        }
    });
}

function getNearByWithCoodinates() {
    navigator.geolocation.getCurrentPosition(searchNearBy);
}


function searchNearBy(pos) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    var url = templateRoot + 'src/app/ajaxReceivers/searchNearBy.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
            alert(textStatus);
            alert(jqXHR);
        }
    });
}

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
    getLocation();
});

