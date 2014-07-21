<link href= "../css/index.css" rel="stylesheet">
<div class="container">
    <div class="jumbotron">
        <h1>Bem vindo ao site</h1>
        <p>Faça pedidos aos seus restaurantes favoritos de forma fácil, rápida e descomplicada</p>
        <form method="POST" class="form-horizontal" action="../pages/search.php">
            <div class="input-group">
                <input type="text" class="form-control input-lg" placeholder="Pesquise aqui" id="search" name="search">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-search"></span></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <h3 id="destaques">Destaques</h3>
    <div class="row">
        {foreach from = $highlights key = dishName item = img}
            <div class="col-md-3 col-sm-5 colunaDestaque">
                <h4 class="dishName">{$dishName}</h4>
                <div class="well-sm imgDiv">
                    <img src="{$img}" class="img-responsive">
                </div>
                <p class="restaurantName">Nome do restaurante</p>
                <a heref="#" class="btn btn-danger col-xs-12 pecaAgora">Peça agora</a>
            </div> 
        {/foreach}
    </div>
</div>