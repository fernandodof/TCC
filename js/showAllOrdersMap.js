var ordersMap;
function initializeOrders(orders) {
   
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    ordersMap = new google.maps.Map(document.getElementById("map-order-canvas"), mapOptions);

    var marker;
    for (var i in orders) {
        var position = new google.maps.LatLng(orders[i].latitude, orders[i].longitude);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: ordersMap,
            title: orders[i].data
        });
        ordersMap.fitBounds(bounds);
    }

//    var boundsListener = google.maps.event.addListener((ordersMap), 'bounds_changed', function(event) {
//        this.setZoom(14);
//        google.maps.event.removeListener(boundsListener);
//    });

//
    resizeOrdersMap();

}
//google.maps.event.addDomListener(window, 'load', initialize);

google.maps.event.addDomListener(window, "resize", resizingOrdersMap());

//$('#myMapModal').on('show.bs.modal', function () {
//    //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
//    resizeMap();
//});

function resizeOrdersMap() {
    if (typeof ordersMap === "undefined")
        return;
    setTimeout(function () {
        resizingOrdersMap();
    }, 400);
}

function resizingOrdersMap() {
    if (typeof ordersMap === "undefined")
        return;
    var center = ordersMap.getCenter();
    google.maps.event.trigger(map, "resize");
    ordersMap.setCenter(center);
}