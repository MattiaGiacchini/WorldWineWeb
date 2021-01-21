$(document).ready(function(){
    // TODO:
    $("form.warehouseStock > input[type = submit]").on("click", insertCurrentDateTime());

    function insertCurrentDateTime(){
        const today = new Date();
        const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        const time = today.getHours() + ":" + today.getMinutes();
        const dateTime = date+' '+time;

        $("#currentdate").val(today.toUTCString());
        //// TODO:
    }


});
