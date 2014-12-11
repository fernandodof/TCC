<link href= "{$templateRoot}css/index.css" rel="stylesheet">
<script src="{$templateRoot}js/locationInfo.js" rel="stylesheet"></script>
<div class="container main">
    <div id="jumbotronContent" class="col-xs-12">
    </div>
    <div class="jumbotron">
        <form method="GET" class="form-horizontal searchForm" action="{$templateRoot}pages/search">
            <div class="row input-group col-md-12 pull-left search">
                <div class="col-md-7 col-xs-12 searchDiv pull-left">
                    <input type="text" class="form-control input-lg pull-left searchField" placeholder="Digite seu cep ou o nome do restaurante" id="search" name="search">
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
                        <button type="submit" name="formSubmit" value="SearchRestaurante" class="col-xs-12 btn btn-lg btn-success btSearch">Pesqusar <span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
                <a class="btn btn-sm btn-success" href="{$templateRoot}pages/nearBy">Locais Proximos</a>
            </div>
        </form>
    </div>
    <h1>Bem vindo ao SaborVirtual</h1>
</div>

<div class="container">
    <h3 id="destaques">Destaques</h3>
    <div class="col-lg-12" id="destaquesDiv">
        {$count=0}
        {foreach from = $highlights key = dishName item = img}

            <div class="col-sm-3 colunaDestaque">
                <h4 class="dishName">{$dishName}</h4>
                <div class="well well-sm imgDiv pull-left">
                    <img src="{$img}" class="img img-responsive">
                </div>
                <div class="info">
                    <a class="restaurantName pull-left" href="{$links[$count]}">{$restaurants[$count]}</a>
                    <a heref="#" class="btn btn-danger btn-block pull-left pecaAgora">Peça agora</a>
                </div>
            </div> 
            {$count = $count+1}
        {/foreach}
    </div>
</div>