<link href="../css/restaurant.css" rel="stylesheet" type="text/css">
<link href="../css/cardapio.css" rel="stylesheet" type="text/css">
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

    function initMap() {
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var nomeRestaurante = $('#nomeRestauranteMap').val();
        var myLatlng = new google.maps.LatLng(Number(latitude), Number(longitude));
        var mapOptions = {
            zoom: 16,
            center: myLatlng
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        // To add the marker to the map, use the 'map' property
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: nomeRestaurante
        });
    }

    function addProduto(idForm) {
        var form = document.getElementById(idForm);
        var idProduto = form.getElementsByClassName('idProduto')[0].value;
        var idTamanho = form.getElementsByClassName('idTamanho')[0].value;
        var quantidade = form.getElementsByClassName('quantidade')[0].value;
        var xmlhttp;

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        if (xmlhttp) {
            xmlhttp.open("GET", "../src/app/ajaxReceivers/adicionarAoCarrinho.php?idProduto=" +
                    idProduto + "&idTamanho=" + idTamanho + "&quantidade=" + quantidade, true);

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4) {
                    alert(this.responseText);
                }
            };
            xmlhttp.send();
        }

    }

    google.maps.event.addDomListener(window, 'load', initMap);
    google.maps.event.trigger(map, 'resize');
