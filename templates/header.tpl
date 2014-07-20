<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link href= "../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/header.css" rel="stylesheet">
        <link href= "../css/styles.css" rel="stylesheet">
        {* Move this script tags *}
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            {* Creating a navigation bar *}
            <div class="navbar navbar-custom navbar-static-top">
                <div class="container">
                    <a href="./index.php" class="navbar-brand">{$siteName}</a>
                    {* Creating toggle button for navigation bar *}
                    <button class="navbar-toggle" data-toggle = "collapse" data-target = ".custonNavHeaderCollapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse custonNavHeaderCollapse">
                        {* Creating list for Navigation bar options *}
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="#">Cadastro</a></li>
                                {* Creating Dropdown menu and form *}
                            
                            <li class="dropdown" id="menuLogin">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login <b class="caret"></b></a>
                                <div class="dropdown-menu">
                                    <form class="form-horizontal" id="loginForm" method="POST" action="#">
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
                                        <button type="submit" class="btn btn-info">Login</button>
                                    </form>
                                </div>
                            </li>
                           
                            <li><a href="#">Sobre</a></li>
                            <li><a href="#contact" data-toggle="modal">Contato</a></li>
                        </ul>

                    </div>

                </div>
            </div>
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
                                        <input type="email" class="form-control" name="nameContact" id="emailContact" placeholder="voçe@exemplo.com">
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
                                <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {*
            </header>
            </body>
            </html>*}