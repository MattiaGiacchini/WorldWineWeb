
function getOutLi(elements) {
    elements.slideUp();
    elements.attr("disabled", true);
    elements.find("*").attr("disabled", true);
}
function getInLi(elements) {
    elements.removeAttr("disabled");
    elements.find("*").removeAttr("disabled");
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

$(document).ready(function(){
    const idBox       = $("form.newWineLabel .id");
    const wineElement = $("form.newWineLabel .vino");
    const newCantina  = $("form.newWineLabel .newCantina");
    const newVitigno  = $("form.newWineLabel .newVitigno");
    const spumElement = $("form.newWineLabel .spumante");
    const doFull      = $("form.newWineLabel .doFull");
    const varietale   = $("form.newWineLabel .varietale");
    const noIg        = $("form.newWineLabel .noIg");
    const newMenzione    = $("form.newWineLabel .newMenzione")

    let lastCatSelected;

    function changeForm() {
        let actualCatSelected = document.forms["newWineLabel"]["categoria"].value;
        let actualIgSelection = document.forms["newWineLabel"]["ig"].value;
        let actualClassificat = document.forms["newWineLabel"]["classificazione"].value;

        // si tratta di un vino?
        let wine = actualCatSelected == "vino";

        // verifica se la cantina è da inserire nuova
        if(document.forms["newWineLabel"]["cantina"].value == "new"){
            getInLi(newCantina);
        } else {
            getOutLi(newCantina);
        }

        // verifica se si tratta di un vino o di uno spumante
        if(lastCatSelected != actualCatSelected) {
            lastCatSelected = actualCatSelected;
            if(actualCatSelected == "vino"){
                getInLi(wineElement);
                getOutLi(spumElement);
            } else {
                getInLi(spumElement);
                getOutLi(wineElement);
            }
            document.forms["newWineLabel"]["zucchero"].value = "";
        }

        if(wine) {
            // verifica se si tratta di un vino con indicazioneGeografica
            if(actualIgSelection == "presente") {
                getInLi(doFull);
                getOutLi(noIg);
            } else {
                getInLi(noIg);
                getOutLi(doFull);
            }

            // se non possiede indicazioneGeografica
            if(actualIgSelection == "presente" || actualClassificat == "varietale") {
                getInLi(varietale);
            } else {
                getOutLi(varietale);
            }

            // verifica se è da inserire un nuovo vino
            if(document.forms["newWineLabel"]["vitigno"].value == "new"
               && (actualIgSelection == "presente"
                   || actualClassificat == "varietale")){
                getInLi(newVitigno);
            } else {
                getOutLi(newVitigno);
            }


            // verifica se è da inserire un nuovo vino
            if(document.forms["newWineLabel"]["menzione"].value == "new"
                && actualIgSelection == "presente") {
                getInLi(newMenzione);
            } else {
                getOutLi(newMenzione);
            }
        } else {
            getOutLi(noIg);
            getOutLi(doFull);
            getOutLi(varietale);
            getOutLi(newVitigno);
            getOutLi(newMenzione);
        }
    }

    // VARIABILE DI TEST
    // document.forms["newWineLabel"]["id"].value = "c";

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
        *   Indicazione geografica presente o meno
        */
        $("form.newWineLabel input[name = ig]").on("change", changeForm);

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
