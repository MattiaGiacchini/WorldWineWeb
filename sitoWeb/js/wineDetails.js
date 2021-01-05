$(document).ready(function(){
    
    const time = 1000;
    const buttons = $("div.details button");
    const nextElement = buttons.next();
    let element;
    let vote;
    let img;

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

    $("article img[alt^=\"voto:\"]").each(function(){
        vote = $(this).attr("alt")
        vote = vote.slice(5, vote.length-4);
        vote = parseFloat(vote);
        vote = vote / 5.0 * 100;
        $(this).css("background", "linear-gradient(to right, #B9653D " + vote + "%, #C4C4C4 " + vote + "%)");
    });

    buttons.next().hide();

});
