<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
    </div>
</div>

<form class="register" action="#" method="POST">
    <ul>
        <li>
            <fieldset class="privateOrBusiness">
                <legend>Registrati come</legend>
                <input type="radio" id="private" name="register" value="private" />
                <label for="private">Privato</label>
                <input type="radio" id="business" name="register" value="business" />
                <label for="business">Azienda</label>
            </fieldset>
        </li>
        <li class="business">
            <label class="business" for="company">Denominazione Sociale</label>
            <input class="business" type="text" id="company" name="company" required disabled="disabled" />
        </li>
        <li class="business">
            <label class="business" for="pIva">Partita IVA</label>
            <input class="business" type="text" id="pIva" name="pIva"
            pattern="^[0-9]{11}$" />
        </li>
        <li class="private">
            <label class="private" for="name" >Nome</label>
            <input class="private" type="text" id="name" name="name" />
        </li>
        <li class="private">
            <label class="private" for="surname">Cognome</label>
            <input class="private" type="text" id="surname" name="surname" />
        </li>
        <li class="private">
            <label class="private" for="cf">Codice Fiscale</label>
            <input class="private" type="text" id="cf" name="cf"
            pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" />
        </li>
        <li class="private">
            <label class="private" for="birthday">Data di Nascita</label>
            <input class="private" type="date" id="birthday" name="birthday" max="2002-12-29" />
        </li>
        <li>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="L'email inserita è incompleta oppure incorretta" />
        </li>
        <li>
            <label for="psw">Password</label>
            <input type="password" id="psw" name="psw"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="La password deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" />
        </li>
        <li>
            <label for="psw-repeat">Conferma Password</label>
            <input class="" type="password" id="psw-repeat" name="psw-repeat" />
        </li>
        <li>
            <input type="submit" name="submit" value="Registrati" />
        </li>
    </ul>
</form>
