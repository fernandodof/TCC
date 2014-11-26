jQuery(document).ready(function () {
    $("#rateInput").rating({
        starCaptions: function (val) {
            if (val === 0) {
                return 'Sem Avaliação';
            }else if (val > 0.1 && val < 1){
                return val;
            }else if(val === 1){
                return  val;
            } 
            else {
                return val;
            }
        },
        clearCaption: ''
    });

});