$(document).ready(function(){
    const wineElement = $("form.newWineLabel .vino");
    const spumElement = $("form.newWineLabel .spumante");

    document.getElementById("vino").setAttribute("checked", "");
    wineElement.show();
    spumElement.hide();
    $("form.newWineLabel > ul > li > fieldset >input[name = categoria]").click(function(){
        if(document.forms["newWineLabel"]["categoria"].value == "vino"){
            spumElement.hide();
            spumElement.attr("disabled");
            wineElement.show();
            wineElement.removeAttr("disabled");
        } else {
            wineElement.hide();
            wineElement.attr("disabled");
            spumElement.show();
            spumElement.removeAttr("disabled");
        }
        document.forms["newWineLabel"]["zucchero"].value = "";
    });

});
