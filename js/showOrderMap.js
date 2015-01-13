var map;
function initialize(lat, long) {
    var myCenter = new google.maps.LatLng(lat, long);
    var marker = new google.maps.Marker({
        position: myCenter
    });

    var mapProp = {
        center: myCenter,
        zoom: 16
    };

    map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
    marker.setMap(map);

    google.maps.event.addListener(marker, 'click', function () {

        infowindow.setContent(contentString);
        infowindow.open(map, marker);
    });
    resizeMap();

}
;
//google.maps.event.addDomListener(window, 'load', initialize);

google.maps.event.addDomListener(window, "resize", resizingMap());

$('#myMapModal').on('show.bs.modal', function () {
    //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
    resizeMap();
});

function resizeMap() {
    if (typeof map === "undefined")
        return;
    setTimeout(function () {
        resizingMap();
    }, 400);
}

function resizingMap() {
    if (typeof map === "undefined")
        return;
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
}