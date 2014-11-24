<link href="{$templateRoot}css/sidebar.css" rel="stylesheet">
<link href="{$templateRoot}css/search.css" rel="stylesheet">
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
        <div class="navbar navbar-default navbar-static-top sidebar">
            <div class="collapse navbar-collapse sidebarCollapse">
                <ul class="nav nav-pills nav-stacked">
                    <li  onclick="filterRestaurante('');"><a>Todas</a></li>
                        {foreach from = $kindsOfFood item = kind}
                        <li onclick="filterRestaurante('{$kind.nome}');"><a class="elementToggle">{$kind.nome}</a></li>
                        {/foreach}
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">   
                        <div class="page-header">
                            <h3>Resultados da pesquisa</h3>
                            {*                            <div class="well well-sm closed col-xs-2 statusIndicatioClosed"><p>Aberto</p></div>
                            <div class="well well-sm opened col-xs-2 pull-right statusIndicationOpened"><p>Fechado</p></div>*}
                        </div>
                    </div>
                    <div id="results">
                        {if empty($restaurants)}
                            <h3 class="no-result-search">Desculpe, a pesquisa não retornou nenhum resultado.</h3>
                            <div id='faces'> 
                                <img id = "imgFace" src = '{$templateRoot}images/icons/svg/sadFace.svg'/>
                            </div>
                        {else}
                            {foreach from = $restaurants item = restaurante}
                                {if $restaurante->getAberto()}
                                    <div class="well closed col-xs-12">
                                        <h4>{$restaurante->getNome()} <small> {$restaurante->getTipo()->getNome()}</small></h4>
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
                                        <a class="btn btn-primary btn-sm pull-right btVerCardapio" href="{$templateRoot}pages/restaurant/{$restaurante->getId()}">Visualizar Cardápio</a>
                                    </div>       
                                {else}
                                    <div class="well opened col-xs-12">
                                        <h4>{$restaurante->getNome()} <small> {$restaurante->getTipo()->getNome()}</small></h4>
                                        <div class="row col-xs-12">
                                            <img class="img pull-left locationImg" src="{$templateRoot}images/icons/rsz_location.png"/>
                                            <address class="col-xs-10">{$restaurante->getEndereco()->getLogradouro()}, {$restaurante->getEndereco()->getNumero()}, Bairro: {$restaurante->getEndereco()->getBairro()}, CEP:
                                                {$restaurante->getEndereco()->getCep()}, {$restaurante->getEndereco()->getCidade()}
                                            </address>                                     
                                        </div>
                                        <div class="row col-xs-12 pull-right formaPagamentoDiv">
                                            <img class="img pull-right moneyImg" alt="Dinheiro" title="Dinheiro" src="{$templateRoot}images/icons/money59.png"/>
                                            <img class="img pull-right cardImg" alt="Cartão" title="Cartão"src="{$templateRoot}images/icons/card25.png"/>
                                            <p class="pull-right">Formas de Pagamento: </p>
                                        </div>
                                        <a class="btn btn-primary btn-sm pull-right btVerCardapio" href="{$templateRoot}pages/restaurant.php/{$restaurante->getId()}">Visualizar Cardápio</a>
                                    </div>      
                                {/if}
                            {/foreach}
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>    