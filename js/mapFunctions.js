var map;
var marker;
var templateRoot;
function initMap() {
    var latitude = $('#latitude').val();
    var longitude = $('#longitude').val();
    var nomeRestaurante = $('#nomeRestauranteMap').val();
    var myLatlng = new google.maps.LatLng(Number(latitude), Number(longitude));
    var mapOptions = {
        zoom: 16,
        center: myLatlng
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        animation: google.maps.Animation.DROP,
        title: nomeRestaurante
    });
    setTimeout("toggleBounce()", 1000);
    google.maps.event.addListener(marker, 'click', toggleBounce);
}

function toggleBounce() {

    if (marker.getAnimation() != null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
        setTimeout(function (){marker.setAnimation(null);},2100);
    }
}



google.maps.event.addDomListener(window, 'load', initMap);
google.maps.event.addDomListener(window, "resize", function () {
    $('#map').width($('#bigMap-modal-body').width() - 25).height($('#bigMap-modal-body').height());
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
});

function expandMap() {
    $('#bigMap').show();
    $('#map').width($('#bigMap-modal-body').width() - 25).height($('#bigMap-modal-body').height());
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
    $('#map2').empty();
    $('#map').appendTo('#map2');
}

function closeMap() {
    $('#bigMap').hide();
    $('#map').width('200px').height('200px');
    $('#location').html("<div id='map'></div>");
    initMap();
}

