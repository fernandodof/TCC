function filterRestaurante(str, liId, raio) {
    $('#circleLoader').show();

    if (liId !== null) {
        $('.liFilterType').removeClass('active');
        $('#' + liId).addClass('active');
    }

    if (str !== null) {
        var absoluteUrl = getAbsoluteUrl();
        var parameters = $.query.set("kindOfFood", str);
        parameters = parameters.toString().replace("%2B", "+");

        window.history.pushState(data, "Title", absoluteUrl + parameters);
    } else {
        alert('it is null');
        var kind = getUrlParameter('kindOfFood');
        alert('kind ' + kind);
        if (!(kind === undefined || kind === null)) {
            alert('it not undefined');
            str = kind;
            var absoluteUrl = getAbsoluteUrl();
            var parameters = $.query.set("kindOfFood", str);
            parameters = parameters.toString().replace("%2B", "+");

            var stateObj = {raio: raio, kindOfFood: str};

            window.history.pushState(stateObj, "Title", absoluteUrl + parameters);
        }
    }
    
    var location = true;
    if (raio === false) {
        location = false;
    }

    var data = {kind: str, location: location, raio: raio};
    var url = '../src/app/ajaxReceivers/filterSearch.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#circleLoader').hide();
            $('#results').html(serverResponse);
            initIputs();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR);
            alert(textStatus);
            alert(errorThrown);
        }
    });
}

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam)
        {
            return sParameterName[1];
        }
    }
}

function getAbsoluteUrl() {
    var url = document.URL;

    if (url.indexOf("?") > -1) {
        url = url.substr(0, url.indexOf("?"));
    }
    return  url;
}

function initIputs() {
    $(".rateInputs").rating({
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

$(document).ready(function () {
    initIputs();
});