var templateRoot;

function removeProduct(indexProduto) {
    $('body').dimBackground();
    $('#loader').show();
    $('#sumitingOrderDiv').show();
    $("body").find("input,button,textarea").attr("disabled", "disabled");
    var data = {indexProduto: indexProduto, command: "remove"};
    var url = templateRoot + 'src/app/ajaxReceivers/changeOrder.php';
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
                $('#orderInfo').remove();
                $('#confirmation').html("<h2>Sua Bandeja Está Vazia</h2>" +
                        "<div id='faces'>" +
                        "<img id = 'imgFace' src = '" + templateRoot + "images/icons/svg/sadFace.svg'/>" +
                        "</div>");
                $('#confirmation').show();
            }
            else {
                createCartCount($('#idRestaurante').val());
            }
            $('body').undim();
            $("body").find("input,button,textarea").removeAttr("disabled");
            $('#sumitingOrderDiv').hide();
            $('#cart').html(serverResponse);
        },
        error: function (data) {
            alert(data);
            alert("Ocorreu um erro com a sua solicitação");
        }
    });
}

function createCartCount(idRestaurante) {
    var itemCount = getItemCount();
    $('#liGotoCart').html(
            "<form method='post' action='" + templateRoot + "pages/confirmOrder' id='goToCart'>" +
            "<button class='btn' type='submit'><img src='" + templateRoot + "images/icons/cartIcon2.png' title='Pedido' alt='Pedido'>" +
            "<span class='badge' id='badgePedido'>" + itemCount + "</span></button>" +
            "<input type='hidden' name='idRestaurantePedido' id='" + idRestaurante + "'" +
            "value='" + idRestaurante + "'>" +
            "</form>"
            );
}


function updateQuantity(indexProduto) {
    $('body').dimBackground();
    $('#sumitingOrderDiv').show();
    $("body").find("input,button,textarea").attr("disabled", "disabled");
    var quantidade = $('#quantidade' + indexProduto).val();
    var data = {indexProduto: indexProduto, quantidade: quantidade, command: "update"};
    var url = templateRoot + 'src/app/ajaxReceivers/changeOrder.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === 'Erro') {
                $('#sumitingOrderDiv').hide();
                alert('Ocorreu um erro com a sua solicitação');
                $('body').undim();
                $("body").find("input,button,textarea").removeAttr("disabled");
            }
            else {
                $('body').undim();
                $("body").find("input,button,textarea").removeAttr("disabled");
                $('#sumitingOrderDiv').hide();
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
    $('#sumitingOrderDiv').show();
    $('body').dimBackground();
    $("body").find("input,button,textarea").attr("disabled", "disabled");
    var obs = $('#observacoes').val();
    var data = {obs: obs};
    var url = templateRoot + 'src/app/ajaxReceivers/submitOrder.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === 'Erro') {
                $('#sumitingOrderDiv').hide();
                alertify.alert("Ocorreu um erro ao fazer o seu pedido");
            } else {
                $('#orderInfo').addClass('animated bounceOutRight');
                setTimeout(function () {
                    $('#orderInfo').remove();
                }, 1300);
                $('body').undim();
                $("body").find("input,button,textarea").removeAttr("disabled");
                $('#confirmation').show();
                $('#sumitingOrderDiv').hide();
                $('#confirmation').show();
                $('#liGotoCart').empty();
//                alertify.alert('TESTE');
//                alertify.alert(serverResponse);
            }
        },
        error: function (data) {
            alertify.alert("Ocorreu um erro ao fazer o seu pedido");
        }
    });
}

function getItemCount() {
    var url = templateRoot + 'src/app/ajaxReceivers/itemCount.php';
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


$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
});