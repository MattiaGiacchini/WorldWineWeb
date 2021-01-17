
function getOutLi(elements) {
    elements.slideUp();
    elements.attr("disabled", true);
    elements.find("*").attr("disabled", true);
}
function getInLi(elements, required) {
    elements.removeAttr("disabled");
    elements.find("*").removeAttr("disabled");
    if(required) {
        elements.find("*").attr("required", true);
    } else {
        elements.find("*").removeAttr("required");
    }
    elements.slideDown();
}

function getOutLiInstant(elements) {
    elements.hide();
    elements.attr("disabled", true);
    elements.find("*").attr("disabled", true);
}

function getInLiInstant(elements) {
    elements.removeAttr("disabled");
    elements.find("*").removeAttr("disabled");
    elements.show();
}

function setRequiredIntoLi(elements, yes) {
     elements.find("input select").attr("required", yes);
}

function checkVitigno(elements) {
    if(document.forms["newWineLabel"]["vitigno"].value == "new") {
        getInLi(elements, true);
    } else {
        getOutLi(elements);
    }
}

function checkMenzione(elements) {
    if(document.forms["newWineLabel"]["menzione"].value == "new") {
        getInLi(elements, true);
    } else {
        getOutLi(elements);
    }
}

$(document).ready(function(){
    const idBox             = $("form.newWineLabel .id");
    const newCantina        = $("form.newWineLabel .newCantina");
    const allWineElement    = $("form.newWineLabel .vino");
    const spumElement       = $("form.newWineLabel .spumante");
    const vitigno           = allWineElement.filter(".vitigno").not(".new");
    const newVitigno        = allWineElement.filter(".vitigno.new");
    const annata            = allWineElement.filter(".annata");
    const indiGeogr         = allWineElement.filter(".indicazioneGeografica");
    const menzione          = allWineElement.filter(".menzione").not(".new");
    const newMenzione       = allWineElement.filter(".menzione.new");
    const specificazione    = allWineElement.filter(".specificazione")
    const wineElement       = allWineElement.not(vitigno)
                                            .not(newVitigno)
                                            .not(annata)
                                            .not(indiGeogr)
                                            .not(menzione)
                                            .not(newMenzione)
                                            .not(specificazione);

    let lastCategorySelected;
    let actualCategorySelected;
    let actualClassificat;
    let wine;

    function changeForm() {
        actualCategorySelected = document.forms["newWineLabel"]["categoria"].value;
        actualClassificat = document.forms["newWineLabel"]["classificazione"].value;

        // si tratta di un vino?
        wine = actualCategorySelected == "Vino";

        // verifica se la cantina è da inserire nuova
        if(document.forms["newWineLabel"]["cantina"].value == "new"){
            getInLi(newCantina);
        } else {
            getOutLi(newCantina);
        }

        // verifica se si tratta di un vino o di uno spumante
        if(lastCategorySelected != actualCategorySelected) {
            lastCategorySelected = actualCategorySelected;
            if(wine){
                getInLiInstant(wineElement);
                getOutLiInstant(spumElement);
            } else {
                getInLiInstant(spumElement);
                getOutLiInstant(allWineElement);
            }
            document.forms["newWineLabel"]["zucchero"].value = "";
        }

        if(wine) {
            if(actualClassificat == "Generico") {
                getOutLi(vitigno);
                getOutLi(newVitigno);
                getOutLi(annata);
                getOutLi(indiGeogr);
                getOutLi(menzione);
                getOutLi(newMenzione);
                getOutLi(specificazione);
            } else if (actualClassificat == "Varietale") {
                getInLi(vitigno, false);
                checkVitigno(newVitigno);
                getInLi(annata, false);
                getOutLi(indiGeogr);
                getOutLi(menzione);
                getOutLi(newMenzione);
                getOutLi(specificazione);
            } else if( actualClassificat == "IGT" || actualClassificat == "IGP") {
                getInLi(vitigno, false);
                checkVitigno(newVitigno);
                getInLi(annata, false);
                getInLi(indiGeogr, true);
                getOutLi(menzione);
                getOutLi(newMenzione);
                getOutLi(specificazione);
            } else if( actualClassificat == "DOP" || actualClassificat == "DOC" || actualClassificat == "DOCG") {
                getInLi(vitigno, false);
                checkVitigno(newVitigno);
                getInLi(annata, true);
                getInLi(indiGeogr, false);
                getInLi(menzione, false);
                checkMenzione(newMenzione);
                getInLi(specificazione, true);
            }
        } else {
            getOutLi(allWineElement);
        }
    }

    // Verifica se è presente o meno l'identificativo dell'Etichetta
    if(document.forms["newWineLabel"]["id"].value == "") {
        getOutLiInstant(idBox);

        /**
        *   selezione vino oppure spumante
        */
        $("form.newWineLabel input[name = categoria]").on("change", changeForm);
        //document.getElementById("categoria").addEventListener("change", changeForm);

        /**
        *   Aggiungi o meno nuova cantina
        */
        document.getElementById("cantina").addEventListener("change", changeForm);

        /**
        *   Vino Generico oppure varietale
        */
        $("form.newWineLabel input[name = classificazione]").on("change", changeForm);

        /**
        *   apparizione o scoparsa del vitigno da aggiungere
        */
        document.getElementById("vitigno").addEventListener("change", changeForm);

        /**
        *   apparizione o scoparsa del vitigno da aggiungere
        */
        document.getElementById("menzione").addEventListener("change", changeForm);
    } else {
        getInLiInstant(idBox);
        $("form.newWineLabel > ul > li").find("*").not("[type = button]").attr("disabled", true);
    }

    changeForm();
});
