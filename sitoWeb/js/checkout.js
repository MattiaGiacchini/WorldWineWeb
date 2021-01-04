$(document).ready(function(){

    $("form.checkout select[name = shippingAddress]").click(function(){
        if (document.forms["checkoutForm"]["shippingAddress"].value == "new") {
            $("ul.address li input").each(function(){
                $(this).removeAttr("readonly");
            });
        } else {
            $("ul.address li input").each(function(){
                $(this).attr("readonly", "readonly");
            });
        }
    })

    $("form.checkout select[name = payment]").click(function(){
        if (document.forms["checkoutForm"]["payment"].value == "new") {
            $("ul.payment li input").each(function(){
                $(this).removeAttr("readonly");
            });
        } else {
            $("ul.payment li input").each(function(){
                $(this).attr("readonly", "readonly");
            });
        }
    })


});
