<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href= "../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href= "../css/styles.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            {* Creating a navigation bar *}
            <div class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <a href="../" class="navbar-brand">{$siteName}</a>
                    {* Creating toggle button *}
                    <button class="navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse navHeaderCollapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../index.php">Cadastro</a></li>
                            <li><a href="../index.php">Login</a></li>
                            <li><a href="../index.php">Sobre</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </header>
    </body>
</html>