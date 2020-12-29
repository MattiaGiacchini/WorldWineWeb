$(document).ready(function(){
    let img = $("body > main > div.article-container > article.wineCard > div > div > img");
    let i = 30;

    //img.css("background", "linear-gradient(to right, #B9653D 50%, #C4C4C4 50%)");
    //img.css("background", "linear-gradient(to right, #B9653D " + 10 + "%, #C4C4C4 " + 10 + "%)");
    img.each(function(){
        $(this).css("background", "linear-gradient(to right, #B9653D " + i + "%, #C4C4C4 " + i + "%)");
        i += 30;
    });

});
