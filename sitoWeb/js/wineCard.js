$(document).ready(function(){
    let vote;
    $("article.wineCard img[alt^=\"voto:\"]").each(function(){
        vote = $(this).attr("alt")
        vote = vote.slice(5, vote.length-4);
        vote = parseFloat(vote);
        vote = vote / 5.0 * 100;
        $(this).css("background", "linear-gradient(to right, #B9653D " + vote + "%, #C4C4C4 " + vote + "%)");
    });
});
