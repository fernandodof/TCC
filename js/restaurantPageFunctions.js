var map;
var templateRoot;
function initMap() {
    var latitude = $('#latitude').val();
    var longitude = $('#longitude').val();
    var nomeRestaurante = $('#nomeRestauranteMap').val();
    var myLatlng = new google.maps.LatLng(Number(latitude), Number(longitude));
    var mapOptions = {
        zoom: 16,
        center: myLatlng
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: nomeRestaurante
    });

}

google.maps.event.addDomListener(window, 'load', initMap);
google.maps.event.addDomListener(window, "resize", function () {
    $('#map').width($('#bigMap-modal-body').width() - 25).height($('#bigMap-modal-body').height());
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
});

function expandMap() {
    $('#bigMap').show();
    $('#map').width($('#bigMap-modal-body').width() - 25).height($('#bigMap-modal-body').height());
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
    $('#map2').empty();
    $('#map').appendTo('#map2');
}

function closeMap() {
    $('#bigMap').hide();
    $('#map').width('200px').height('200px');
    $('#location').html("<div id='map'></div>");
//    var center = map.getCenter();
//    google.maps.event.trigger(map, "resize");
//    map.setCenter(center);
    initMap();
}

function addProduto(idForm, orderAction) {
    var form = document.getElementById('add'+idForm);
    var idProduto1 = form.getElementsByClassName('idProduto')[0].value;
    var idTamanho1 = form.getElementsByClassName('idTamanho')[0].value;
    var quantidade1 = form.getElementsByClassName('quantidade')[0].value;
    var idRestaurantePedido1 = $('#idRestaurantePedidoInicial').val();
    var data = {idProduto: idProduto1, idTamanho: idTamanho1, quantidade: quantidade1, idRestaurantePedido: idRestaurantePedido1, orderAction: orderAction};
    var url = templateRoot+'src/app/ajaxReceivers/addToCart.php';
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
                createCartCount(idRestaurantePedido1);
            }
        },
        error: function (data) {
            alert("Erro ");
        }
    });
}

function createCartCount(idRestaurante) {
    $('#liGotoCart').empty();
    $('#liGotoCart').html(
            "<form method='post' action='"+templateRoot+"pages/confirmOrder.php' id='goToCart'>" +
            "<button class='btn' type='submit'><img src='"+templateRoot+"images/icons/cartIcon2.png' title='Pedido' alt='Pedido'>" +
            "<span class='badge' id='badgePedido'>" + getItemCount() + "</span></button>" +
            "<input type='hidden' name='idRestaurantePedido' id='" + idRestaurante + "'" +
            "value='1'>" +
            "</form>"
            );
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
    var url = templateRoot+'src/app/ajaxReceivers/checkCurrentOrder.php';
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

function getItemCount() {
    var url = templateRoot+'src/app/ajaxReceivers/itemCount.php';
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


$(document).ready(function (){
   templateRoot = $('#templateRoot').val();
    alert(templateRoot);
});