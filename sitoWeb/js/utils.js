$(document).ready(function(){
    const nav = $("body > nav");
    const warehouseLoad = $("article.tile.magazzino > p");
    let warehouseLoadingValue;

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

    warehouseLoad.each(function(){
        warehouseLoadingValue = Number($(this).html());
        console.log(warehouseLoadingValue);
        if(warehouseLoadingValue > 0){
            $(this).css("color", "#4CAF50");
        } else {
            $(this).css("color", "#F44336");
        }
    });
});
