<!DOCTYPE html>
<html>
    <head>
        <title>Área Restrita</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta charset="UTF-8">
        <link href= "{$templateRoot}bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href= "{$templateRoot}css/styles.css" rel="stylesheet">
        <link href="{$templateRoot}css/areaRestrita.css" rel="stylesheet"/>
        <link href="{$templateRoot}css/animate.css-master/animate.min.css" rel="stylesheet" type="text/css">
        {* Move this script tags *}
        <script src="{$templateRoot}bootstrap/js/jquery.min.js"></script>
        <script src="{$templateRoot}bootstrap/js/bootstrap.min.js"></script>
        <script src="{$templateRoot}js/areaRestrita.js"></script>
        {*<script src="../bootstrap/js/jquery.min.js"></script>*}
    </head>

    <div class="container">
        <input type="hidden" id="templateRoot" value="{$templateRoot}">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">ÁREA RESTRITA</h1>
                <div class="account-wall">
                    <img class="profile-img img-rounded" src="../images/icons/tray.png"
                         alt="Imagem Usuário" title="Imagem Usuário">
                    <form name="loginForm" class="form-signin" action="javascript:void(0)" method="POST">
                        <input type="text" name="funcLogin" id="funcLogin" class="form-control inputLogin" placeholder="Login" required autofocus>
                        <input type="password" name="funcSenha" id="funcSenha" class="form-control inputLogin" placeholder="Senha" required>
                        <button class="btn btn-lg btn-primary btn-block" id="btnLogin" data-loading-text="Entrar..." onclick="validateLogin();" type="submit" name="formSubmit" value="Login">Entrar</button>
                    </form>
                    <small id="loginErrorMsg" class="help-block">Login ou senha inválidos</small>
                </div>
                <a href="../pages/index.php" class="text-center index-page">Página Inicial</a>
            </div>
        </div>
    </div>
</html>