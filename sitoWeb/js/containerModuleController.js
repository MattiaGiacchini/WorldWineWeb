let lastCheckboxValue;
let lastPriceValue;
let lastPhotoValue;

$(document).ready(function(){
    const inputForm = $("form.editProduct fieldset.modify")
                    .find("input");
    const checkbox = document.getElementById("visible");
    const price    = document.getElementById("price");
    const photo    = document.getElementById("photo");
    const submit   = $("form.editProduct input[type = submit]");

    lastCheckboxValue = checkbox.checked;
    lastPriceValue = price.value;
    lastPhotoValue = photo.value;


    function showAnotherProduct() {
        lastCheckboxValue = checkbox.checked;
        lastPriceValue = price.value;
        lastPhotoValue = photo.value;
        setOrRemoveRequired();
    }

    function setOrRemoveRequired() {
        if(checkbox.checked == true) {
            inputForm.not("[type = checkbox]").attr("required", true);
        } else {
            inputForm.not("[type = checkbox]").removeAttr("required");
        }
    }

    function checkVariation(){
        if(price.value != lastPriceValue ||
           photo.value != lastPhotoValue ||
           checkbox.checket != lastCheckboxValue) {
               submit.removeAttr("disabled");
        } else {
            submit.attr("disabled", true);
        }
    }

    checkbox.addEventListener("change", setOrRemoveRequired);
    document.getElementById("id")
            .addEventListener("change", showAnotherProduct);

    inputForm.change(checkVariation);
    checkVariation();
});
