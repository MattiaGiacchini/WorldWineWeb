$(document).ready(function(){
    const nav = $("body > nav");
    const warehouseLoad = $("article.tile.magazzino > p");
    let warehouseLoadingValue;
    let windowWidth = window.innerWidth;
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    if (windowWidth < 1200) {
        nav.hide();
    }
    $(".filter").hide();

    $("body > header > button").click(function(){
        nav.slideToggle();
    });

    $("#filterDropdown").click(function(){
        $(".filter").slideToggle();
    });

    $("#applyFilters").click(function(event){
        $(".filter").slideToggle();
    });

    $("#addNewColaborator").click(function(){
        location.href = "./addNewCollaborator.php";
    });


    $("#addNewLabel").click(function(){
        window.location='newWineLabel.php';
    });

    warehouseLoad.each(function(){
        warehouseLoadingValue = Number($(this).html());
        if(warehouseLoadingValue > 0){
            $(this).css("color", "#4CAF50");
        } else {
            $(this).css("color", "#F44336");
        }
    });
});
