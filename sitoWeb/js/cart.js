$(document).ready(function() {
    const articleLocation = $("section.articoli article.tile");
    let cartValue = 0.00;
    let quantity = 0;
    let price = 0;

    $(document).on("click touchend", ".quantityInput", calculateCartValue);
    window.onload = calculateCartValue();

    function updateCart(){
        $("p#cartValue").text(cartValue.toFixed(2) + " €");
    }

    function calculateCartValue(){
        cartValue = 0;
        articleLocation.each(function(){
            quantity = $(this).find("input").val();
            price = $(this).find("p.tileImportantInfo").html();
            price = price.replace("€", "");
            cartValue = cartValue + (quantity * parseFloat(price));
        });

        console.log(cartValue);
        updateCart();

        return;
    }

});
