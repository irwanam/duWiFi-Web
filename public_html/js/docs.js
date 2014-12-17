function headerPosition(){
    if ($(window).scrollTop() > $('header').height()) {
        $("header .navigation-bar")
            .addClass("fixed-top")
            .addClass(" shadow")
        ;
    } else {
        $("header .navigation-bar")
            .removeClass("fixed-top")
            .removeClass(" shadow")
        ;
    }
}
$(function(){
    setTimeout(function(){headerPosition();}, 100);
});

$(window).scroll(function(){
    headerPosition();
});

function regPage(){
    $("#ctn").load('register.html');
}
function loginPage(){
    $("#ctn").load('login.html');
}
function defaultPage(){
    $("#ctn").load('default.html');
}
$(document).ready(function(){
    //Smooth Scroll
    $('a[href^="#"]').on('click',function (e) {
        e.preventDefault();

        var target = this.hash;
        $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });
    //Load Default Page
    $("#ctn").load('default.html');
    //$("header").load($("header").data('load'));
});
        
METRO_AUTO_REINIT = true;