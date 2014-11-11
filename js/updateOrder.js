function removeProduct(indexProduto) {
    $('body').dimBackground();
    $('#loader').show();
    $("body").find("input,button,textarea").attr("disabled", "disabled");

    var data = {indexProduto: indexProduto, command: "remove"};
    var url = '../src/app/ajaxReceivers/changeOrder.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === 'Erro') {
                $('#loader').hide();
                alert('Ocorreu um erro com a sua solicitação');
                $('body').undim();
                $("body").find("input,button,textarea").removeAttr("disabled");
            }
            else {
                $('body').undim();
                $("body").find("input,button,textarea").removeAttr("disabled");
                $('#loader').hide();
                $('#cart').html(serverResponse);
            }
        },
        error: function (data) {
            alert("Ocorreu um erro com a sua solicitação");
        }
    });
}

function updateQuantity(indexProduto) {
    $('body').dimBackground();
    $('#loader').show();
    $("body").find("input,button,textarea").attr("disabled", "disabled");

    var quantidade = $('#quantidade' + indexProduto).val();
    var data = {indexProduto: indexProduto, quantidade: quantidade, command: "update"};
    var url = '../src/app/ajaxReceivers/changeOrder.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === 'Erro') {
                $('#loader').hide();
                alert('Ocorreu um erro com a sua solicitação');
                $('body').undim();
                $("body").find("input,button,textarea").removeAttr("disabled");
            }
            else {
                $('body').undim();
                $("body").find("input,button,textarea").removeAttr("disabled");
                $('#loader').hide();
                $('#cart').html(serverResponse);
            }
        },
        error: function (data) {
            alert("Ocorreu um erro com a sua solicitação");
        }
    });
}

function checkout() {
    $('#cart').addClass('animated bounceOutRight');

    setTimeout(function () {
        $('#cart').remove();
    }, 1800);
    setTimeout(
            function () {
                $('#confirmation').html('<h2>Pedido realizado com sucesso</h2>');
                $('#confirmation').show();
            },
            2000);
}      