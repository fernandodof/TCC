<link href= "{$templateRoot}css/index.css" rel="stylesheet">
<script src="{$templateRoot}js/index.js"></script>

<div class="container main">
    <div id="jumbotronContent" class="col-xs-12">
    </div>
    <div class="jumbotron">

        <div class="row input-group col-md-12 pull-left search">
            <ul class="nav nav-tabs" id="indexTabs" data-tabs="tabs" role="tablist">
                <li role="presentation" id="firstTab" class="active indexTab"><a href="#searchRestaurant" data-toggle="tab">Restaurantes</a></li>
                <li role="presentation" id="secondTab" class="indexTab"><a href="#searchProduct" data-toggle="tab">Pratos</a></li>
            </ul>
            <div class="tab-content">
                <div id="searchRestaurant" class="tab-pane active fade in">
                    <form method="GET" class="form-horizontal searchForm hidden-xs" action="{$templateRoot}pages/search">
                        <div class="col-md-7 col-xs-12 searchDiv pull-left">
                            <input type="text" class="form-control input-lg hidden-xs pull-left searchField" placeholder="Digite seu cep ou o nome do restaurante" id="search" name="search">
                        </div>
                        <div class="row col-md-5 col-xs-12">
                            <div class="form-group col-md-11 col-xs-12 pull-left kindOfFoodDiv">
                                <select class="form-control input-lg kindOfFoodSelect col-md-11 col-xs-12" name="kindOfFood">
                                    <option class="" value="">Tipo de cozinha (todas)</option>
                                    {foreach from = $kindsOfFood kind}
                                        <option class="" value='{$kind.nome}'>{$kind.nome}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="col-md-1 visible-lg visible-md btSearchDiv">        
                                <div class="input-group-btn">
                                    <button type="submit" name="formSubmit" value="SearchRestaurante" class="btn btn-lg btn-success btSearch"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="row col-xs-12 visible-sm visible-xs btSearchDiv">        
                            <div class="input-group-btn">
                                <button type="submit" name="formSubmit" value="SearchRestaurante" class="col-xs-12 btn btn btn-success btSearch">Pesqusar <span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>
                    <form method="GET" class="form-horizontal searchForm visible-xs" action="{$templateRoot}pages/search">
                        <div class="col-md-7 col-xs-12 searchDiv pull-left">
                            <input type="text" class="form-control input pull-left searchField" placeholder="Digite seu cep ou o nome do restaurante" id="search" name="search">
                        </div>
                        <div class="row col-md-5 col-xs-12">
                            <div class="form-group col-md-11 col-xs-12 pull-left kindOfFoodDiv">
                                <select class="form-control input kindOfFoodSelect col-md-11 col-xs-12" name="kindOfFood">
                                    <option class="" value="">Tipo de cozinha (todas)</option>
                                    {foreach from = $kindsOfFood kind}
                                        <option class="" value='{$kind.nome}'>{$kind.nome}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="col-md-1 visible-lg visible-md btSearchDiv">        
                                <div class="input-group-btn">
                                    <button type="submit" name="formSubmit" value="SearchRestaurante" class="btn btn-lg btn-success btSearch"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="row col-xs-12 visible-sm visible-xs btSearchDiv">        
                            <div class="input-group-btn">
                                <button type="submit" name="formSubmit" value="SearchRestaurante" class="col-xs-12 btn btn btn-success btSearch">Pesqusar <span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="searchProduct" class="tab-pane fade in">
                    <form method="GET" class="form-horizontal searchProduct hidden-xs" action="{$templateRoot}pages/searchProduct">
                        <div class="form-group col-md-11 col-xs-12">
                            {literal}
                                <input type="text" class="form-control input-lg pull-left searchFieldProduct" placeholder="Digite o nome de um prato" id="searchProduct" name="productName" pattern=".{3,}" required title="Informe pelo menos 3 caracteres">
                            {/literal}
                        </div> 
                        <div class="col-md-1 visible-lg visible-md btSearchDivProduct">        
                            <div class="input-group-btn">
                                <button type="submit" name="formSubmit" value="SearchProduct" class="col-xs-12 btn btn-lg btn-success btSearchProduct"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                        <div class="row col-xs-12 visible-sm visible-xs btSearchDivProduct">
                            <div class="input-group-btn">
                                <button type="submit" name="formSubmit" value="SearchProduct" class="col-xs-12 btn btn btn-success btSearchProduct">Pesqusar <span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>
                    <form method="GET" class="form-horizontal searchProduct visible-xs" action="{$templateRoot}pages/searchProduct">
                        <div class="form-group col-md-11 col-xs-12">
                            {literal}
                                <input type="text" class="form-control input pull-left searchFieldProduct" placeholder="Digite o nome de um prato" id="searchProduct" name="productName" pattern=".{3,}" required title="Informe pelo menos 3 caracteres">
                            {/literal}
                        </div> 
                        <div class="col-md-1 visible-lg visible-md btSearchDivProduct">        
                            <div class="input-group-btn">
                                <button type="submit" name="formSubmit" value="SearchProduct" class="col-xs-12 btn btn-lg btn-success btSearchProduct"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                        <div class="row col-xs-12 visible-sm visible-xs btSearchDivProduct">
                            <div class="input-group-btn">
                                <button type="submit" name="formSubmit" value="SearchProduct" class="col-xs-12 btn btn btn-success btSearchProduct">Pesqusar <span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="indexButtons">        
                <a class="btn btn-sm btn-primary" href="{$templateRoot}pages/nearBy">Locais próximos <img id="gpsIcon" src="{$templateRoot}images/icons/gps13.png"></a>
                <a class="btn btn-sm btn-primary" href="{$templateRoot}pages/bestRate">Melhores locais <span class="starIcon glyphicon glyphicon-star"></span></a>
                <a class="btn btn-sm btn-primary" href="{$templateRoot}pages/bestItemRate">Melhores pratos <span class="starIcon glyphicon glyphicon-star"></span></a>
            </div>
        </div>
    </div>
    <h1 class="hidden-sm hidden-xs">Bem vindo ao SaborVirtual</h1>
</div>

<div class="container">
    <h3 id="destaques">Destaques</h3>
    <div class="col-lg-12" id="destaquesDiv">
        {$count=0}
        {foreach from = $products item = produto}

            <div class="col-sm-3 colunaDestaque">
                <h4 class="dishName">{$produto->getNome()}</h4>
                <div id="prod{$count}" onmouseover="highlightItem({$count});" onmouseout="highlightItem({$count});" class="well well-sm col-xs-12 imgDiv pull-left">
                    <a onmouseover="highlightItem({$count});" onmouseout="highlightItem({$count});" href="{$templateRoot}pages/restaurant/{$restaurants->get($count)->getId()}#{$produto->getNome()|replace:' ':''}">
                        <img id="prod{$count}" onmouseover="highlightItem({$count});" onmouseout="highlightItem({$count});" src="{$templateRoot}{$produto->getImagem()}" class="img-responsive"></a>
                </div>
                <div class="info">
                    <a class="restaurantName pull-left" href="{$templateRoot}pages/restaurant/{$restaurants->get($count)->getId()}">{$restaurants->get($count)->getNome()}</a>
                    <a id="btProd{$count}" onmouseover="highlightItem({$count});" onmouseout="highlightItem({$count});" href="{$templateRoot}pages/restaurant/{$restaurants->get($count)->getId()}#{$produto->getNome()|replace:' ':''}" class="btn btn-danger btn-block pull-left pecaAgora">Peça agora</a>
                </div>
            </div> 
            {$count = $count+1}
        {/foreach}
    </div>
</div>