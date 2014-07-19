<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href= "../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/header.css" rel="stylesheet">
        <link href= "../css/styles.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            {* Creating a navigation bar *}
            <div class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <a href="../" class="navbar-brand">{$siteName}</a>
                    {* Creating toggle button for navigation bar *}
                    <button class="navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {* Creating Navigation bar*}
                    <div class="collapse navbar-collapse navHeaderCollapse">
                        {* Creating list for Navigation bar options *}
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="#">Cadastro</a></li>
                             {* Creating Dropdown menu and form *}
                            <li class="dropdown" id="menuLogin">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login <b class="caret"></b></a>
                                <div class="dropdown-menu">
                                    <form class="form" id="loginForm" method="POST" action="#"> 
                                        <input name="emailLogin" id="emailLogin" class="input" type="email" placeholder="Email" required> 
                                        <input name="senhaLogin" id="senhaLogin" class="input" type="password" placeholder="Senha" required>
                                        <button type="submit" class="btn btn-info">Login</button>
                                    </form>
                                </div>
                            </li>
                            <li><a href="#">Sobre</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </header>
    </body>
</html>