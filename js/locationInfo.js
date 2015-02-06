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
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(obtainLocation, handleError);
    }else{
        alert('not supported');
    }
    
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


function handleError(error) {
    var error;
    switch (error.code) {
        case error.PERMISSION_DENIED:
            error = 'Usuário negou a requisição para localização';
            break;
        case error.POSITION_UNAVAILABLE:
            error = 'Informação para a localização indisponível';
            break;
        case error.TIMEOUT:
            error = 'A requisição para a localização exedeu o tempo limte';
            break;
        case error.UNKNOWN_ERROR:
            error = 'Erro desconhecido';
            break;
    }
    
    var data = {error: error};
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

//function showError(error) {
//    switch(error.code) {
//        case error.PERMISSION_DENIED:
//            x.innerHTML = "User denied the request for Geolocation.";
//            break;
//        case error.POSITION_UNAVAILABLE:
//            x.innerHTML = "Location information is unavailable.";
//            break;
//        case error.TIMEOUT:
//            x.innerHTML = "The request to get user location timed out.";
//            break;
//        case error.UNKNOWN_ERROR:
//            x.innerHTML = "An unknown error occurred.";
//            break;
//    }
//}