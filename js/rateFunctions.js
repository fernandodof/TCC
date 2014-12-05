var templateRoot;

function saveRating() {
    var nota = $('#rateInputUser').val();
    var idRestaurante = $('#idRestaurante').val();
    var data = {nota: nota, idRestaurante: idRestaurante};

    var url = templateRoot + 'src/app/ajaxReceivers/saveRating.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
//            $('body').html(serverResponse);
            alertify.log('Avaliação recebida');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
            alert(textStatus);
            alert(jqXHR);
        }
    });
}


function sendComment() {
    var comment = $('#commentBox').val();
    
    if (comment === '') {
        return;
    }

    $('#send').button('loading');
    var idRestaurante = $('#idRestaurante').val();
    var data = {comment: comment, idRestaurante: idRestaurante};

    var url = templateRoot + 'src/app/ajaxReceivers/saveComment.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#commentBox').next().html('300');
            $('#commentBox').val('');
            alertify.alert("Comentário recebido");
            $('#send').button('reset');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
            alert(textStatus);
            alert(jqXHR);
        }
    });

}

function initIputs() {
    $("#rateInput").rating({
        starCaptions: function (val) {
            if (val === 0) {
                return 'Sem Avaliação';
            } else if (val > 0.1 && val < 1) {
                return val;
            } else if (val === 1) {
                return  val;
            }
            else {
                return val;
            }
        },
        clearCaption: '',
        size: 'xs',
        disabled: true
    });
}

function  setCommentBox() {
    $('#commentBox').stopVerbosity({
        limit: 300,
        indicatorPhrase: ['[countdown]'],
    });
}

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();

    $("#rateInputUser").rating({
        starCaptions: function (val) {
            if (val === 0) {
                return 'Sem Avaliação';
            } else if (val > 0.1 && val < 1) {
                return val;
            } else if (val === 1) {
                return  val;
            }
            else {
                return val;
            }
        },
        clearCaption: '',
        size: 'md'
    });

    $('#rateInputUser').on('rating.change', function (event, value, caption) {
        saveRating();
    });

    initIputs();

    setCommentBox();
});