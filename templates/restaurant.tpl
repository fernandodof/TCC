<link href="../bootstrap-modal-master/css/bootstrap-modal.css">
<link href="../css/restaurant.css" rel="stylesheet" type="text/css">
<link href="../css/cardapio.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../bootstrap-modal-master/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="../bootstrap-modal-master/js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrV71CPZi1AWL4oTCwtJ1B1Km5BKPXu9I&sensor=TRUE">
</script>
<script type="text/javascript" src="../js/LoadMap.js"></script>
<script type="text/javascript">
    {literal}
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
            $('body').dimBackground();
            $('#loader').show();
            $("body").find("input,button,textarea").attr("disabled", "disabled");
            var form = document.getElementById(idForm);
            var idProduto1 = form.getElementsByClassName('idProduto')[0].value;
            var idTamanho1 = form.getElementsByClassName('idTamanho')[0].value;
            var quantidade1 = form.getElementsByClassName('quantidade')[0].value;
            var idRestaurantePedido1 = $('#idRestaurantePedidoInicial').val();

            var data = {idProduto: idProduto1, idTamanho: idTamanho1, quantidade: quantidade1, idRestaurantePedido: idRestaurantePedido1};
            var url = '../src/app/ajaxReceivers/addToCart.php';

            $.ajax({
                type: "POST",
                url: url,
                async: true,
                data: data,
                success: function (serverResponse) {
                    if (serverResponse === 'Erro') {
                        $('#loader').hide();
                        alert('Por favor faça o login para poder realizar o pedido');
                        $('body').undim();
                        $("body").find("input,button,textarea").removeAttr("disabled");

                    }
                    else {
                        $('#pedidoDropdown').html(serverResponse);
                        $('body').undim();
                        $("body").find("input,button,textarea").removeAttr("disabled");
                        $('#loader').hide();
                    }
                },
                error: function (data) {
                    alert("Erro ");
                }
            });
        }

        google.maps.event.addDomListener(window, 'load', initMap);
        google.maps.event.trigger(map, 'resize');
    {/literal}
</script>
<div class="container">
    <img src="../images/loader.GIF" title="Carregando" alt="Carregando" class="img img-responsive" id="loader">
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
            <input type="hidden" id="idRestaurantePedidoInicial" value="{$restaurante->getId()}">
            <ul>

                <li class="dropdown" id="pedidoDropdown">
                    {if isset($smarty.session.pedido)}

                        <a href="#" class="dropdown-toggle btn btn-primary pull-left" id="togglePedido" data-toggle="dropdown">Resumo do Pedido 
                            <span class="badge" id="badgePedido">{$smarty.session.pedido->getItensPedido()|@count}</span> <b class="caret"></b></a>
                        <form action="../pages/confirmOrder.php" method="POST" id="formProseguir" class="pull-left">
                            <button type="submit" class="dropdown-toggle btn btn-success" id="proseguirPedido">Proseguir Pedido
                                <img class="img" src='../images/icons/hotPot.png'/> <span class="glyphicon glyphicon-arrow-right"></span></button>
                            <input type="hidden" name="idRestaurantePedido" id="idRestaurantePedido" value="{$restaurante->getId()}">
                        </form>

                        <ul class="dropdown-menu col-xs-12 col-sm-6">
                            {$count1=0}
                            {foreach from=$smarty.session.pedido->getItensPedido() item=it}
                                {$count1=$count1+1}
                                <li>
                                    <div class="row produtoDropdown">
                                        <p class="pull-left noreProdutoDropdown">{$it->getProduto()->getNome()}</p>
                                        <p class="pull-right">R$ {$it->getTamanho()->getPreco()}</p>
                                    </div>
                                    <div class="row qutidadeDropdown">
                                        <p class="pull-left">Quantidade</p>
                                        <p class="pull-right">{$it->getQuantidade()}</p> 
                                    </div>
                                    <div class="row tamanhoDropdown">
                                        <p class ="pull-left">Tamanho:</p>
                                        <p class = "pull-right">{$it->getTamanho()->getDescricao()} </p>
                                    </div>
                                    <div class="row subtotalDropdown">
                                        <p class="pull-left subtotal">Subtotal</p>
                                        <p class="pull-right">{$it->getSubtotal()}</p> 
                                    </div>
                                </li>
                                {*                                <p>{$count1}</p>
                                <p>{$smarty.session.pedido->getItensPedido()|@count}</p>*}
                                {if ($count1 < $smarty.session.pedido->getItensPedido()|@count)}
                                    <li class="divider"></li>
                                    {/if}
                                {/foreach}
                            <li class="totalLi">
                                <div class="row totalDropdown">
                                    <p class="pull-left total">TOTAL</p>
                                    <p class="pull-right">R$ {$smarty.session.pedido->getValorTotal()}</p> 
                                </div>
                            </li>
                        {/if}
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