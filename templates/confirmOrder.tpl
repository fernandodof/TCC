<link href="{$templateRoot}font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="{$templateRoot}css/animate.css-master/animate.min.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}css/confirmOrder.css" rel="stylesheet" type="text/css">
<script src="{$templateRoot}js/updateOrder.js" type="text/javascript"></script>
<div class="container">
    {*<span id="sumitingOrder" class="fa fa-fw fa-facebook fa-spin fa-5x"></span>*}
    {if isset($smarty.session.pedido)}
        <input type="hidden" id="idRestaurante" value="{$smarty.session.idRestauranteDoPedidoAtual}">
        <h2>{$restaurante->getNome()}</h2>
        <div id="confirmation">
            <h2 class="success-msg">Pedido realizado com sucesso</h2>
            <div id='faces'>
                <img id = 'imgFace' src ='{$templateRoot}images/icons/svg/happyFace.svg'/>
            </div>
            <a href='{$templateRoot}pages/index' class='btn btn-primary btn-lg'><span class='glyphicon glyphicon-home'></span> Página inicial</a>
        </div>
        {if isset($smarty.session.pedido)}
            <div id="orderInfo">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th id="ProdutoTh">Produto</th>
                            <th id="ValorTh">Valor</th>
                            <th id="ValorTh">Quantidade</th>
                            <th id="SubtotalTh" class="text-center">Subtotal</th>
                            <th id="ButtonsTh"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {$i = 0}
                        {foreach from=$smarty.session.pedido->getItensPedido() item=it}
                            <tr>
                                <td data-th="Item">
                                    <div class="row">
                                        {if ($it->getProduto()->getIngredientes() == null)}
                                            <div class="col-sm-2 hidden-xs">
                                                {if $it->getProduto()->getImagem() != null}
                                                    <img src="{$templateRoot}{$it->getProduto()->getImagem()}" alt="Bebida" class="img-responsive productImg"/>
                                                {else}    
                                                    <img src="{$templateRoot}images/icons/drink.png" alt="Bebida" class="img-responsive productImg"/>
                                                {/if}
                                            </div>
                                        {else}
                                            <div class="col-sm-2 hidden-xs">
                                                {if $it->getProduto()->getImagem() != null}
                                                    <img src="{$templateRoot}{$it->getProduto()->getImagem()}" alt="Bebida" class="img-responsive productImg"/>
                                                {else}    
                                                    <img src="{$templateRoot}images/icons/food.png" alt="Comida" class="img-responsive productImg"/>
                                                {/if}
                                            </div>
                                        {/if}
                                        <div class="col-sm-10">
                                            <h4 class="nomargin nomeProduto">{$it->getProduto()->getNome()} <span class="tamanho"> - {$it->getTamanho()->getDescricao()}</span></h4>
                                            <p>{$it->getProduto()->getIngredientes()}</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Preço: ">R$ {$it->getTamanho()->getPreco()}</td>
                                <td data-th="Quantidade: ">
                                    <input type="number" class="form-control" min="1" max="99" id="quantidade{$i}" value="{$it->getQuantidade()}">
                                </td>
                                <td data-th="Subtotal" class="text-center">R$ {$it->getSubtotal()}</td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-info btn-sm" onclick="updateQuantity({$i});" ><i class="glyphicon glyphicon-refresh"></i></button>
                                    <button class="btn btn-danger btn-sm" onclick="removeProduct({$i});"><i class="fa fa-trash-o"></i></button>								
                                </td>
                            </tr>
                            {$i=$i+1}
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr class="visible-xs">
                            <td class="text-center bold">Total R$ {$smarty.session.pedido->getValorTotal()}</td>
                        </tr>
                        <tr>
                            <td><a href="{$templateRoot}pages/restaurant/{$smarty.session.idRestauranteDoPedidoAtual}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Voltar ao cardápio</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center bold">Total R$ {$smarty.session.pedido->getValorTotal()}</td>
                    <form method="POST" action="javascript:void(0)">
                        <td><button class="btn btn-success btn-block" data-loading-text="Enviando..." id="confirmar" onclick="checkout();"> Comfirmar <i class="fa fa-angle-right"></i></button></td>
                    </form>
                    </tr>
                    </tfoot>
                </table>

                <div class="row">
                    <div id="enderecoEntrega" class="col-md-4">
                        <h5 id="nome" class="bold">{$cliente->getNome()}</h5>
                        <h6 class="bold">Endereco de entrega: </h6>
                        <div>
                            {foreach from = $cliente->getEnderecos() item = endereco} 
                                <p>{$endereco->getLogradouro()}, {$endereco->getNumero()}</p>
                                <p>{$endereco->getBairro()}, {$endereco->getCidade()}</p>
                                <p>{$endereco->getEstado()}, {$endereco->getCep()}</p>
                            {/foreach}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" placeholder="Se você tem alguma requisição especial sobre o seu pedido insira aqui" 
                                  rows="5" id="observacoes" name="observacoes"></textarea>
                    </div>
                </div>
            </div>
        {/if}
    {else}
        {literal}
            <script>location.href = "../pages/clientePage";</script>
        {/literal}
    {/if}
    <div id="sumitingOrderDiv">
        <img id="sumitingOrder" class="rotating" src="{$templateRoot}images/icons/plate.svg">
        <h4 class="center">Aguarde...</h4>
    </div>
</div>