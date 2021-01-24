<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
    </div>
</div>

<form name="personal-area" class="personal-area" action="#" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <input type="hidden" name="id" value="<?php echo getLoggedUserId(); ?>">
            <div class="figure">
                <figure>
                    <img src="<?php if(getUserRole() == "admin") { $img = isset($_GET["idCollaborator"]) ? getUserImgURL($_GET["idCollaborator"]) : getUserImgURL(getLoggedUserId()); echo $img; } else { echo getUserImgURL(getLoggedUserId()); } ?>" id="photo" alt="Immagine di Profilo">
                    <figcaption>Immagine profilo attualmente in uso</figcaption>
                </figure>
            </div>
        </li><?php if(isset($_SESSION["msgError"])): ?>
        <li>
            <p><?php echo $_SESSION["msgError"]; unset($_SESSION["msgError"]); ?></p>
        </li>
        <?php endif; ?><li>
            <label for="newPhoto">Carica una nuova foto profilo</label>
            <input type="file" id="newPhoto" name="newPhoto" accept="image/gif,image/jpeg,image/png"/>
        </li><?php if($templateParams["userInfo"]["ragioneSociale"] != null): ?>
        <li class="business">
            <label class="business" for="company">Ragione Sociale</label>
            <input class="business" type="text" id="company" name="company"
            maxlength="100"  value="<?php echo $templateParams["userInfo"]["ragioneSociale"]; ?>" disabled/>
        </li>
        <li class="business">
            <label class="business" for="pIva">Partita IVA</label>
            <input class="business" type="text" id="pIva" name="pIva" autocomplete="on "
            maxlength="11" pattern="^[0-9]{11}$" value="<?php echo $templateParams["userInfo"]["partitaIva"]; ?>" disabled/>
        </li><?php else: ?>
        <li class="private">
            <label class="private" for="name" >Nome</label>
            <input class="private" type="text" id="name" name="name" maxlength="20" value="<?php echo $templateParams["userInfo"]["nome"]; ?>"  disabled/>
        </li>
        <li class="private">
            <label class="private" for="surname">Cognome</label>
            <input class="private" type="text" id="surname" name="surname" maxlength="20" value="<?php echo $templateParams["userInfo"]["cognome"]; ?>" disabled/>
        </li>
        <li class="private">
            <label class="private" for="cf">Codice Fiscale</label>
            <input class="private" type="text" id="cf" name="cf" maxlength="16"
            pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" value="<?php echo $templateParams["userInfo"]["cf"]; ?>" disabled/>
        </li>
        <li class="private">
            <label class="private" for="birthday">Data di Nascita</label>
            <input class="private" type="date" id="birthday" name="birthday"
             max="<?php $time = strtotime("-18 year", time()); echo date("Y-m-d", $time); ?>" value="<?php echo $templateParams["userInfo"]["dataDiNascita"]; ?>" disabled/>
        </li><?php endif; if(getUserRole() == "admin"):?>
        <li>
            <label for="attivo">Collaboratore attivo</label>
            <input type="checkbox" id="attivo" name="attivo" value="1" <?php echo $templateParams["userInfo"]["attivo"] == 1 ? "checked" : ""; ?>>
        </li>
        <?php endif; ?><li>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" autocomplete="on" value="<?php echo $templateParams["userInfo"]["email"]; ?> "
                pattern="\b[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,6}\b"
                maxlength="100"
                title="L'email inserita è incompleta oppure incorretta"/>
        </li>
        <li>
            <label for="psw">Password</label>
            <input type="password" id="psw" name="psw" autocomplete="on"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                maxlength="20"
                title="La password deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" />
        </li>
        <li>
            <label for="psw-repeat">Conferma Password</label>
            <input class="" type="password" id="psw-repeat" name="psw-repeat" maxlength="20" autocomplete="on" />
        </li>
        <li>
            <input type="submit" name="submit" value="aggiorna" />
        </li>
    </ul>
</form>
