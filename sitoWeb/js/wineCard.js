$(document).ready(function(){
    let vote;
    $("article.wineCard img[alt^=\"voto:\"], article.review img[alt^=\"voto:\"]").each(function(){
        vote = $(this).attr("alt")
        vote = vote.slice(5, vote.length-4);
        vote = parseFloat(vote);
        vote = vote / 5.0 * 100;
        $(this).css("background", "linear-gradient(to right, #B9653D " + vote + "%, #C4C4C4 " + vote + "%)");
    });

    $("article.wineCard > button.preference").click(function () {
         const info = $(this).attr('id').split("-");
         const elem = $(this);
         $.ajax({
             type: "POST",
             url: "updateFavorite.php",              //Your required php page
             data: "idLabel=" + info[0]+"&idContainer="+info[1]+"&idClient="+info[2],            //pass your required data here
             success: function (response) {     //You obtain the response that you echo from your controller
                 if(response == "favourite") {
                     elem.removeClass("not-favourite");
                     elem.addClass("favourite");
                 } else {
                     elem.removeClass("favourite");
                     elem.addClass("not-favourite");
                 }
             },
             error: function () {
                 console.log("Errore nel caricamento dei preferiti");
             }
         });
     });
});
