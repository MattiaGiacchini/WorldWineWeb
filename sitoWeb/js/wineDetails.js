$(document).ready(function(){
    /*let img = $("body > main > div.article-container > article.wineCard > div > div > img");
    let i = 30;

    img.each(function(){
        $(this).css("background", "linear-gradient(to right, #B9653D " + i + "%, #C4C4C4 " + i + "%)");
        i += 30;
    });*/

    const time = 1000;
    const buttons = $("div.details button");
    const nextElement = buttons.next();
    let element;

    buttons.click(function(e){
        if($(this).hasClass("selected")){  // lo nascondo
            $(this).removeClass("selected");
            $(this).next().slideUp(time);
        } else {                                // altrimenti lo mostro!
            buttons.removeClass("selected")
                   .next()
                   .slideUp(time);
            $(this).addClass("selected")
                   .next()
                   .slideDown(time);
        }
    });

    buttons.next().hide();

});
