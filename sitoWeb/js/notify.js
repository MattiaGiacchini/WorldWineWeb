$(document).ready(function(){

    const notify = $("body > nav > ul > li.notification > a > span.notificationBadge");

    function updateNotifications(){
        $.ajax({
            type: "POST",
            url: "./getNotify.php",
            success: function (response) {
                if(response == 0) {
                    notify.hide();
                } else {
                    notify.show();
                    notify.text(response);
                }
            },
            error: function () {
                console.log("Errore nel caricamento delle notifiche");
            }
        });
    }

    window.setInterval(updateNotifications, 1000);
    updateNotifications();
});
