<link href="{$templateRoot}libs/bootstrap-star-rating/css/star-rating.min.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}css/sidebar.css" rel="stylesheet">
<link href="{$templateRoot}css/search.css" rel="stylesheet">
<link href="{$templateRoot}css/nearBy.css" rel="stylesheet">
<link href="{$templateRoot}libs/hoverCSS/hover.min.css" rel="stylesheet">
<script src="{$templateRoot}libs/bootstrap-star-rating/js/star-rating.min.js" type="text/javascript"></script>
<script src="{$templateRoot}js/jquery.query-object.js" type="text/javascript"></script>
<script src="{$templateRoot}js/locationInfo.js" rel="stylesheet"></script>
<script src="{$templateRoot}js/searchFunctionsLocation.js" type="text/javascript"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>Filtrar por tipo</h4>
            <div class="visible-xs sidebarToggleButton">
                <button class="btn btn-primary btn-lg" data-toggle="collapse" data-target=".sidebarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="col-sm-3 sidebarContainer">
        <div class="navbar navbar-static-top sidebar">
            <div class="collapse navbar-collapse sidebarCollapse">
                <ul class="nav nav-pills nav-stacked">
                    {$j=0}
                    <li id="liFilter{$j}" class="liFilterType" onclick="filterRestaurante('', this.id, false);"><a class="elementToggle button glow">Todos</a></li>
                    {foreach from = $kindsOfFood item = kind}
                            {$j = $j+1}
                        <li id="liFilter{$j}" class="liFilterType" onclick="filterRestaurante('{$kind.nome}', this.id, false);"><a class="elementToggle button glow">{$kind.nome}</a></li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default panel-search">
                <div class="row">   
                    <div class="page-header row col-xs-12">
                        <div class="col-xs-12">
                            <h3 class="pull-left">Resultados da pesquisa</h3>
                            <img id="circleLoader" class="img img-responsive rotating pull-right" src="{$templateRoot}images/icons/plate.svg" alt="Carregando..." title="Carregando...">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="results">

                        {if isset($smarty.session.locationError)}
                            <h4 class="locationError">Não foi possível obter a sua localização, motivo: <small> {$smarty.session.locationError} </smal></h4>
                            <h6>Mas os locais mais bem avaliados estão aqui</h6>
                        {/if}

                        {if (count($restaurants)==0)}
                            <h3 class="no-result-search">Desculpe, a pesquisa não retornou nenhum resultado.</h3>
                            <div id='faces'> 
                                <img id = "imgFace" src = '{$templateRoot}images/icons/svg/sadFace.svg'/>
                            </div>
                        {else}
                            {$i = 0}
                            {foreach from = $restaurants item = restaurante}
                                <div class="well closed col-xs-12">
                                    <h4 id="nameRestaurante" class="col-sm-8">{$restaurante->getNome()} <small> {$restaurante->getTipo()->getNome()}</small></h4>
                                    <div class="row col-xs-12 enderecoDiv">
                                        <span class="fa fa-map-marker fa-2x pull-left"> </span>
                                        <address class="col-xs-10">{$restaurante->getEndereco()->getLogradouro()}, {$restaurante->getEndereco()->getNumero()}, Bairro: {$restaurante->getEndereco()->getBairro()}, CEP:
                                            {$restaurante->getEndereco()->getCep()}, {$restaurante->getEndereco()->getCidade()}, {$restaurante->getEndereco()->getEstado()} 
                                            {$restaurante->getEndereco()->getComplemento()}.
                                        </address>                                    
                                    </div>
                                    <div class="row col-xs-12 pull-right formaPagamentoDiv">
                                        {foreach from = $restaurante->getFormasPagamento() item=forma}
                                            {if $forma->getNome()=='Dinheiro'}
                                                <img class="img pull-right moneyImg" alt="Dinheiro" title="Dinheiro" src="{$templateRoot}images/icons/money59.png"/>
                                            {/if}
                                            {if $forma->getNome()=='Cartao'}
                                                <img class="img pull-right cardImg" alt="Cartão" title="Cartão"src="{$templateRoot}images/icons/card25.png"/>
                                            {/if}
                                        {/foreach}
                                        <p class="pull-right">Formas de Pagamento: </p>
                                    </div>

                                    {if isset($idsRestaurantesComprados) and in_array($restaurante->getId(), $idsRestaurantesComprados)}
                                        <div class="row">
                                            <a class="btn btn-default btn-sm pull-left btAvaliar visible-lg visible-md" href="{$templateRoot}pages/rate/{$restaurante->getId()}">Avaliar estabelecimento</a>
                                        </div>
                                    {/if}

                                    <div class="row buttons pull-left col-md-12">
                                        <div class="col-md-6 col-sm-8 col-xs-12">
                                            <input class="rateInputs pull-left" data-show-clear="false" value="{$avgRating[$i]}">
                                        </div>
                                        <a class="btn btn-info btn-sm pull-right btVerCardapio visible-lg visible-md" href="{$templateRoot}pages/restaurant/{$restaurante->getId()}">Visualizar Cardápio</a>
                                        <a class="btn btn-primary btn-xs pull-right commentButton visible-lg visible-md {if (count($restaurante->getComentarios()) == 0)} disabled {/if}" href="{$templateRoot}pages/comments/{$restaurante->getId()}"><span class="fa fa-comment fa-2x commentIcon"></span> 
                                            <span class="badge commentCountBadge">{count($restaurante->getComentarios())}</span></a>

                                        <a class="btn btn-info btn-sm pull-right btVerCardapioSm visible-xs visible-sm btn-block" href="{$templateRoot}pages/restaurant/{$restaurante->getId()}">Visualizar Cardápio</a>
                                        <a class="btn btn-primary btn-xs pull-right commentButtonSm visible-xs visible-sm btn-block {if (count($restaurante->getComentarios()) == 0)} disabled {/if}" href="{$templateRoot}pages/comments/{$restaurante->getId()}"><span class="fa fa-comment fa-2x commentIcon"></span> 
                                            <span class="badge commentCountBadge">{count($restaurante->getComentarios())}</span> Comentários</a>

                                        {if isset($idsRestaurantesComprados) and in_array($restaurante->getId(), $idsRestaurantesComprados)}
                                            <a class="btn btn-default btn-sm pull-left btAvaliar visible-xs visible-sm btn-block" href="{$templateRoot}pages/rate/{$restaurante->getId()}">Avaliar estabelecimento</a>
                                        {/if}

                                    </div>
                                </div>
                                {$i = $i+1}
                            {/foreach}
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>    