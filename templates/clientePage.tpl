<link href="../css/clientePage.css" rel="stylesheet" type="text/css">
<div class="container">
    <form method="GET" class="form-horizontal searchForm" action="../pages/search.php">
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
        </div>
    </form>

    <ul class="nav nav-pills nav-stacked col-md-2 sidebar">
        <li class="active"><a href="#tab_a" data-toggle="pill">Principal<span class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="#tab_b" data-toggle="pill">Pedidos <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
        <li><a href="#tab_c" data-toggle="pill">Endereços <span class="glyphicon glyphicon-map-marker"></span></a></li>
    </ul>
    <div class="tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
            <h4>Principal</h4>
            <p></p>
        </div>
        <div class="tab-pane" id="tab_b">
            <h4>Pedidos</h4>
        </div>
        <div class="tab-pane" id="tab_c">
            <h4>Endereços</h4>
            <p></p>
        </div>
    </div>
</div> <!-- tab content --