</script>
<div class="container">
    <div class="visible-sm visible-xs">
        <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target=".restaurant">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </button>
    </div>

    <div class="restauntContainer col-md-3">
        <div class="restaurant collapse navbar-collapse">
            <img src="../images/logos/restaurantLogo.gif" class="img img-thumbnail img-responsive restaurantLogo"/>
            <h4 id="nomeRestaurante">{$restaurante->getNome()}</h2>
                <img src="../images/icons/rsz_location.png" class="pull-left addressIcon">
                <address>{$restaurante->getEndereco()->getLogradouro()}, {$restaurante->getEndereco()->getNumero()}, Bairro: {$restaurante->getEndereco()->getBairro()}, CEP:
                    {$restaurante->getEndereco()->getCep()}, {$restaurante->getEndereco()->getCidade()}, {$restaurante->getEndereco()->getEstado()}.</address>

                <div id="location">
                    <div id="map">
                    </div>
                </div>
        </div>
        <a href="#bigMap" data-toggle="modal">Expandir Mapa</a>
        <input type="hidden" id="latitude" value="{$restaurante->getEndereco()->getLatitude()}">
        <input type="hidden" id="longitude" value="{$restaurante->getEndereco()->getLongitude()}">
        <input type="hidden" id="nomeRestauranteMap" value="{$restaurante->getNome()}">
    </div>

    <div class="menu col-md-9 col-sm-12">
        <div id="cardapioHeader" class="row col-md-12">
            <h2>Cardápio</h2>
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle btn btn-primary" id="togglePedido" data-toggle="dropdown">Pedido <b class="caret"></b></a>
                    <ul class="dropdown-menu col-xs-12 col-sm-6">
                        <li>
                            <div class="row produtoDropdown">
                                <p class="pull-left noreProdutoDropdown">Arroz de carne</p>
                                <p class="pull-right">R$ 15.00</p>
                            </div>
                            <div class="row qutidadeDropdown">
                                <p class="pull-left">Quantidade</p>
                                <p class="pull-right">2</p> 
                            </div>
                            <div class="row subtotalDropdown">
                                <p class="pull-left subtotal">Subtotal</p>
                                <p class="pull-right">R$ 30.00</p> 
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="row produtoDropdown">
                                <p class="pull-left noreProdutoDropdown">Arroz de carne</p>
                                <p class="pull-right">R$ 15.00</p>
                            </div>
                            <div class="row qutidadeDropdown">
                                <p class="pull-left">Quantidade</p>
                                <p class="pull-right">2</p> 
                            </div>
                            <div class="row subtotalDropdown">
                                <p class="pull-left subtotal">Subtotal</p>
                                <p class="pull-right">R$ 30.00</p> 
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="row produtoDropdown">
                                <p class="pull-left noreProdutoDropdown">Arroz de carne ao molho</p>
                                <p class="pull-right">R$ 15.00</p>
                            </div>
                            <div class="row qutidadeDropdown">
                                <p class="pull-left">Quantidade</p>
                                <p class="pull-right">2</p> 
                            </div>
                            <div class="row subtotalDropdown">
                                <p class="pull-left subtotal">Subtotal</p>
                                <p class="pull-right">R$ 30.00</p> 
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="row totalDropdown">
                                <p class="pull-left total">TOTAL</p>
                                <p class="pull-right">R$ 90.00</p> 
                            </div>
                        </li>


                    </ul>
                </li>
            </ul>
        </div>
        <ul class="nav nav-tabs nav-justified" id="ulCardapio" data-tabs="tabs" role="tablist">
            <li role="presentation" class="active"><a href="#comida" data-toggle="tab">Comida</a></li>
            <li role="presentation"><a href="#bebida" data-toggle="tab">Bebida</a></li>
        </ul>
        <div class="tab-content">
            <div id="comida" class="tab-pane active fade in">
                {$count=0}
                {foreach from=$produtosComida item=produto}
                    <div class="produto">
                        <p class="nome">{$produto->getNome()}</p>
                        {foreach from = $produto->getTamanhos() item=tamanho}
                            <div class="tamanho row col-xs-12">
                                <div class="tam">
                                    <p class="pull-left descricaoTamanho">{$tamanho->getDescricao()}</p>
                                    {$count=$count+1}
                                    <form action="javascript:void(0);" id="{$count}" onsubmit="addProduto({$count});">
                                        <button class="btn-link pull-right" ><img src="../images/icons/addCart.png" class="img img-responsive pull-right imgAddCart img-circle" 
                                                                                  alt="Adicionar a compra" title="Adicionar a compra"/></button>
                                        <input type="number" min="1" max="99" value="1" class="form-control pull-right quantidade"/>
                                        <input type="hidden" class="idProduto" value="{$produto->getId()}">
                                        <input type="hidden" class="idTamanho" value="{$tamanho->getId()}">
                                    </form>
                                    <p class="pull-right precoTamanho">R$ {$tamanho->getPreco()}</p>
                                </div>
                            </div>
                        {/foreach}
                        <h6 data-toggle="collapse" data-toggle="tooltip" data-placement="right" title="Clique para ver os ingredientes" data-target="#ingredientes{$produto->getId()}" class="elementToggle ingredientesLabel">Ingredientes</h6>
                        <div id="ingredientes{$produto->getId()}" class="collapse ingredientes fade">
                            <p>{$produto->getIngredientes()}</p>
                        </div>
                    </div>
                {/foreach}
            </div>
            <div id="bebida" class="tab-pane fade">
                {foreach from=$produtosBebida item=produto}
                    <div class="produto">
                        <p class="nome">{$produto->getNome()}</p>
                        {foreach from = $produto->getTamanhos() item=tamanho}
                            <div class="tamanho row col-xs-12">
                                <div class="tam">
                                    <p class="pull-left descricaoTamanho">{$tamanho->getDescricao()}</p>
                                    {$count=$count+1}
                                    <form action="javascript:void(0);" id="{$count}" onsubmit="addProduto({$count});">
                                        <button class="btn-link pull-right" ><img src="../images/icons/addCart.png" class="img img-responsive pull-right imgAddCart img-circle" 
                                                                                  alt="Adicionar a compra" title="Adicionar a compra"/></button>
                                        <input type="number" min="1" max="99" value="1" class="form-control pull-right quantidade"/>
                                        <input type="hidden" class="idProduto" value="{$produto->getId()}">
                                        <input type="hidden" class="idTamanho" value="{$tamanho->getId()}">
                                    </form>
                                    <p class="pull-right precoTamanho">R$ {$tamanho->getPreco()}</p>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                {/foreach}
            </div>
        </div>

    </div>

    <div class="modal" id="bigMap" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div id="location">
                        <div id="map2" class="col-xs-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>