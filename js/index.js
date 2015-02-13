function highlightItem(divId){
    $('#prod'+divId).toggleClass('highlightedItem');
    $('#btProd'+divId).toggleClass('highlightedItem');
    
}

$(document).ready(function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//        var currentTab = $(e.target).text(); // get current tab
//        var LastTab = $(e.relatedTarget).text(); // get last tab
//        $(".current-tab span").html(currentTab); 
//        $(".last-tab span").html(LastTab);

        if ($(e.target).text() === 'Pratos') {
            $('.jumbotron').addClass('secondTabActice');
            if ($(window).width() < 991) {
                $('#jumbotronContent').height(278);
            }
        } else {
            $('.jumbotron').removeClass('secondTabActice');
            if ($(window).width() < 991) {
                $('#jumbotronContent').height(350);
            }
        }
    });

    
});

