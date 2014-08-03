<link href="../css/restaurant.css" rel="stylesheet">
<script type="text/javascript" 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrV71CPZi1AWL4oTCwtJ1B1Km5BKPXu9I&sensor=TRUE">
</script>
<script type="text/javascript" src="../js/LoadMap.js"></script>
<script type="text/javascript">
    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(-6.887496, -38.560768),
            zoom: 15
        };
        var map = new google.maps.Map(document.getElementById("map"),
                mapOptions);
        var map2 = new google.maps.Map(document.getElementById("map2"),
                mapOptions);
    }
    google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div class="container" onload="setTimeout('initialize()', 2000);">
    <div class="visible-sm visible-xs">
        <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target=".restaurant">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </button>
    </div>

    <div class="restauntContainer col-md-3">
        <div class="restaurant collapse navbar-collapse">
            <img src="../images/logos/pizza_place.png" class="img img-thumbnail img-responsive restaurantLogo"/>
            <p> Nome da Pizzaria</p>
            <img src="../images/icons/rsz_location.png" class="pull-left addressIcon">
            <address>Rua: Nome da Rua, Numero: 10, Cidade: Cajazeiras, Estado: PB, CEP: 58.900-000</address>

            <div id="location">
                <div id="map" class="col-xs-12" style="width:100%;height:100%;">
                </div>
            </div>
        </div>
        <a href="#bigMap" data-toggle="modal">Expandir Mapa</a>
    </div>

    <div class="menu col-md-9 col-sm-12">
        <h2>Cardápio</h2>
        <div class="col-sm-12">
            <div class="col-sm-6"><p class="header">Ítem</p></div>
            <div class="col-sm-6 visible-lg visible-md">
                <p class="header">Tamanho</p>
                <div class="col-sm-4"><p>Péquena</p></div>
                <div class="col-sm-4"><p>Média</p></div>
                <div class="col-sm-4"><p>Grande</p></div>
            </div>
        </div>
        {for $i=0 to $size}
            <div class="col-md-12 col-xs-12 itemDiv pull-left">
                <div class="col-md-6 col-xs-12 itemName"><p class="iName">{$itens[$i]}</p> <p class="ingedients">{$ingredients[$i]}</p></div>
                <div class="col-md-6 col-xs-12 prices">
                    <div class="col-md-4 col-xs-12 price"><p class="pull-left"><span class="visible-sm visible-xs">Pequena</span> R${$precoP[$i]},00</p><button class="btn btn-sm pull-right"><span class="glyphicon glyphicon-plus"></span></button></div>
                    <div class="col-md-4 col-xs-12 price"><p class="pull-left"><span class="visible-sm visible-xs">Media</span>R${$precoM[$i]},00</p><button class="btn btn-sm pull-right"><span class="glyphicon glyphicon-plus"></span></button></div>
                    <div class="col-md-4 col-xs-12 price"><p class="pull-left"><span class="visible-sm visible-xs">Grande</span>R${$precoG[$i]},00</p><button class="btn btn-sm pull-right"><span class="glyphicon glyphicon-plus"></span></button></div>
                </div>
            </div>
        {/for}
    </div>

    <div class="modal" id="bigMap" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div id="location">
                        <div id="map2" class="col-xs-12" style="height: 400px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>