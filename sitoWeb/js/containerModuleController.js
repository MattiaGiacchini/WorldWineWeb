$(document).ready(function(){
    const inputForm = $("form.editProduct fieldset.modify")
                    .find("input");
    const checkbox = document.getElementById("visible");
    const price    = document.getElementById("price");
    const photo    = document.getElementById("photo");
    const submit   = $("form.editProduct input[type = submit]");

    let lastCheckboxValue = checkbox.checked;
    let lastPriceValue    = price.value;
    let lastPhotoValue    = photo.value;

    function upLoadNewData() {

    }

    function showAnotherProduct() {
        upLoadNewData();
        lastCheckboxValue = checkbox.checked;
        lastPriceValue = price.value;
        lastPhotoValue = photo.value;
        setOrRemoveRequired();
        checkVariation();
    }

    function setOrRemoveRequired() {
        if(checkbox.checked == true) {
            inputForm.not("[type = checkbox]").attr("required", true);
        } else {
            inputForm.not("[type = checkbox]").removeAttr("required");
        }
    }

    function checkVariation(){
        console.clear();
        console.log("check " + (lastCheckboxValue === checkbox.checked));
        console.log("photo " + (lastPhotoValue === photo.value));
        console.log("price " + (lastPriceValue === price.value));
        if(price.value == lastPriceValue &&
           photo.value == lastPhotoValue &&
           checkbox.checked == lastCheckboxValue) {
            submit.attr("disabled", true);
        } else {
            submit.removeAttr("disabled");
        }
    }

    checkbox.addEventListener("change", setOrRemoveRequired);
    document.getElementById("id").addEventListener("change", showAnotherProduct);
    inputForm.change(checkVariation);

    window.onload = showAnotherProduct();
});
