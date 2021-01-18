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

$(document).ready(function(){
    const inputForm = $("form.editProduct fieldset.modify")
                    .find("input");
    const id       = document.getElementById("id");
    const checkbox = document.getElementById("visible");
    const price    = document.getElementById("price");
    const photo    = document.getElementById("photo");
    const iva      = document.getElementById("iva");
    const submit   = $("form.editProduct input[type = submit]");
    const products = JSON.parse(getCookie("label"));
    document.cookie =  "label=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    let lastCheckboxValue = checkbox.checked;
    let lastPriceValue    = price.value;
    let lastPhotoValue    = photo.value;
    let index;


    function showAnotherProduct() {
        if(id.value != "") {
            index = id.value-1;
            checkbox.checked = products[index]["attivo"] == 1;
            iva.value = products[index]["iva"];
            price.value = products[index]["prezzo"];
        }
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
