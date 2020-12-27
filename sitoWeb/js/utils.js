$(document).ready(function(){
    const nav = $("body > nav");
    nav.hide();

    $("body > header > p").click(function(){
       nav.slideToggle();
    });
});
