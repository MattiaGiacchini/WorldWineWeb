$(document).ready(function(){

    const products = JSON.parse(getCookie("checkoutData"));
    document.cookie =  "checkoutData=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    console.log(products[1]);

    $("form.checkout select[name = shippingAddress]").click(function(){
        if (document.forms["checkoutForm"]["shippingAddress"].value == "new") {
            $("ul.address li input").each(function(){
                $(this).removeAttr("readonly");
            });

            $("ul.address li select").each(function(){
                $(this).removeAttr("readonly");
            });

            $("ul.address li select#state").css('pointer-events','all');

        } else {
            $("ul.address li input").each(function(){
                $(this).attr("readonly", "readonly");
            });

            $("ul.address li select").each(function(){
                $(this).attr("readonly", "readonly");
            });

            $("ul.address li select#state").css('pointer-events','none');

            const addressId = document.forms["checkoutForm"]["shippingAddress"].value;
            products[0].forEach(element => {
                if(element["idIndirizzo"] == addressId) {
                    document.getElementById("name").value = element["nome"];
                    document.getElementById("adr").value = element["via"];
                    document.getElementById("civic").value = element["civico"];
                    document.getElementById("city").value = element["citta"];
                    document.getElementById("province").value = element["provincia"];
                    document.getElementById("zip").value = element["cap"];
                    document.getElementById("state").value = element["stato"];
                }
            });
        }
    })

    $("form.checkout select[name = payment]").click(function(){
        if (document.forms["checkoutForm"]["payment"].value == "new") {
            $("ul.payment li input").each(function(){
                $(this).removeAttr("readonly");
            });

            $("ul.payment li select").each(function(){
                $(this).removeAttr("readonly");
            });

            $("ul.payment li select#cardTipology").css('pointer-events','all');

        } else {
            $("ul.payment li input").each(function(){
                $(this).attr("readonly", "readonly");
            });

            $("ul.payment li select").each(function(){
                $(this).attr("readonly", "readonly");
            });

            $("ul.payment li select#cardTipology").css('pointer-events','none');

            const paymentId = document.forms["checkoutForm"]["payment"].value;
            products[1].forEach(element => {
                if(element["numeroCarta"] == paymentId) {
                    document.getElementById("cardname").value = element["intestatario"];
                    document.getElementById("cardTipology").value = element["tipologiaCarta"];
                    document.getElementById("cardnumber").value = element["numeroCarta"];
                    document.getElementById("expiration").value = element["scadenza"].slice(0,7);
                    document.getElementById("cvv").value = element["cvv"];
                }
            });
        }
    })

    function getCookie(cookieName) {
        let cookie = cookieName + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        let found = false;
        let c;
        for(let i = 0; i <ca.length; i++) {
            c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }

        if (c.indexOf(cookie) == 0) {
          found = true;
        }
    }
        if(found) {
            return c.substring(cookie.length, c.length);
        }

        return "";
    }





});
