$(document).ready(function(){
    $(".mainContent.notice div.tileContent button").click(function () {
        const info = $(this).attr('id');
        const elem = $(this);
        $.ajax({
            type: "POST",
            url: "./update-notifications.php", //Your required php page
            data: "idNotifica=" + info, //pass your required data here
            success: function (response) { //You obtain the response that you echo from your controller
                console.log(response);
                location.reload();
            },
            error: function () {
                console.log("Errore nel caricamento delle notifiche");
            }
        });
    });
});
