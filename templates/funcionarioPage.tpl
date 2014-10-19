<link href="../css/funcionarioPage.css" rel="stylesheet" type="text/css">
<div class="container">
    <h3>{$smarty.session.funcRestaurante}</h3>
    <ul class="nav nav-pills nav-stacked col-md-2 sidebar">
        <li class="active"><a href="#tab_a" data-toggle="pill">Pedidos<span class="glyphicon glyphicon-shopping-cart"></span></a></li>
        <li><a href="#tab_b" data-toggle="pill">Cardápio<span class="glyphicon glyphicon-list-alt"></span></a></li>
    </ul>
    <div class="tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
            <h4>Pedidos</h4>
            <p></p>
        </div>
        <div class="tab-pane" id="tab_b">
            <h4>Cardápio</h4>
            <form class="form-horizontal col-md-10">
                <h4>Inserir Novo Produto <i class="glyphicon glyphicon-plus-sign"></i></h4>
                <label class="pull-left">Categoria</label>
                <div class="form-group">
                    <select name="categoia" class="form-control">
                        <option value="">Escolha a categria</option>
                        {foreach from = $categorias item = categoria}
                            <option value="{$categoria->getId()}">{$categoria->getNome()}</option>
                        {/foreach}
                        
                    </select>
                </div>
            </form>
        </div>
    </div>
</div> <!-- tab content --