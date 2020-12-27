$(document).ready(function(){
    const nav = $("body > nav");
    nav.hide();
    $(".filter").hide();

    $("body > header > button").click(function(){
        nav.slideToggle();
    });

    $("#filterDropdown").click(function(){
        $(".filter").slideToggle();
    });

    $("#applyFilters").click(function(event){
        event.preventDefault();
        $(".filter").slideToggle();
    });
});
