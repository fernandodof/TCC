var templateRoot;

function sendContactMessage() {
    $('#sendEmailContact').button('loading');
//    var name = $('#nameContact').val();
//    var email = $('#emailContact').val();
//    var message = $('#messageContact').val();
//    var data = {name: name, email:email, message: message};
    var url = templateRoot+'src/app/ajaxReceivers/sendContactEmail.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: $("#contactForm").serialize(),
        success: function (serverResponse) {
            alertify.alert('Messagem Enviada, Obrigado pelo seu contato');
            resetMyForm($('#contactForm'));
            $('#sendEmailContact').button('reset');
            alertify.alert(serverResponse);
        },
        error: function (serverResponse) {
            alertify.alert('Ocorreu um erro no processamento da sua mensagem, por favor tente mais tarde');
        }
    });
}

function resetMyForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
});