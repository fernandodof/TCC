<head>
    <link href="{$templateRoot}css/funcionarioPage.css" rel="stylesheet" type="text/css">
    {*    <link href="{$templateRoot}libs/dataTables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">*}
    <link href="{$templateRoot}libs/dataTables/media/css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css">
    <link href="{$templateRoot}libs/dataTables/bootstrapDatatableTheme/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{$templateRoot}libs/dataTables/extensions/Responsive/css/dataTables.responsive.css">
    <link href="{$templateRoot}css/cardapio.css" rel="stylesheet" type="text/css">
    <script src="{$templateRoot}js/jquery.priceFormat.min.js" type="text/javascript"></script>
    <script type="text/javascript" 
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvaKdbwG_GgsyhMXSQLUQ6cu9Vhn657B8&sensor=TRUE">
    </script>
    <script src="{$templateRoot}js/funcionarioPageFunctions.js" type="text/javascript"></script>
    <script src="{$templateRoot}libs/dataTables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="{$templateRoot}libs/dataTables/bootstrapDatatableTheme/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="{$templateRoot}libs/dataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="{$templateRoot}js/showOrderMap.js" type="text/javascript"></script>
</head>

<div class="container" id="page">
    <h3>{$smarty.session.funcRestaurante}</h3>
    <ul class="nav nav-pills nav-stacked col-md-3 sidebar">
        <li class="{if !isset($smarty.get.produtoCadastrado) && !isset($smarty.get.error)}active{/if}"><a href="#tab_a" data-toggle="pill">Novos Pedidos <span class="glyphicon glyphicon-shopping-cart"></span></a></a></li>
        <li class=""><a href="#tab_b" data-toggle="pill">Pedidos na Cozinha <img class="img img-responsive pull-right" src="{$templateRoot}images/icons/svg/chef16.svg" alt="Cozinha"></a></li>
        <li class=""><a href="#tab_c" data-toggle="pill">Pedidos em entrega <img class="img img-responsive pull-right" src="{$templateRoot}images/icons/svg/logistics3.svg" alt="Cozinha"></a></li>
        <li class=""><a href="#tab_d" data-toggle="pill">Histórico de Pedidos <span class="fa fa-history"></span></a></li>
        <li class="{if isset($smarty.get.produtoCadastrado) || isset($smarty.get.error)}active{/if}"><a href="#tab_e" data-toggle="pill">Cardápio <span class="glyphicon glyphicon-list-alt"></span></a></li>
    </ul>
    <div class="tab-content col-md-9">
        <div class="tab-pane {if !isset($smarty.get.produtoCadastrado) && !isset($smarty.get.error)}active{/if}" id="tab_a">
            <h4 class="col-xs-12 pull-left novosPedidosLb">Novos Pedidos <i class="fa fa-refresh fa-spin fa-2x pull-right"></i></h4>
            <div class="col-xs-12" id="pedidosRecebidos">
                {$i=0}
                {foreach from=$pedidosRecebidos item=pedido}
                    <div class="pedidoDiv" id="pedidoRecebidoDiv{$i}">
                        <label class="idPedido">#{$pedido->getId()}</label>
                        <div class="pull-right checkboxPedidoDiv">
                            <input type="hidden" value="{$pedido->getId()}" id="idPedidoRecebido{$i}">
                            <input type="checkBox" class="fwdCheckBox" name="pedidos[]" value="{$i}" id="pedidoRecebido{$i}" onchange="enviarPedidoCozinha(this);">
                            <label for="pedidoRecebido{$i}"><span class="lbEncaminharCozinha">Encaminhar para cozinha</span></label>
                        </div>
                        <div class="table-responsive tableOrders">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantidade</th>
                                        <th>Tamanho</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach from=$pedido->getItensPedido() item=it}
                                        <tr>
                                            <td>{$it->getProduto()->getNome()}</td>
                                            <td>{$it->getQuantidade()}</td>
                                            <td>{$it->getTamanho()->getDescricao()}</td>
                                            <td>R$ {$it->getSubtotal()}</td>
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                        <label class="pull-right valorTotal">TOTAL: R$ {$pedido->getValorTotal()}</label>
                        <div class="infoCliente">
                            <h4 class="nomeCliente"><span>Cliente: </span>{$pedido->getCliente()->getNome()}</h4>
                            <h4  data-toggle="collapse" data-target="#enderecoNovosPedidos{$i}" class="elementToggle verEndereco">Detalhes do cliente <i class="fa fa-chevron-circle-down"></i></h4>

                            <div class="collapse" id="enderecoNovosPedidos{$i}">
                                {foreach from=$pedido->getCliente()->getTelefones() item= telefone}
                                    <h5>Telefone: {$telefone->getNumero()}</h5>
                                {/foreach}
                                <h4>Endereço <span class="fa fa-map-marker enderecoMarker"></span></h4>
                                    {foreach from = $pedido->getCliente()->getEnderecos() item = endereco} 
                                    <p>{$endereco->getLogradouro()}, {$endereco->getNumero()}</p>
                                    <p>{$endereco->getBairro()}, {$endereco->getCidade()}</p>
                                    <p>{$endereco->getEstado()}, {$endereco->getCep()}</p>
                                {/foreach}
                                {if $pedido->getLatitude() != null}
                                    <a href="#myMapModal"  data-toggle="modal" onclick="initialize({$pedido->getLatitude()},{$pedido->getLongitude()});" class="btn btn-info btn-xs">Mapa</a>
                                {/if}
                            </div>
                        </div>
                        {if $pedido->getObservacoes() != null}
                            <h3 class="obs">Observações: <small>{$pedido->getObservacoes()}</small></h3>
                        {/if}

                    </div>
                    {$i=$i+1}
                {/foreach}
            </div>
        </div>

        <div class="tab-pane" id="tab_b">
            <h4 class="col-xs-12 pull-left pedidosCozinhaLb">Pedidos na Cozinha <i class="fa fa-refresh fa-spin fa-2x pull-right"></i></h4>
            <div class="col-xs-12" id="pedidosCozinha">
                {$i=0}
                {foreach from=$pedidosCozinha item=pedido}
                    <div class="pedidoDiv" id="pedidoCozinhaDiv{$i}">
                        <label class="idPedido">#{$pedido->getId()}</label>
                        <div class="pull-right checkboxPedidoDiv">
                            <input type="hidden" value="{$pedido->getId()}" id="idPedidoCozinha{$i}">
                            <input type="checkBox" class="fwdCheckBox" name="pedidos[]" value="{$i}" id="pedidoCozinha{$i}" onchange="enviarPedidoEntrega(this);">
                            <label for="pedidoCozinha{$i}"><span class="lbEncaminharEntrega">Encaminhar para entrega</span></label>
                        </div>
                        <div class="table-responsive tableOrders">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantidade</th>
                                        <th>Tamanho</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach from=$pedido->getItensPedido() item=it}
                                        <tr>
                                            <td>{$it->getProduto()->getNome()}</td>
                                            <td>{$it->getQuantidade()}</td>
                                            <td>{$it->getTamanho()->getDescricao()}</td>
                                            <td>R$ {$it->getSubtotal()}</td>
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                        <label class="pull-right valorTotal">TOTAL: R$ {$pedido->getValorTotal()}</label>
                        <div class="infoCliente">
                            <h4 class="nomeCliente"><span>Cliente: </span>{$pedido->getCliente()->getNome()}</h4>
                            <h4  data-toggle="collapse" data-target="#enderecoCozinha{$i}" class="elementToggle verEndereco">Detalhes do cliente <i class="fa fa-chevron-circle-down"></i></h4>
                            <div class="collapse" id="enderecoCozinha{$i}">
                                {foreach from=$pedido->getCliente()->getTelefones() item= telefone}
                                    <h5>Telefone:{$telefone->getNumero()}</h5>
                                {/foreach}
                                <h4>Endereço <span class="fa fa-map-marker enderecoMarker"></span></h4>
                                    {foreach from = $pedido->getCliente()->getEnderecos() item = endereco} 
                                    <p>{$endereco->getLogradouro()}, {$endereco->getNumero()}</p>
                                    <p>{$endereco->getBairro()}, {$endereco->getCidade()}</p>
                                    <p>{$endereco->getEstado()}, {$endereco->getCep()}</p>
                                {/foreach}
                                {if $pedido->getLatitude() != null}
                                    <a href="#myMapModal" data-toggle="modal" onclick="initialize({$pedido->getLatitude()},{$pedido->getLongitude()});" class="btn btn-info btn-xs">Mapa</a>
                                {/if}
                            </div>
                        </div>
                        {if $pedido->getObservacoes() != null}
                            <h3 class="obs">Observações: <small>{$pedido->getObservacoes()}</small></h3>
                        {/if}
                    </div>
                    {$i=$i+1}
                {/foreach}
            </div>
        </div>


        <div class="tab-pane" id="tab_c">
            <h4 class="col-xs-12 pull-left pedidosEntregaLb">Pedidos em Entrega <i class="fa fa-refresh fa-spin fa-2x pull-right"></i></h4>
            <div class="col-xs-12" id="pedidosEntrega">
                {$i=0}
                {foreach from=$pedidosEntrega item=pedido}
                    <div class="pedidoDiv" id="pedidoEntregaDiv{$i}">
                        <label class="idPedido">#{$pedido->getId()}</label>
                        <div class="pull-right checkboxPedidoDiv">
                            <input type="hidden" value="{$pedido->getId()}" id="idPedidoEntrega{$i}">
                            <input type="checkBox" class="fwdCheckBox" name="pedidos[]" value="{$i}" id="pedidoEntrega{$i}" onchange="finalizarPedido(this);">
                            <label for="pedidoEntrega{$i}"><span class="lbFinalizar">Finalizar pedido</span></label>
                        </div>
                        <div class="table-responsive tableOrders">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantidade</th>
                                        <th>Tamanho</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach from=$pedido->getItensPedido() item=it}
                                        <tr>
                                            <td>{$it->getProduto()->getNome()}</td>
                                            <td>{$it->getQuantidade()}</td>
                                            <td>{$it->getTamanho()->getDescricao()}</td>
                                            <td>R$ {$it->getSubtotal()}</td>
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                        <label class="pull-right valorTotal">TOTAL: R$ {$pedido->getValorTotal()}</label>
                        <div class="infoCliente">
                            <h4 class="nomeCliente"><span>Cliente: </span>{$pedido->getCliente()->getNome()}</h4>
                            <h4  data-toggle="collapse" data-target="#enderecoEntrega{$i}" class="elementToggle verEndereco">Detalhes do cliente <i class="fa fa-chevron-circle-down"></i></h4>
                            <div class="collapse" id="enderecoEntrega{$i}">
                                {foreach from=$pedido->getCliente()->getTelefones() item= telefone}
                                    <h5>Telefone: {$telefone->getNumero()}</h5>
                                {/foreach}
                                <h4>Endereço <span class="fa fa-map-marker enderecoMarker"></span></h4>
                                    {foreach from = $pedido->getCliente()->getEnderecos() item = endereco} 
                                    <p>{$endereco->getLogradouro()}, {$endereco->getNumero()}</p>
                                    <p>{$endereco->getBairro()}, {$endereco->getCidade()}</p>
                                    <p>{$endereco->getEstado()}, {$endereco->getCep()}</p>
                                {/foreach}
                                {if $pedido->getLatitude() != null}
                                    <a href="#myMapModal" onclick="initialize({$pedido->getLatitude()},{$pedido->getLongitude()});" data-toggle="modal" class="btn btn-info btn-xs">Mapa</a>
                                {/if}
                            </div>
                            {if $pedido->getObservacoes() != null}
                                <h3 class="obs">Observações: <small>{$pedido->getObservacoes()}</small></h3>
                            {/if}
                        </div>
                    </div>
                    {$i=$i+1}
                {/foreach}
            </div>
        </div>

        <div class="tab-pane" id="tab_d">                      
            <button class="btn btn-info btn-sm" data-loading-text="Atualizando ...." onclick="updateHitorico();" id="update">Atualizar Historio</button>
            <h4 class="col-xs-12 pull-left">Historico <img id="historyIcon" class="img img-responsive pull-right" src="{$templateRoot}images/icons/svg/history.svg"/></h4>
            <div id="historico">
                <table id="historicoPedidos" class="table display table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>Detalhes</th>
                        </tr>
                    </thead>
                    <tbody id="bodyHistorico">
                        {$i=0}
                        {foreach from=$historicoPedidos item=pedido}
                            <tr>
                                <td>{$pedido->getId()}</td>
                                <td>{$pedido->getDataHora()->format('d/m/Y - H:i:s')}</td>
                                <td>R$ {$pedido->getValorTotal()}</td>
                                <td <label data-toggle="collapse" data-target="#item{$i}" class="elementToggle verItem">Detalhes <span class="fa fa-eye"></span></label>

                                    <div class="modal" id="item{$i}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h5>{$pedido->getDataHora()->format('d/m/Y - H:i:s')}</h5>
                                                    <h4>Itens</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-condensed">
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
                                                </div>
                                                <div class="modal-footer">
                                                    <label class="pull-right">Valor Total: R$ {$pedido->getValorTotal()}</label>
                                                    <div class="col-xs-12">
                                                        {foreach from=$pedido->getCliente()->getTelefones() item= telefone}
                                                            <h5>Telefone: {$telefone->getNumero()}</h5>
                                                        {/foreach}
                                                        <h4>Cliente: {$pedido->getCliente()->getNome()}</h4>
                                                        {foreach from = $pedido->getCliente()->getEnderecos() item = endereco} 
                                                            <p>{$endereco->getLogradouro()}, {$endereco->getNumero()}</p>
                                                            <p>{$endereco->getBairro()}, {$endereco->getCidade()}</p>
                                                            <p>{$endereco->getEstado()}, {$endereco->getCep()}</p>
                                                        {/foreach}
                                                    </div>
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
        </div>
        {if isset($smarty.get.produtoCadastrado)}
            <div class="alert alert-success alert-dismissible col-xs-12 col-xs-offset-0" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                Produto cadastrado com sucesso.
            </div>
        {/if}

        {if isset($smarty.get.error)}
            <div class="alert alert-danger alert-dismissible col-xs-12 col-xs-offset-0" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                {$smarty.get.error} 
            </div>
        {/if}

        <div class="tab-pane {if isset($smarty.get.produtoCadastrado) || isset($smarty.get.error)}active{/if}" id="tab_e">

            <h4 data-toggle="collapse" data-target="#cardapio" class="elementToggle" id="openCardapio">Cardápio <b class="caret"></b></h4>
            <div id="cardapio" class="collapse">
                <ul class="nav nav-tabs nav-justified" data-tabs="tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#comida" data-toggle="tab">Comida</a></li>
                    <li role="presentation"><a href="#bebida" data-toggle="tab">Bebida</a></li>
                </ul>
                <div class="tab-content">
                    <div id="comida" class="tab-pane active fade in">
                        {foreach from=$produtosComida item=produto}
                            <div class="produto">
                                <p class="nome">{$produto->getNome()}</p>
                                {foreach from = $produto->getTamanhos() item=tamanho}
                                    <div class="tamanho row col-xs-12">
                                        <div class="tam">
                                            <p class="pull-left descricaoTamanho">{$tamanho->getDescricao()}</p>
                                            <p class="pull-right precoTamanho">R$ {$tamanho->getPreco()}</p>
                                        </div>
                                    </div>
                                {/foreach}
                                <h6 data-toggle="collapse" data-toggle="tooltip" data-placement="right" title="Clique para ver os ingredientes" data-target="#ingredientes{$produto->getId()}" class="elementToggle ingredientesLabel">Ingredientes</h6>
                                <div id="ingredientes{$produto->getId()}" class="collapse ingredientes fade">
                                    <p>{$produto->getIngredientes()}</p>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                    <div id="bebida" class="tab-pane fade">
                        {foreach from=$produtosBebida item=produto}
                            <div class="produto">
                                <p class="nome">{$produto->getNome()}</p>
                                {foreach from = $produto->getTamanhos() item=tamanho}
                                    <div class="tamanho row col-xs-12">
                                        <div class="tam">
                                            <p class="pull-left descricaoTamanho">{$tamanho->getDescricao()}</p>
                                            <p class="pull-right precoTamanho">R$ {$tamanho->getPreco()}</p>
                                        </div>
                                    </div>
                                {/foreach}
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
            <h4 data-toggle="collapse" data-target="#produtos" class="elementToggle" id="openInserir">Inserir Novo Produto <b class="caret"></b></h4>

            <div id="produtos" class="collapse">
                <ul class="nav nav-tabs nav-justified" data-tabs="tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#addComida" data-toggle="tab">Comida</a></li>
                    <li role="presentation"><a href="#addBebida" data-toggle="tab">Bebida</a></li>
                </ul>
                <div class="tab-content">
                    <div id="addComida" class="tab-pane active fade in">
                        <form class="form-horizontal col-xs-10 col-xs-offset-1" method="POST" id="addComidaForm" class="addProduto" action="{$templateRoot}src/app/processes/ProcessProduto.php" enctype="multipart/form-data">
                            <h4 class="formLegend">Novo item</h4>
                            <input type="hidden" name="idRestaurante" id="idRestaurante" value="{$smarty.session.idRestaurante}"/>
                            <input type="hidden" name="categoria" id="categoria" value="1"/>
                            <div class="form-group">
                                <input type="text" placeholder="Nome do produto" name="nomeProduto" class="form-control"/>
                            </div>

                            <div class="form-group" id="ingDiv">
                                <textarea class='form-control' rows='3' name='ingredientes' id='ingredientes' placeholder='Ingredientes' required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Imagem do ítem</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <p id="imageSize">Maxímo: 1MB</p>

                            <div class="form-group">   
                                <label id="lbTamanho" class="col-sm-2">Tamanho(s):</label>

                                <div id="tamanhosDiv" class="col-xs-12 form-group">
                                    <div class= 'checkboxes'>
                                        {foreach $tamanhosComida as $tamanho}
                                            <div class='checkboxDiv col-xs-12 checkbox'>
                                                <label class='labelTamanho'>
                                                    <input class='checkboxTamanho' type='checkbox' name='tamanhos[]' onchange='checkCreatePriceComida(this);' value='{$tamanho->getId()}' id= '{$tamanho->getId()}'/> {$tamanho->getDescricao()}
                                                </label>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                            <button  type="button" onclick="callResetForm('addComidaForm');" class="btn btn-default btn-sm">Limpar</button>        
                            <button type="submit" class="btn btn-success pull-right" name="formSubmit" value="cadastrarProduto"> Cadastrar </button>
                        </form>
                    </div>
                    <div id="addBebida" class="tab-pane fade">
                        <form class="form-horizontal col-xs-10 col-xs-offset-1" method="POST" id="addBebidaForm" class="addProduto" action="{$templateRoot}src/app/processes/ProcessProduto.php">
                            <h4 class="formLegend">Novo item</h4>
                            <input type="hidden" name="idRestaurante" id="idRestaurante" value="{$smarty.session.idRestaurante}"/>
                            <input type="hidden" name="categoria" id="categoria" value="2"/>
                            <div class="form-group">
                                <input type="text" placeholder="Nome do produto" name="nomeProduto" class="form-control"/>
                            </div>

                            <div class="form-group">   
                                <label id="lbTamanho" class="col-sm-2">Tamanho(s):</label>

                                <div id="tamanhosDiv" class="col-xs-12 form-group">
                                    <div class= 'checkboxes'>
                                        {foreach $tamanhosBebida as $tamanho}
                                            <div class='checkboxDiv col-xs-12 checkbox'>
                                                <label class='labelTamanho'>
                                                    <input class='checkboxTamanho' type='checkbox' name='tamanhos[]' onchange='checkCreatePriceBebida(this);' value='{$tamanho->getId()}' id='{$tamanho->getId()}'/> {$tamanho->getDescricao()}
                                                </label>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                            <button  type="button" onclick="callResetForm('addBebidaForm');" class="btn btn-default btn">Limpar</button>        
                            <button type="submit" class="btn btn-success pull-right" name="formSubmit" value="cadastrarProduto"> Cadastrar </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- tab content -->
</div>
<div class="modal fade" id="myMapModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Localização aproximada do cliente</h4>
                <p class="text-danger">A localização não indica exatamente o endereço do cliente, e a precisão pode variar.</p>
            </div>
            <div class="modal-body">
                <div id="map-canvas" class="col-xs-12">
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-modal" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
