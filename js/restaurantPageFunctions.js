function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(-6.887496, -38.560768),
        zoom: 15
    };
    var map = new google.maps.Map(document.getElementById("map"),
            mapOptions);

    var map2 = new google.maps.Map(document.getElementById("map2"),
            mapOptions);
}

function initMap() {
    var latitude = $('#latitude').val();
    var longitude = $('#longitude').val();
    var nomeRestaurante = $('#nomeRestauranteMap').val();
    var myLatlng = new google.maps.LatLng(Number(latitude), Number(longitude));
    var mapOptions = {
        zoom: 16,
        center: myLatlng
    };
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // To add the marker to the map, use the 'map' property
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: nomeRestaurante
    });
}

function addProduto(idForm, orderAction) {
    var form = document.getElementById(idForm);
    var idProduto1 = form.getElementsByClassName('idProduto')[0].value;
    var idTamanho1 = form.getElementsByClassName('idTamanho')[0].value;
    var quantidade1 = form.getElementsByClassName('quantidade')[0].value;
    var idRestaurantePedido1 = $('#idRestaurantePedidoInicial').val();

    var data = {idProduto: idProduto1, idTamanho: idTamanho1, quantidade: quantidade1, idRestaurantePedido: idRestaurantePedido1, orderAction: orderAction};
    var url = '../src/app/ajaxReceivers/addToCart.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === 'Erro') {
                alertify.alert("Por favor faça o login para poder realizar o pedido");
                undimPageAndEnableComponents();
            }
            else {
                $('#pedidoDropdown').html(serverResponse);
                undimPageAndEnableComponents();
                alertify.success('Novo Item Adicionado');
            }
        },
        error: function (data) {
            alert("Erro ");
        }
    });
}

function resetAlertify() {
    alertify.set({
        labels: {
            ok: "Sim",
            cancel: "Não"
        },
        delay: 5000,
        buttonReverse: false,
        buttonFocus: "ok"
    });
}

function checkCurrentOrder(idForm) {
    $('body').dimBackground();
    $('#loader').show();
    $("body").find("input,button,textarea").attr("disabled", "disabled");

    var idRestaurante = $('#idRestaurantePedidoInicial').val();

    var data = {idRestaurantePedido: idRestaurante};
    var url = '../src/app/ajaxReceivers/checkCurrentOrder.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === 'login') {
                alertify.alert("Por favor faça o login para poder realizar o pedido");
                undimPageAndEnableComponents();
            }
            else if (serverResponse === 'currentOrder') {

                resetAlertify();

                alertify.confirm("Você já tem uma compra em andamento com outro estabelecimento " +
                        "se você continuar, essa compra será cancelada. Deseja continuar?", function (e) {
                            if (e) {
                                addProduto(idForm, 1);
                                alertify.success('Pedido redefinido');
                            } else {
                                alertify.log('Pedido não alterado');
                            }
                        });
                undimPageAndEnableComponents();
            } else if (serverResponse === 'noCurrentOrder') {
                addProduto(idForm, 0);
            }
        },
        error: function (data) {
            alert("Erro");
        }
    });
}

function showConfirmDialog() {
    resetAlertify();
    var ret;
    alertify.confirm("Você já tem uma compra em andamento com outro estabelecimento " +
            "se você continuar, essa compra será cancelada. Deseja continuar?", function (e) {
                if (e) {
                    ret = true;

                } else {
                    ret = false;
                }
            });

}

function undimPageAndEnableComponents() {
    $('#loader').hide();
    $('body').undim();
    $("body").find("input,button,textarea").removeAttr("disabled");
}