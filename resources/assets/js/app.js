require('./bootstrap');

$(document).ready(function() {
    setTimeout(structure, 300);
});

$(window).resize(function() {
    structure();
});

function structure()
{
    var navHeight = $('.navbar').height();
    $('body').css("margin-top", navHeight+"px");
    $('.side-nav').css("top", navHeight+"px");
}