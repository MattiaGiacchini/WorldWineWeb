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
            <label class="business" for="company">Ragione Sociale</label>
            <input class="business" type="text" id="company" name="company"
            maxlength="100" required autocomplete="on" />
        </li>
        <li class="business">
            <label class="business" for="pIva">Partita IVA</label>
            <input class="business" type="text" id="pIva" name="pIva" required autocomplete="on "
            maxlength="11" pattern="^[0-9]{11}$" />
        </li>
        <li class="private">
            <label class="private" for="name" >Nome</label>
            <input class="private" type="text" id="name" name="name" maxlength="20" required autocomplete="on" />
        </li>
        <li class="private">
            <label class="private" for="surname">Cognome</label>
            <input class="private" type="text" id="surname" name="surname" maxlength="20" required autocomplete="on" />
        </li>
        <li class="private">
            <label class="private" for="cf">Codice Fiscale</label>
            <input class="private" type="text" id="cf" name="cf" required maxlength="16"
            pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" />
        </li>
        <li class="private">
            <label class="private" for="birthday">Data di Nascita</label>
            <input class="private" type="date" id="birthday" name="birthday"
             max="<?php $time = strtotime("-18 year", time()); echo date("Y-m-d", $time); ?>" required autocomplete="on"/>
        </li>
        <li>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" autocomplete="on" required
                pattern="\b[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,6}\b"
                maxlength="100"
                title="L'email inserita è incompleta oppure incorretta" />
        </li>
        <li>
            <label for="psw">Password</label>
            <input type="password" id="psw" name="psw" autocomplete="on" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                maxlength="20"
                title="La password deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" />
        </li>
        <li>
            <label for="psw-repeat">Conferma Password</label>
            <input class="" type="password" id="psw-repeat" name="psw-repeat" maxlength="20" required autocomplete="on" />
        </li>
        <li>
            <input type="submit" name="submit" value="Registrati" />
        </li>
    </ul>
</form>
