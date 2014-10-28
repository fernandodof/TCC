<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <link href= "../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/header.css" rel="stylesheet">
        <link href= "../css/styles.css" rel="stylesheet">
        {* Move this script tags *}
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            {* Creating a navigation bar *}
            <nav class="navbar navbar-custom navbar-static-top">
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
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="./index.php">Home</a></li>
                                {if !isset($smarty.session.id)}
                                <li><a href="./subscribe.php">Cadastro</a></li>
                                {/if}
                                {* Creating Dropdown menu and form *}
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