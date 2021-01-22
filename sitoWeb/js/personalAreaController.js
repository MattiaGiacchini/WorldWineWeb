$(document).ready(function(){
    const psw = document.forms["personal-area"]["psw"];
    const pswRepeat = document.forms["personal-area"]["psw-repeat"];
    const submit = document.forms["personal-area"]["submit"];

    const pswBegin = psw.value;

    psw.addEventListener("keyup", checkForm);
    pswRepeat.addEventListener("keyup", checkForm);


    function checkForm() {
        console.log("verifico");
        if(psw.value != '') {
            if(psw.value == pswRepeat.value) {
                submit.removeAttribute("disabled");
                pswRepeat.classList.remove("unmatch");
            } else {
                pswRepeat.classList.add("unmatch");
                submit.setAttribute("disabled", "disabled");
            }
        } else {
            pswRepeat.value = '';
            pswRepeat.classList.remove("unmatch");
            submit.removeAttribute("disabled");
        }
    }

    checkForm();

});
