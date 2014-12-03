<link href= "{$templateRoot}css/footer.css" rel="stylesheet">
{*Creating botton navbar*}
<div class="navbar navbar-inverse navbar-static navbar-bottom">
    <div class="container">
        <p class="navbar-text pull-left">{$footerBarMsg}</p>
        {* Creating toggle button for botton navigation bar *}
        <button class="navbar-toggle" data-toggle = "collapse" data-target = ".bottomNavHeaderCollapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse bottomNavHeaderCollapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{$templateRoot}pages/areaRestrita">Area restrita</a></li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>