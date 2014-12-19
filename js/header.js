var templateRoot;

function validateLogin() {
    var emailLogin = $('#emailLogin').val();
    var senhaLogin = $('#senhaLogin').val(); 
    
    var data = {emailLogin: emailLogin, senhaLogin: senhaLogin};
    var url = templateRoot + 'src/app/ajaxReceivers/validateLogin.php';
    $('#btnLogin').button('loading');
    $('.loginFormGroup').removeClass('has-error');
    $('.helpTextLogin').hide();
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if(serverResponse === '1'){
                document.forms["loginForm"].submit();
            }else{
                $('.loginFormGroup').addClass('has-error');
                $('#btnLogin').button('reset');
                $('.helpTextLogin').show();
            }
        },
        error: function (data) {
            alert("Error");
        }
    });

}

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
});