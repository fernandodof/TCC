<link href="{$templateRoot}css/restaurant.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}css/cardapio.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}css/restaurantColumn.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}libs/bootstrap-star-rating/css/star-rating.min.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}css/animate.css-master/animate.min.css" rel="stylesheet">
<script src="{$templateRoot}libs/bootstrap-star-rating/js/star-rating.min.js" type="text/javascript"></script>
<script type="text/javascript" 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvaKdbwG_GgsyhMXSQLUQ6cu9Vhn657B8&sensor=TRUE">
</script>
<script type="text/javascript" src="{$templateRoot}js/restaurantPageFunctions.js"></script>
<script type="text/javascript" src="{$templateRoot}js/mapFunctions.js"></script>
<div class="container">
    <div id="addingItemDiv">
        <img id="sumitingOrder" class="rotating" src="{$templateRoot}images/icons/plate.svg">
        <h4>Adicionando...</h4>
    </div>

    <div class="visible-sm visible-xs">
        <button class="btn btn-primary btn" data-toggle="collapse" data-target=".restaurant">
            <span class="fa fa-bars"></span>
        </button>
    </div>

    <div class="restauntContainer col-md-3">
        <div class="restaurant collapse navbar-collapse">
            <img src="{$templateRoot}images/logos/restaurantLogo.gif" class="img img-thumbnail img-responsive restaurantLogo"/>
            <h4 id="nomeRestaurante">{$restaurante->getNome()}</h4>
            <input id="rateInput" data-show-clear="false" value="{$avgRating}">  
            <img src="{$templateRoot}images/icons/rsz_location.png" class="pull-left addressIcon">
            <address>{$restaurante->getEndereco()->getLogradouro()}, {$restaurante->getEndereco()->getNumero()}, Bairro: {$restaurante->getEndereco()->getBairro()}, CEP:
                {$restaurante->getEndereco()->getCep()}, {$restaurante->getEndereco()->getCidade()}, {$restaurante->getEndereco()->getEstado()} 
                {$restaurante->getEndereco()->getComplemento()}.</address>
            <div id="location">
                <div id="map">
                </div>
            </div>
            <a onclick="expandMap();" class="elementToggle">Expandir Mapa</a>
        </div>
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
                        <form action="{$templateRoot}pages/confirmOrder" method="POST" id="formProseguir" class="pull-left">
                            <button type="submit" class="dropdown-toggle btn btn-success" id="proseguirPedido">Proseguir Pedido
                                <img class="img" src='{$templateRoot}images/icons/hotPot.png'/> <span class="glyphicon glyphicon-arrow-right"></span></button>
                            <input type="hidden" name="idRestaurantePedido" id="idRestaurantePedido" value="{$restaurantePedido->getId()}">
                        </form>

                        <ul class="dropdown-menu col-xs-12 col-sm-6">
                            <li id="liNomeRetaurantePedido">
                                <h5 id="nomeRestaurnatePedido">{$restaurantePedido->getNome()}</h5>
                            </li>
                            <li class="divider firstDivider"></li>
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
                {$i = 0}
                {foreach from=$produtosComida item=produto}
                    <div class="produto" id="{$produto->getNome()|replace:' ':''}">
                        {*  <a href="#" class="btn btn-default productImg" id="{$produto->getNome()|replace:' ':''}Hover" 
                        onmouseover="showProductImageOnHover('{$produto->getNome()|replace:' ':''}Hover', '{$produto->getNome()}', '{$produto->getImagem()}');"
                        onmouseout="hideProductOnLeave('{$produto->getNome()|replace:' ':''}Hover');">Imagem</a>*}
                        {if isset($idsProdutosComprados) and in_array($produto->getId(), $idsProdutosComprados)}
                            <p class="nome pull-left col-sm-10 nameP">{$produto->getNome()}</p>
                            <div class="row btAvaliarDiv">
                                <a class="btn btn-default btn-sm pull-right btAvaliar" href="{$templateRoot}pages/rateItem/{$produto->getId()}">Avaliar Ítem</a>
                            </div>
                        {else}
                            <p class="nome pull-left col-xs-12 nameP">{$produto->getNome()}</p>
                        {/if}
                        <div class="col-xs-12">
                            <div class="rateDiv">
                                <a class="btn btn-primary btn-xs pull-right commentButton {if (count($produto->getComentarios()) == 0)} disabled {/if}" href="{$templateRoot}pages/itemComments/{$produto->getId()}"><span class="fa fa-comment fa-2x commentIcon"></span> 
                                    <span class="badge commentCountBadge">{count($produto->getComentarios())}</span></a>
                                <input class="rateInputs pull-right" data-show-clear="false" value="{$avgRatingP[$i]}">  
                            </div>
                        </div>
                        <a href="#" class="btn productImg" id="{$produto->getNome()|replace:' ':''}Img" aria-describedby="{$produto->getNome()|replace:' ':''}Img" data-toggle="popover" data-trigger="focus"
                           title="{$produto->getNome()}" data-content="<img class='img img-responsive' src='{$templateRoot}{$produto->getImagem()}'/>"><img class='img img-responsive' src='{$templateRoot}{$produto->getImagem()}'/></a>

                        {foreach from = $produto->getTamanhos() item=tamanho}
                            <div class="tamanho row col-xs-12">
                                <div class="tam">
                                    <p class="pull-left descricaoTamanho">{$tamanho->getDescricao()}</p>
                                    {$count=$count+1}
                                    <form action="javascript:void(0);" id="add{$count}" onsubmit="checkCurrentOrder({$count});">
                                        <button class="btn-link pull-right addCart"><img src="{$templateRoot}images/icons/addCartIcon.png" class="img img-responsive pull-right imgAddCart img-circle" 
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
                    {$i=$i+1}        
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
                                    <form action="javascript:void(0);" id="add{$count}" onsubmit="checkCurrentOrder({$count});">
                                        <button class="btn-link pull-right"><img src="{$templateRoot}images/icons/addCartIcon.png" class="img img-responsive pull-right imgAddCart img-circle" 
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="map-header">
                    <h4 id="closeMap" class="elementToggle" onclick="closeMap();">Fechar <span class="glyphicon glyphicon-remove"></span></h4>
                </div>
                <div class="modal-body modal-body-map" id="bigMap-modal-body">
                    <div id="location2">
                        <div id="map2" class="col-xs-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>