$(document).ready(function() {
    const private = $("form > ul > li.private");
    const business = $("form > ul > li.business");


    function(item)

    function selectType(type){

    }


    $("form > ul > li > input[type = radio]").click(selectType($(this)){
        switch ($(this).attr("id")) {
            case "private":
                business.hide();
                private.show();
                break;
            case "business":
                business.show();
                private.hide();
                break;
            default:
                console.log("wrong attribute");
        }

    });
});
