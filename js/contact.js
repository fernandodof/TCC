function sendContactMessage() {
    $('#confirmar').button('loading');
    $('body').dimBackground();
    $("body").find("input,button,textarea").attr("disabled", "disabled");
    var obs = $('#observacoes').val();
    var data = {obs: obs};
    var url = templateRoot+'src/app/ajaxReceivers/submitOrder.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === 'Erro') {
                alertify.alert("Ocorreu um erro ao fazer o seu pedido");
            } else {
                $('#orderInfo').addClass('animated bounceOutRight');
                setTimeout(function () {
                    $('#orderInfo').remove();
                }, 1300);
                $('body').undim();
                $("body").find("input,button,textarea").removeAttr("disabled");
                $('#confirmation').html("<h2>Pedido realizado com sucesso</h2>" +
                        "<div id='faces'>" +
                        "<img id = 'imgFace' src = '"+templateRoot+"images/icons/svg/happyFace.svg'/>" +
                        "</div>");
                $('#confirmation').show();
                $('#liGotoCart').empty();
            }
        },
        error: function (data) {
            alertify.alert("Ocorreu um erro ao fazer o seu pedido");
        }
    });
}