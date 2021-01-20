function showAndHide(elements, show) {
    if(show) {
        elements.find("*").removeAttr("disabled");
        elements.show();
    } else {
        elements.find("*").attr("disabled", true);
        elements.hide();
    }
}

function lockUnlock(elements, lock) {
    if(lock) {
        elements.find("*").removeAttr("disabled");
    } else {
        elements.find("*").attr("disabled", true);
    }
}

function slideUpAndDown(elements, down) {
    if(down) {
        elements.find("*").removeAttr("disabled");
        elements.slideDown();
    } else {
        elements.slideUp();
        elements.find("*").attr("disabled", true);
    }
}

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
    // recupero delle informazioni passate attraverso cookie dal server
    // successiva eliminazione del cookie dopo la lettura
    const products = JSON.parse(getCookie("label"));
    document.cookie =  "label=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";


    const inputFormUpdate   = $("form.editProduct fieldset.modify").find("input");
    const id                = document.getElementById("id");
    const checkbox          = document.getElementById("visible");
    const price             = document.getElementById("price");
    const photo             = document.getElementById("photo");
    const newPhoto          = document.getElementById("newPhoto");
    const iva               = document.getElementById("iva");

    const submit            = $("form.editProduct input[type = submit]");
    const update            = $("form.editProduct .update");
    const newIdContainer    = $("form.editProduct .newContainer");

    const lastCheckbox      = document.getElementById("lastVisible");
    const lastPrice         = document.getElementById("lastPrice");
    const lastIva           = document.getElementById("lastIva");
    const lastPhoto         = document.getElementById("lastPhoto");

    const defaultImg      = photo.src;
    const defaultAlt      = photo.alt;

    let index;

    showAndHide(newIdContainer, false);
    lockUnlock(update, false);

    function showAnotherProduct() {
        if(id.value == "") {
            lockUnlock(update, false);
            slideUpAndDown(newIdContainer, false);
            checkbox.checked = false;
            iva.value   = "";
            price.value = "";
            photo.src   = defaultImg;
            photo.alt   = defaultAlt;
            submit.val("");

        } else if(id.value == "new"){
            lockUnlock(update, true);
            slideUpAndDown(newIdContainer, true);
            checkbox.checked = false;
            iva.value   = "";
            price.value = "";
            photo.src   = defaultImg;
            photo.alt   = defaultAlt;
            submit.val("abbina nuovo");

            if(checkbox.checked) {
                lastCheckbox.value = "true";
            } else {
                lastCheckbox.value = "false";
            }
            lastPrice.value         = price.value;
            lastPhoto.value         = newPhoto.value;
            lastIva.value           = iva.value;

        } else {
            lockUnlock(update, true);
            slideUpAndDown(newIdContainer, false);
            index = id.value-1;
            checkbox.checked = products[index]["attivo"] == 1;
            iva.value   = products[index]["iva"];
            price.value = products[index]["prezzo"];
            photo.src   = products[index]["photo"];
            photo.alt   = products[index]["photo"].includes("default") ? defaultAlt : products[index]["photo"];

            submit.val("aggiorna");

            if(products[index]["attivo"] == 1) {
                lastCheckbox.value = "true";
            } else {
                lastCheckbox.value = "false";
            }

            lastPrice.value         = products[index]["prezzo"];
            lastPhoto.value         = newPhoto.value;
            lastIva.value           = products[index]["iva"];
            setOrRemoveRequired();
            checkVariation();
        }
    }


    function setOrRemoveRequired() {
        if(checkbox.checked == true) {
            inputFormUpdate.not("[type = checkbox]").not("[type = file]").attr("required", true);
        } else {
            inputFormUpdate.not("[type = checkbox]").not("[type = file]").removeAttr("required");
        }
    }

    function checkVariation(){
        let check = checkbox.checked ? "true" : "false";
        if(price.value      == lastPrice.value
        && iva.value        == lastIva.value
        && newPhoto.value   == lastPhoto.value
        && check == lastCheckbox.value ) {
            submit.attr("disabled", true);
        } else {
            console.log("lo riabilito");
            submit.removeAttr("disabled");
        }
    }

    checkbox.addEventListener("change", setOrRemoveRequired);
    document.getElementById("id").addEventListener("change", showAnotherProduct);

    inputFormUpdate.keydown(checkVariation);
    inputFormUpdate.change(checkVariation);
    id.value = "";

    window.onload = showAnotherProduct();
});
