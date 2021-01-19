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

function slideUpAndDown(elements, up) {
    if(up) {
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


    const formNewProd       = $("form.addNewProduct");
    const inputFormUpdate   = $("form.editProduct fieldset.modify").find("input");
    const id                = document.getElementById("id");
    const checkbox          = document.getElementById("visible");
    const price             = document.getElementById("price");
    const photo             = document.getElementById("photo");
    const newPhoto          = document.getElementById("newPhoto");
    const iva               = document.getElementById("iva");
    const submit            = $("form.editProduct input[type = submit]");
    const update            = $("form.editProduct .update");


    const defaultImg      = photo.src;
    const defaultAlt      = photo.alt;
    let lastCheckboxValue = checkbox.checked;
    let lastPriceValue    = price.value;
    let lastNewPhotoValue = photo.value;
    let phaseFormNewProd  = false;
    let index;

    showAndHide(formNewProd, phaseFormNewProd);
    lockUnlock(update, false);


    function showAnotherProduct() {
        if(id.value != "") {
            lockUnlock(update, true);
            index = id.value-1;
            checkbox.checked = products[index]["attivo"] == 1;
            iva.value = products[index]["iva"];
            price.value = products[index]["prezzo"];
            photo.src = products[index]["photo"];
            photo.alt = products[index]["photo"].includes("default") ? defaultAlt : products[index]["photo"];

            lastCheckboxValue = checkbox.checked;
            lastPriceValue = price.value;
            lastNewPhotoValue = photo.value;
            setOrRemoveRequired();
            checkVariation();
        } else {
            checkbox.checked = false;
            iva.value = "";
            price.value = "";
            photo.src = defaultImg;
            photo.alt = defaultAlt;
            lockUnlock(update, false);
        }
    }

    function setOrRemoveRequired() {
        if(checkbox.checked == true) {
            inputFormUpdate.not("[type = checkbox]").attr("required", true);
        } else {
            inputFormUpdate.not("[type = checkbox]").removeAttr("required");
        }
    }

    function checkVariation(){
        if(price.value == lastPriceValue &&
           photo.value == lastNewPhotoValue &&
           checkbox.checked == lastCheckboxValue) {
            submit.attr("disabled", true);
        } else {
            submit.removeAttr("disabled");
        }
    }

    checkbox.addEventListener("change", setOrRemoveRequired);
    document.getElementById("id").addEventListener("change", showAnotherProduct);
    inputFormUpdate.change(checkVariation);

    $("button[name = addNewProduct]").click(function() {
        if(phaseFormNewProd) {
            slideUpAndDown(formNewProd, false);
            phaseFormNewProd = false;
        } else {
            slideUpAndDown(formNewProd, true);
            phaseFormNewProd = true;
        }

    });

    window.onload = showAnotherProduct();
});
