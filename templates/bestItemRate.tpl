<link href="{$templateRoot}css/cardapio.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}css/bestItemRate.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}libs/bootstrap-star-rating/css/star-rating.min.css" rel="stylesheet" type="text/css">
<script src="{$templateRoot}libs/bootstrap-star-rating/js/star-rating.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{$templateRoot}js/restaurantPageFunctions.js"></script>
<script src="{$templateRoot}js/locationInfo.js" rel="stylesheet"></script>

<div class="container">
    <img src="{$templateRoot}images/loader.GIF" title="Carregando" alt="Carregando" class="img img-responsive" id="loader">

    <div class="menu col-md-10 col-md-offset-1 col-sm-12">
        <h2>Melhores itens</h2>

        <div id="comida" class="tab-pane active fade in">
            {$count=0}
            {$i = 0}
            {foreach from=$products item=produto}
                <div class="produto">

                    {if isset($idsProdutosComprados) and in_array($produto->getId(), $idsProdutosComprados)}
                        <p class="nome pull-left col-sm-10 nameP">{$produto->getNome()} - <small>{$restaurants->get($i)->getNome()}</small></p>
                        <div class="row btAvaliarDiv">
                            <a class="btn btn-default btn-sm pull-right btAvaliar" href="{$templateRoot}pages/rateItem/{$produto->getId()}">Avaliar Ítem</a>
                        </div>
                    {else}
                        <p class="nome pull-left col-xs-12 nameP">{$produto->getNome()} - <small>{$restaurants->get($i)->getNome()}</small></p>
                    {/if}
                    <div class="col-xs-12">
                        <div class="rateDiv">
                            <a class="btn btn-primary btn-xs pull-right commentButton {if (count($produto->getComentarios()) == 0)} disabled {/if}" href="{$templateRoot}pages/itemComments/{$produto->getId()}"><span class="fa fa-comment fa-2x commentIcon"></span> 
                                <span class="badge commentCountBadge">{count($produto->getComentarios())}</span></a>
                            <input class="rateInputs pull-right" data-show-clear="false" value="{$avgRating[$i]}">  
                        </div>
                    </div>
                    <a class="btn btn-info btn-xs btVerCardapio" href="{$templateRoot}pages/restaurant/{$restaurants->get($i)->getId()}">Cardápio</a>
                    {foreach from = $produto->getTamanhos() item=tamanho}
                        <div class="tamanho row col-xs-12">
                            <div class="tam">
                                <p class="pull-left descricaoTamanho">{$tamanho->getDescricao()}</p>
                                {$count=$count+1}
                                <form action="javascript:void(0);" id="add{$count}" onsubmit="checkCurrentOrder1({$count}, {$restaurants->get($i)->getId()});">
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

    </div>
</div>