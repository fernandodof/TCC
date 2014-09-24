<link href= "../css/index.css" rel="stylesheet">
<div class="container">
    <div class="jumbotron">
        <h1>Bem vindo ao SaborVirtual</h1>
        <p>Faça pedidos aos seus restaurantes favoritos de forma fácil, rápida e descomplicada</p>
        <form method="POST" class="form-horizontal searchForm" action="../pages/search.php">
            <div class="row input-group col-md-12 pull-left search">
                <div class="col-md-7 col-xs-12 searchDiv pull-left">
                    <input type="text" class="form-control input-lg pull-left searchField" placeholder="Digite seu cep ou o nome do restaurante" id="search" name="search">
                </div>
                <div class="row col-md-5 col-xs-12">
                    <div class="form-group col-md-11 col-xs-12 pull-left kindOfFoodDiv">
                        <select class="form-control input-lg kindOfFoodSelect col-md-11 col-xs-12 ">
                            <option class="">Tipo de cozinha (todas)</option>
                            {foreach from = $kindsOfFood key=k item = kind}
                                <option class="">{$kind->getNome()}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="col-md-1 visible-lg visible-md btSearchDiv">        
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-lg btn-success btSearch"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row col-xs-12 visible-sm visible-xs btSearchDiv">        
                    <div class="input-group-btn">
                        <button type="submit" class="col-xs-12 btn btn-lg btn-success btSearch">Pesqusar <span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <h3 id="destaques">Destaques</h3>
    <div class="row">
        {$count=0}
        {foreach c from = $highlights key = dishName item = img}

            <div class="col-md-3 col-sm-5 colunaDestaque">
                <h4 class="dishName">{$dishName}</h4>
                <div class="well-sm imgDiv">
                    <img src="{$img}" class="img-responsive">
                </div>
                <a class="restaurantName" href="{$links[$count]}">{$restaurants[$count]}</a>
                <a heref="#" class="btn btn-danger col-xs-12 pecaAgora">Peça agora</a>
            </div> 
            {$count = $count+1}
        {/foreach}
    </div>
</div>