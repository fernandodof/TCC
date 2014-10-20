<head>
    <script>
        function callFilter(str) {
            $('#wait').show();
            setTimeout("filter(" + str + ")", 250);
        }

        function filter(str) {
            var xmlhttp;

            if (str === '') {
                $('#lbTamanho').removeClass("visible").addClass("invisible");
                return;
            }

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            if (xmlhttp) {
                xmlhttp.open("GET", "../src/app/util/tamanhosProduto.php?cat=" + str, true);

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState === 4) {
                        document.getElementById('tamanhosDiv').innerHTML = this.responseText;
                        $('#lbTamanho').removeClass("invisible").addClass("visilble");
                    }
                };
                $('#wait').hide();
                xmlhttp.send();
            }
        }
    </script>
</head>
<link href="../css/funcionarioPage.css" rel="stylesheet" type="text/css">
<div class="container" id="page">
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
            <form class="form-horizontal col-md-10" method="POST" name="addProduto">
                <h4>Inserir Novo Produto <i class="glyphicon glyphicon-plus-sign"></i></h4>
                <div class="form-group">
                    <select name="categoia" class="form-control" onchange="window.callFilter(this.value);" required>
                        <option value="">Escolha a categria</option>
                        {foreach from = $categorias item = categoria}
                            <option value="{$categoria->getId()}">{$categoria->getNome()}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Nome do produto" name="nomeProduto" class="form-control"/>
                </div>

                <div class="form-group">
                    <textarea class="form-control" rows="3" placeholder="Ingredientes"></textarea>
                </div>

                <div class="form-group">   
                    <label id="lbTamanho" class="invisible col-sm-2">Tamanho(s):</label>
                    <div id="tamanhosDiv" class="col-sm-8 form-group">
                        <span id="wait" style="display: none;"><img src="../images/ajax-loader.gif" alt = "Aguarde..."></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-success pull-right" name="formSubmit" value="cadastrarProduto"> Cadastrar </button>
            </form>
        </div>
    </div>
</div> <!-- tab content --