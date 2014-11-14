<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href= "../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <meta charset="UTF-8">
        <link href="../css/header.css" rel="stylesheet">
        <link href= "../css/styles.css" rel="stylesheet">
        {* Move this script tags *}
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery.dim-background.js"></script>

        <link href="../alertify.js-0.3.11/themes/alertify.core.css" type="text/css" rel="stylesheet">
        <link href="../alertify.js-0.3.11/themes/alertify.default.css" type="text/css" rel="stylesheet">
        <link href="../alertify.js-0.3.11/themes/alertify.bootstrap.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="../alertify.js-0.3.11/lib/alertify.min.js"></script>
        <link href="../font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <header>
            {* Creating a navigation bar *}
            <nav class="navbar navbar-inverse navbar-custom navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        {* Creating toggle button for navigation bar *}
                        <button type="button" class="navbar-toggle collapsed" data-toggle = "collapse" data-target = ".custonNavHeaderCollapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="../pages/index.php">{$siteName}</a>
                    </div>
                    <div class="collapse navbar-collapse custonNavHeaderCollapse">
                        {* Creating list for Navigation bar options *} 
                        <ul class="nav navbar-nav navbar-right" id="bar">
                            <li><a href="./index.php">Home</a></li>
                                {if !isset($smarty.session.id)}
                                <li><a href="./subscribe.php">Cadastro</a></li>
                                <li class="dropdown" id="menuLogin">
                                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login <b class="caret"></b></a>
                                    <div class="dropdown-menu">
                                        <form class="form-horizontal" id="loginForm" method="POST" action="../src/app/processes/ProcessCliente.php">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <input name="emailLogin" id="emailLogin" class="form-control" type="email" placeholder="Email" required> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <input name="senhaLogin" id="senhaLogin" class="form-control" type="password" placeholder="Senha" required>
                                                </div>
                                            </div>
                                            <button type="submit" name="formSubmit" value="Login" class="btn btn-info pull-right">Login</button>
                                        </form>
                                    </div>
                                </li>
                            {/if}
                            {* Creating Dropdown menu and form *}
                            <li><a href="#">Sobre</a></li>
                            <li><a href="#contact" data-toggle="modal">Contato</a></li>
                                {if isset($smarty.session.id)}
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user">
                                        </span> Minha Conta <span class="caret"></span></a>

                                    <ul class="dropdown-menu" id="dropdownBar" role="menu">
                                        {if {$smarty.session.tipo == 'funcionario'}}
                                            <li><a href="./funcionarioPage.php">Minha Conta</a></li>
                                            {else}
                                            <li><a href="./clientePage.php">Minha Conta</a></li>
                                            {/if}
                                        <li class="divider"></li>
                                        <li><form class="form-horizontal" method="POST" action="../pages/logout.php">
                                                <button type="submit" name="formSubmit" value="Logout" class="btn btn-danger pull-right">Sair</button>
                                            </form></li>
                                    </ul>
                                </li>
                                <li id="liGotoCart">
                                    {if isset($smarty.session.pedido)}

                                        <form method="post" action="../pages/confirmOrder.php" id="goToCart">
                                            <button class="btn" type="submit"><img src="../images/icons/cartIcon2.png" title="Pedido" alt="Pedido">
                                                <span class="badge" id="badgePedido">{$smarty.session.pedido->getItensPedido()|@count}</span></button>
                                            <input type="hidden" name="idRestaurantePedido" id="idRestaurantePedido" 
                                                   value="{$smarty.session.idRestauranteDoPedidoAtual}">
                                        </form>

                                    {/if}
                                </li>
                            {/if}
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal" id="contact" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form-horizontal" id="contactForm" method="POST" action="#">
                            <div class="modal-header">
                                <h4>Fale conosco</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="nameContact">Nome:</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="nameContact" id="nameContact" placeholder="Nome completo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="emailContact">Email: </label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" name="nameContact" id="emailContact" placeholder="você@exemplo.com">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="messageContact">Mensagem:</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="messageContact" id="messageContact" rows="8" placeholder="Insira a sua mensagem aqui"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Enviar <span class="glyphicon glyphicon-send"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        {*</body>
        </html>*}