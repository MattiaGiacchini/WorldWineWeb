$(document).ready(function(){

    const time = 500;
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
