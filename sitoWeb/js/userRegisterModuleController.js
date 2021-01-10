$(document).ready(function() {
    // Tipologia di utente in base alla selezione
    //const calendar = new Date();
    //const maxYearBirthday = calendar.getFullYear() + "-" + calendar.getMonth() + "-" + calendar.getDate();
    const psw = document.getElementById("psw");
    const pswRepeat = document.getElementById("psw-repeat");

    const private = $("form.register > ul > li.private");
    const privateInput = $("form.register > ul > li > input.private");
    const business = $("form.register > ul > li.business");
    const businessInput = $("form.register > ul > li > input.business");

    // funzioni
    function showBusiness(){
        private.slideUp({
            complete: function(){
                privateInput.attr('disabled', '');
                businessInput.removeAttr('disabled');
                business.slideDown();
            }
        });
    }

    function showPrivate(){
       business.slideUp({
           complete: function(){
               businessInput.attr('disabled', '');
               privateInput.removeAttr('disabled');
               private.slideDown();
           }
       });
    }

    function resetCheck(){
        if(pswRepeat.value == "") {
            if(pswRepeat.classList.contains("unmatch")) { pswRepeat.classList.remove("unmatch"); }
            if(pswRepeat.classList.contains("match")) { pswRepeat.classList.remove("match"); }
        }
    }

    function checkPasswordRepeat(){
        if(psw.value == pswRepeat.value) {
            if(pswRepeat.classList.contains("unmatch")) { pswRepeat.classList.remove("unmatch"); }
            pswRepeat.classList.add("match");
        } else {
            if(pswRepeat.value != "") {
                if(pswRepeat.classList.contains("match")) { pswRepeat.classList.remove("match"); }
                pswRepeat.classList.add("unmatch");
            }
        }
    }

    // aggiunta di eventi
    document.getElementById("private").addEventListener("click",showPrivate);
    document.getElementById("business").addEventListener("click", showBusiness);
    pswRepeat.addEventListener("keyup", checkPasswordRepeat);
    psw.addEventListener("keyup", checkPasswordRepeat);

    // predisposizione documento
    $("form.register > ul > li > input").attr('required', '');
    document.getElementById("private").setAttribute("checked", "");
    business.hide();
    businessInput.attr('disabled', '');
    private.show();
    privateInput.removeAttr('disabled');
});
