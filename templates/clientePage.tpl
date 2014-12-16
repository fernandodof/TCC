<link href="{$templateRoot}css/clientePage.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}dataTables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}dataTables/media/css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}hoverCSS/hover.min.css" rel="stylesheet">
<script src="{$templateRoot}dataTables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{$templateRoot}js/clientPageFunctions.js" type="text/javascript"></script>
<div class="container">
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
        </div>
    </form>

    <ul class="nav nav-pills nav-stacked col-md-2 sidebar">
        <li class="active"><a href="#tab_a" data-toggle="pill" class="button glow">Principal<span class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="#tab_b" data-toggle="pill" class="button glow">Pedidos <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
        <li><a href="#tab_c" data-toggle="pill" class="button glow">Endereços <span class="glyphicon glyphicon-map-marker"></span></a></li>
    </ul>
    <div class="tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
            <h4>Últimos Pedidos</h4>
            {foreach from=$ultimosPedidos item=pedido}
                <div class="pedidoDiv well well-sm">
                    <div class="pedidoHeader">
                        <h5 class="pull-left">{$pedido->getDataHora()}</h5>
                        <a class="btn btn-xs btn-info pull-right addCart" onclick="reOrder({$pedido->getId()},{$pedido->getRestaurante()->getId()});">Refazer Pedido</a>
                    </div>
                    <table class="table table-condensed table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantidade</th>
                                <th>Tamanho</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$pedido->getItensPedido() item=it}
                                <tr>
                                    <td>{$it->getProduto()->getNome()}</td>
                                    <td>{$it->getQuantidade()}</td>
                                    <td>{$it->getTamanho()->getDescricao()}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    <h5>{$pedido->getRestaurante()->getNome()}</h5>
                </div>
            {/foreach}

        </div>
        <div class="tab-pane" id="tab_b">
            <h4>Pedidos</h4>

            <table id="pedidos" class="display table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Estabelecimento</th>
                        <th>Itens</th>
                    </tr>
                </thead>
                <tbody>
                    {$i=0}
                    {foreach from=$pedidos item=pedido}
                        <tr>
                            <td>{$pedido->getId()}</td>
                            <td>{$pedido->getDataHora()}</td>
                            <td>R$ {$pedido->getValorTotal()}</td>
                            <td>{$pedido->getRestaurante()->getNome()}</td>
                            <td <label data-toggle="collapse" data-target="#item{$i}" class="elementToggle verItem">Ver Itens <span class="fa fa-eye"></span></label>

                                <div class="modal" id="item{$i}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Itens</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-hover table-responsive table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>Nome</th>
                                                            <th>Tamanho</th>
                                                            <th>Quantidade</th>
                                                            <th>Subtotal</th>
                                                        <tr>
                                                    </thead>
                                                    {foreach from=$pedido->getItensPedido() item=it}
                                                        <tbody>
                                                            <tr>
                                                                <td>{$it->getProduto()->getNome()}</td>
                                                                <td>{$it->getTamanho()->getDescricao()}</td>
                                                                <td>{$it->getQuantidade()}</td>
                                                                <td>{$it->getSubtotal()}</td>
                                                            </tr>
                                                        <tbody>
                                                    {/foreach}
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <label class="pull-right">Valor Total: R$ {$pedido->getValorTotal()}</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {$i=$i+1}
                    {/foreach}
                </tbody>
            </table>

        </div>
        <div class="tab-pane" id="tab_c">
            <h4>Endereços</h4>
            <p></p>
        </div>
    </div>
</div>