require('./bootstrap');

$(document).ready(function(){
    $('#filters select').last().on('loaded.bs.select', function () {
        structure();
    });
});

$(window).resize(function() {
    if ($('#filter-navbar-collapse').attr('aria-expanded') === "false") {
        structure();
    }
});

function structure()
{
    var navHeight = $('.navbar').height();
    $('body').css("margin-top", navHeight+"px");
    $('.side-nav').css("top", navHeight+"px");
}