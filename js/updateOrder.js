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
                alertify.log(serverResponse);
            } else if (serverResponse === 'Sua Bandeja Está Vazia') {
                $("#liGotoCart").empty();
            }
            else {
                createCartCount($('#idRestaurante').val());
            }
            $('body').undim();
            $("body").find("input,button,textarea").removeAttr("disabled");
            $('#loader').hide();
            $('#cart').html(serverResponse);

        },
        error: function (data) {
            alert("Ocorreu um erro com a sua solicitação");
        }
    });
}

function createCartCount(idRestaurante) {
    var itemCount = getItemCount();
    $('#liGotoCart').html(
            "<form method='post' action='../pages/confirmOrder.php' id='goToCart'>" +
            "<button class='btn' type='submit'><img src='../images/icons/cartIcon.png' title='Pedido' alt='Pedido'>" +
            "<span class='badge' id='badgePedido'>" + itemCount + "</span></button>" +
            "<input type='hidden' name='idRestaurantePedido' id='" + idRestaurante + "'" +
            "value='1'>" +
            "</form>"
            );
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
    $('#confirmar').button('loading');
    $('body').dimBackground();
    $("body").find("input,button,textarea").attr("disabled", "disabled");
    var obs = $('#observacoes').val();

    var data = {obs: obs};
    var url = '../src/app/ajaxReceivers/submitOrder.php';
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
                $('#confirmation').html('<h2>Pedido realizado com sucesso</h2>');
                $('#confirmation').show();
            }
        },
        error: function (data) {
            alertify.alert("Ocorreu um erro ao fazer o seu pedido");
        }
    });
}

function getItemCount() {
    var url = '../src/app/ajaxReceivers/itemCount.php';
    var count;
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        success: function (serverResponse) {
            count = serverResponse;
        },
        error: function (data) {
            alert("Erro");
        }
    });
    return count;
}