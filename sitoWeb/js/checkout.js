$(document).ready(function(){

    $("form.checkout select[name = shippingAddress]").click(function(){
        if (document.forms["checkoutForm"]["shippingAddress"].value == "new") {
            $("ul.address li input").each(function(){
                $(this).removeAttr("readonly");
            });

            $("ul.address li select#state.stato").css('pointer-events','all');

        } else {
            $("ul.address li input").each(function(){
                $(this).attr("readonly", "readonly");
            });

            $("ul.address li select#state.stato").css('pointer-events','none');
        }
    })

    $("form.checkout select[name = payment]").click(function(){
        if (document.forms["checkoutForm"]["payment"].value == "new") {
            $("ul.payment li input").each(function(){
                $(this).removeAttr("readonly");
            });

            $("ul.payment li select#cardTipology").css('pointer-events','all');

        } else {
            $("ul.payment li input").each(function(){
                $(this).attr("readonly", "readonly");
            });

            $("ul.payment li select#cardTipology").css('pointer-events','none');

        }
    })


});
