<head>
    <script src="{$templateRoot}js/jquery.priceFormat.min.js" type="text/javascript"></script>
    <script src="{$templateRoot}js/funcionarioPageFunctions.js" type="text/javascript"></script>
    <script src="{$templateRoot}dataTables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link href="{$templateRoot}css/funcionarioPage.css" rel="stylesheet" type="text/css">
    <link href="{$templateRoot}dataTables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="{$templateRoot}dataTables/media/css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css">
    <link href="{$templateRoot}css/cardapio.css" rel="stylesheet" type="text/css">
    <link href="{$templateRoot}css/animate.css-master/animate.min.css" rel="stylesheet" type="text/css">
</head>

<div class="container" id="page">
    <h3>{$smarty.session.funcRestaurante}</h3>
    <ul class="nav nav-pills nav-stacked col-md-3 sidebar">
        <li class=""><a href="#tab_a" data-toggle="pill">Novos Pedidos <span class="glyphicon glyphicon-shopping-cart"></span></a></a></li>
        <li class=""><a href="#tab_b" data-toggle="pill">Pedidos na Cozinha <img class="img img-responsive pull-right" src="{$templateRoot}images/icons/svg/chef16.svg" alt="Cozinha"></a></li>
        <li class=""><a href="#tab_c" data-toggle="pill">Pedidos em entrega <img class="img img-responsive pull-right" src="{$templateRoot}images/icons/svg/logistics3.svg" alt="Cozinha"></a></li>
        <li class=""><a href="#tab_d" data-toggle="pill">Histórico de Pedidos <span class="fa fa-history"></span></a></li>
        <li class="{if isset($smarty.get.produtoCadastrado)}active{/if}"><a href="#tab_e" data-toggle="pill">Cardápio <span class="glyphicon glyphicon-list-alt"></span></a></li>
    </ul>
    <div class="tab-content col-md-9">
        <div class="tab-pane" id="tab_a">
            <h4 class="col-xs-12 pull-left novosPedidosLb">Novos Pedidos <i class="fa fa-refresh fa-spin fa-2x pull-right"></i></h4>
            <div class="col-xs-12" id="pedidosRecebidos">
                {$i=0}
                {foreach from=$pedidosRecebidos item=pedido}
                    <div class="pedidoDiv" id="pedidoRecebidoDiv{$i}">
                        <label class="idPedido">#{$pedido->getId()}</label>
                        <div class="pull-right checkboxPedidoDiv">
                            <input type="hidden" value="{$pedido->getId()}" id="idPedidoRecebido{$i}">
                            <input type="checkBox" name="pedidos[]" value="{$i}" id="pedidoRecebido{$i}" onchange="enviarPedidoCozinha(this);">
                            <label for="pedidoRecebido{$i}"><span class="lbEncaminharCozinha">Encaminhar para cozinha</span></label>
                        </div>
                        <table class="table table-condensed table-responsive table-striped">
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
                        <label class="pull-right valorTotal">TOTAL: R$ {$pedido->getValorTotal()}</label>
                        <div class="infoCliente">
                            <h4 class="nomeCliente"><span>Cliente: </span>{$pedido->getCliente()->getNome()}</h4>
                            <h4  data-toggle="collapse" data-target="#enderecoNovosPedidos{$i}" class="elementToggle verEndereco">Clique Aqui Para Ver o Endereço <i class="fa fa-chevron-circle-down"></i></h4>
                            <div class="collapse" id="enderecoNovosPedidos{$i}">
                                {foreach from = $pedido->getCliente()->getEnderecos() item = endereco} 
                                    <p>{$endereco->getLogradouro()}, {$endereco->getNumero()}</p>
                                    <p>{$endereco->getBairro()}, {$endereco->getCidade()}</p>
                                    <p>{$endereco->getEstado()}, {$endereco->getCep()}</p>
                                {/foreach}
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
                            <input type="checkBox" name="pedidos[]" value="{$i}" id="pedidoCozinha{$i}" onchange="enviarPedidoEntrega(this);">
                            <label for="pedidoCozinha{$i}"><span class="lbEncaminharEntrega">Encaminhar para entrega</span></label>
                        </div>
                        <table class="table table-condensed table-responsive table-striped">
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
                        <label class="pull-right valorTotal">TOTAL: R$ {$pedido->getValorTotal()}</label>
                        <div class="infoCliente">
                            <h4 class="nomeCliente"><span>Cliente: </span>{$pedido->getCliente()->getNome()}</h4>
                            <h4  data-toggle="collapse" data-target="#enderecoCozinha{$i}" class="elementToggle verEndereco">Clique Aqui Para Ver o Endereço <i class="fa fa-chevron-circle-down"></i></h4>
                            <div class="collapse" id="enderecoCozinha{$i}">
                                {foreach from = $pedido->getCliente()->getEnderecos() item = endereco} 
                                    <p>{$endereco->getLogradouro()}, {$endereco->getNumero()}</p>
                                    <p>{$endereco->getBairro()}, {$endereco->getCidade()}</p>
                                    <p>{$endereco->getEstado()}, {$endereco->getCep()}</p>
                                {/foreach}
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
                            <input type="checkBox" name="pedidos[]" value="{$i}" id="pedidoEntrega{$i}" onchange="finalizarPedido(this);">
                            <label for="pedidoEntrega{$i}"><span class="lbFinalizar">Finalizar pedido</span></label>
                        </div>
                        <table class="table table-condensed table-responsive table-striped">
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
                        <label class="pull-right valorTotal">TOTAL: R$ {$pedido->getValorTotal()}</label>
                        <div class="infoCliente">
                            <h4 class="nomeCliente"><span>Cliente: </span>{$pedido->getCliente()->getNome()}</h4>
                            <h4  data-toggle="collapse" data-target="#enderecoEntrega{$i}" class="elementToggle verEndereco">Clique Aqui Para Ver o Endereço <i class="fa fa-chevron-circle-down"></i></h4>
                            <div class="collapse" id="enderecoEntrega{$i}">
                                {foreach from = $pedido->getCliente()->getEnderecos() item = endereco} 
                                    <p>{$endereco->getLogradouro()}, {$endereco->getNumero()}</p>
                                    <p>{$endereco->getBairro()}, {$endereco->getCidade()}</p>
                                    <p>{$endereco->getEstado()}, {$endereco->getCep()}</p>
                                {/foreach}
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

        <div class="tab-pane" id="tab_d">                      
            <button class="btn btn-info btn-sm" data-loading-text="Atualizando ...." onclick="updateHitorico();" id="update">Atualizar Historio</button>
            <h4 class="col-xs-12 pull-left">Historico <img id="historyIcon" class="img img-responsive pull-right" src="{$templateRoot}images/icons/svg/history.svg"/></h4>
            <div id="historico">
                <table id="historicoPedidos" class="display table-striped">
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
                                                    <h5>{$pedido->getDataHora()->format('d/m/Y - H:i:s')}</h5>
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
                                                    <div class="col-xs-12">
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

        <div class="tab-pane {if isset($smarty.get.produtoCadastrado)}active{/if}" id="tab_e">
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
            <h4 data-toggle="collapse" data-target="#addProduto" class="elementToggle" id="openInserir">Inserir Novo Produto <b class="caret"></b></h4>
                {if isset($success)}
                <div class="alert alert-success alert-dismissible col-md-10" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                    Produto cadastrado com sucesso
                </div>
            {/if}
            <form class="form-horizontal col-md-10 collapse" method="POST" name="addProduto" id="addProduto" action="../src/app/processes/ProcessProduto.php">
                <input type="hidden" name="idRestaurante" id="idRestaurante" value="{$smarty.session.idRestaurante}"/>
                <div class="form-group">
                    <select name="categoria" class="form-control" onchange="window.callFilter(this.value);" required>
                        <option value="">Escolha a categria</option>
                        {foreach from = $categorias item = categoria}
                            <option value="{$categoria->getId()}">{$categoria->getNome()}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Nome do produto" name="nomeProduto" class="form-control"/>
                </div>

                <div class="form-group" id="ingDiv">
                    {*                    <textarea class="form-control" rows="3" name="ingredientes" id="ingredientes" placeholder="Ingredientes"></textarea>*}
                </div>

                <div class="form-group">   
                    <label id="lbTamanho" class="invisible col-sm-2">Tamanho(s):</label>
                    <span id="wait" style="display: none;"><img src="../images/ajax-loader1.gif" alt = "Aguarde..."></span>
                    <div id="tamanhosDiv" class="col-xs-12 form-group">
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-success pull-right" name="formSubmit" value="cadastrarProduto"> Cadastrar </button>
            </form>
        </div>
    </div>
</div> <!-- tab content -->