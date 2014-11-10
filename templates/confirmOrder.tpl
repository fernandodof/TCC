<link href="../css/conformOrder.css" rel="stylesheet" type="text/css">
<link href="../font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script>
    {literal}
        function removeProduct(indexProduto) {
            $('body').dimBackground();
            $('#loader').show();
            $("body").find("input,button,textarea").attr("disabled", "disabled");

            var data = {indexProduto: indexProduto, command: "remove"};
            var url = '../src/app/ajaxReceivers/changeOrder.php';

            $.ajax({
                type: "POST",
                url: url,
                async: true,
                data: data,
                success: function (serverResponse) {
                    if (serverResponse === 'Erro') {
                        $('#loader').hide();
                        alert('Ocorreu um erro com a sua solicitação');
                        $('body').undim();
                        $("body").find("input,button,textarea").removeAttr("disabled");
                    }
                    else {
                        $('body').undim();
                        $("body").find("input,button,textarea").removeAttr("disabled");
                        $('#loader').hide();
                        $('#cart').html(serverResponse);
                    }
                },
                error: function (data) {
                    alert("Ocorreu um erro com a sua solicitação");
                }
            });
        }

        function updateQuantity(indexProduto) {
            $('body').dimBackground();
            $('#loader').show();
            $("body").find("input,button,textarea").attr("disabled", "disabled");

            var quantidade = $('#quantidade'+indexProduto).val();
            var data = {indexProduto: indexProduto, quantidade: quantidade ,command: "update"};
            var url = '../src/app/ajaxReceivers/changeOrder.php';

            $.ajax({
                type: "POST",
                url: url,
                async: true,
                data: data,
                success: function (serverResponse) {
                    if (serverResponse === 'Erro') {
                        $('#loader').hide();
                        alert('Ocorreu um erro com a sua solicitação');
                        $('body').undim();
                        $("body").find("input,button,textarea").removeAttr("disabled");
                    }
                    else {
                        $('body').undim();
                        $("body").find("input,button,textarea").removeAttr("disabled");
                        $('#loader').hide();
                        $('#cart').html(serverResponse);
                    }
                },
                error: function (data) {
                    alert("Ocorreu um erro com a sua solicitação");
                }
            });
        }
    {/literal}
</script>

<div class="container">
    <img src="../images/loader.GIF" title="Carregando" alt="Carregando" class="img img-responsive" id="loader">
    <h2>{$restaurante->getNome()}</h2>

    {if isset($smarty.session.pedido)}
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
                                {if ($it->getProduto()->getIngredientes() ==null)}
                                    <div class="col-sm-2 hidden-xs"><img src="../images/icons/drink.png" alt="..." class="img-responsive"/></div>
                                    {else}
                                    <div class="col-sm-2 hidden-xs"><img src="../images/icons/food.png" alt="..." class="img-responsive"/></div>
                                    {/if}
                                <div class="col-sm-10">
                                    <h4 class="nomargin nomeProduto">{$it->getProduto()->getNome()} <span class="tamanho"> - {$it->getTamanho()->getDescricao()}</span></h4>
                                    <p>{$it->getProduto()->getIngredientes()}</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">R$ {$it->getTamanho()->getPreco()}</td>
                        <td data-th="Quantity">
                            <input type="number" class="form-control text-center" min="1" max="99" id="quantidade{$i}" value="{$it->getQuantidade()}">
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
                    <td class="text-center"><strong>Total</strong></td>
                </tr>
                <tr>
                    <td><a href="../pages/restaurant.php?res={$smarty.session.idRestauranteDoPedidoAtual}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Voltar ao cardápio</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total R$ {$smarty.session.pedido->getValorTotal()}</strong></td>
            <form method="POST">
                <td><a href="#" class="btn btn-success btn-block">Comfirmar <i class="fa fa-angle-right"></i></a></td>
            </form>
            </tr>
            </tfoot>
        </table>
    {/if}
</div>