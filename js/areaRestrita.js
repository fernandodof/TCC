var templateRoot;

function validateLogin() {
    var funcLogin = $('#funcLogin').val();
    var funcSenha = $('#funcSenha').val();

    var data = {funcLogin: funcLogin, funcSenha: funcSenha, type: 'funcionario'};
    var url = templateRoot + 'src/app/ajaxReceivers/validateLogin.php';

    $('#btnLogin').button('loading');
    $('.inputLogin').removeClass('inputLoginError');
    $('.profile-img').removeClass('errorImg');
    $('.profile-img').removeClass('animated rubberBand')
    $('#loginErrorMsg').hide();

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === '1') {
                window.location.replace(templateRoot + 'pages/funcionarioPage');
            } else {
                $('.inputLogin').addClass('inputLoginError');
                $('.profile-img').addClass('errorImg');
                $('.profile-img').addClass('animated rubberBand');
                $('#btnLogin').button('reset');
                $('#loginErrorMsg').show();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
            alert(textStatus);
            alert(jqXHR);
        }, complete: function (jqXHR, textStatus) {
        }
    });

}

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
});