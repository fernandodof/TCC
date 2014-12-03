<link href="{$templateRoot}css/sidebar.css" rel="stylesheet">
<link href="{$templateRoot}css/search.css" rel="stylesheet">
<link href="{$templateRoot}bootstrap-star-rating/css/star-rating.min.css" rel="stylesheet" type="text/css">
<script src="{$templateRoot}bootstrap-star-rating/js/star-rating.min.js" type="text/javascript"></script>
<script src="{$templateRoot}js/jquery.query-object.js" type="text/javascript"></script>
<script src="{$templateRoot}js/searchFunctions.js" type="text/javascript"></script>

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
                    <li id="liFilter{$j}" class="liFilterType" onclick="filterRestaurante('', this.id);"><a>Todos</a></li>
                        {foreach from = $kindsOfFood item = kind}
                        {$j = $j+1}
                            <li id="liFilter{$j}" class="liFilterType" onclick="filterRestaurante('{$kind.nome}', this.id);"><a class="elementToggle">{$kind.nome}</a></li>
                        {/foreach}
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="row">   
                    <div class="page-header row col-xs-12">
                        <h3 class="col-xs-11">Resultados da pesquisa</h3><img id="circleLoader" class="img img-responsive" src="{$templateRoot}images/icons/circleLoader.gif" alt="Carregando..." title="Carregando...">
                        {*                            <div class="well well-sm closed col-xs-2 statusIndicatioClosed"><p>Aberto</p></div>
                        <div class="well well-sm opened col-xs-2 pull-right statusIndicationOpened"><p>Fechado</p></div>*}
                    </div>
                </div>
                <div class="panel-body">
                    <div id="results">
                        {if empty($restaurants)}
                            <h3 class="no-result-search">Desculpe, a pesquisa não retornou nenhum resultado.</h3>
                            <div id='faces'> 
                                <img id = "imgFace" src = '{$templateRoot}images/icons/svg/sadFace.svg'/>
                            </div>
                        {else}
                            {$i = 0}
                            {foreach from = $restaurants item = restaurante}
                                <div class="well closed col-xs-12">
                                    <h4>{$restaurante->getNome()} <small> {$restaurante->getTipo()->getNome()}</small> 
                                        <a class="btn btn-primary btn-sm pull-right commentButton {if (count($restaurante->getComentarios()) == 0)} disabled {/if}" href="{$templateRoot}pages/comments/{$restaurante->getId()}"><span class="fa fa-comment fa-2x commentIcon"></span> 
                                            <span class="badge commentCountBadge">{count($restaurante->getComentarios())}</span></a>
                                    </h4>
                                    <div class="row col-xs-12">
                                        <img class="img pull-left" src="{$templateRoot}images/icons/rsz_location.png"/>
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
                                    <div class="row buttons">
                                        {if isset($idsRestaurantesComprados)}
                                            {if in_array($restaurante->getId(), $idsRestaurantesComprados)}
                                                <a class="btn btn-default btn-sm pull-left" href="{$templateRoot}pages/rate/{$restaurante->getId()}">Avaliar estabelecimento</a>
                                            {/if}   
                                        {/if}   
                                        <a class="btn btn-info btn-sm pull-right btVerCardapio" href="{$templateRoot}pages/restaurant/{$restaurante->getId()}">Visualizar Cardápio</a>
                                    </div>
                                    <div class="col-xs-5">
                                    <input class="rateInputs pull-left" data-show-clear="false" value="{$avgRating[$i]}">
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