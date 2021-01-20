<?php
    header ("Content-Type: text / html; charset = utf-8");
    $states = $dataBase->getStates();
    $vitigni = $dataBase->getVitigni();
    $cantine = $dataBase->getCantine();
    $menzioni = $dataBase->getMentions();
?><div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
    </div>
</div>

<form name="newWineLabel" class="newWineLabel" action="insertNewWineLabel.php" method="POST">
    <ul>
     <?php
     if (isset($_SESSION["msgError"])) {
         ?>
         <li>
             <p><?php echo $_SESSION["msgError"];  ?></p>
         </li>
         <?php
         unset($_SESSION["msgError"]);
     }
     ?>
        <li class="id">
            <label for="id">ID Etichetta</label>
            <input type="text" id="id" name="id" value="<?php echo isset($_GET["idLabel"]) ? $_GET["idLabel"] : ""; ?>" readonly />
        </li>
        <li>
            <fieldset>
                <legend>Categoria</legend>
                <input type="radio" name="categoria" value="Vino" id="vino" checked />
                <label for="vino" > Vino </label>
                <input type="radio" name="categoria" value="Spumante" id="spumante" />
                <label for="spumante">Spumante</label>
            </fieldset>
        </li>
        <li>
            <label for="name"> Nome Etichetta </label>
            <input type="text" id="name" name="nome" value="" required />
        </li>
        <li>
            <label for="description"> Descrizione </label>
            <textarea name="description" rows="5" cols="80" id="description"
                maxlength="500"  required
                placeholder="massimo 500 caratteri..."></textarea>
        </li>
        <li>
            <fieldset>
                <legend>Colore</legend>
                <input type="radio" name="colore" value="Rosso" id="rosso" checked />
                <label for="rosso"> Rosso </label>
                <input type="radio" name="colore" value="Rosato" id="rose" />
                <label for="rose"> Rosato </label>
                <input type="radio" name="colore" value="Bianco" id="bianco" />
                <label for="bianco"> Bianco </label>
            </fieldset>
        </li>
        <li>
            <label for="alcol">Titolo alcolico</label>
            <input type="number" name="alcol" id="alcol"
                min="0.0" max="100.0" step="0.1" required />
        </li>
        <li>
            <label for="tMax">Temperatura Massima cui servire</label>
            <input type="number" name="tMax" id="tMax"
                min="0.0" max="100.0" step="0.1" />
        </li>
        <li>
            <label for="tMin">Temperatura Minima cui servire</label>
            <input type="number" name="tMin" id="tMin"
                min="0.0" max="100.0" step="0.1" />
        </li>
        <li>
            <label for="zucchero">Tenore Zuccherino</label>
            <select name="zucchero" id="zucchero" required>
                <option value="">Ancora da selezionare...</option>
                <optgroup label="Spumante" class="spumante">
                    <option value="Brut Nature">Brut Nature </option>
                    <option value="Extra Brut">Extra Brut </option>
                    <option value="Brut">Brut</option>
                    <option value="Extra Dry">Extra Dry</option>
                    <option value="Dry">Dry</option>
                    <option value="Demi Sec">Demi Sec</option>
                    <option value="Dolce">Dolce</option>
                </optgroup>
                <optgroup label="Vino" class="vino">
                    <option value="Secco">Secco</option>
                    <option value="Abboccato">Abboccato</option>
                    <option value="Amabile">Amabile</option>
                    <option value="Dolce">Dolce</option>
                </optgroup>
            </select>
        </li>
        <li>
            <label for="cantina">Cantina</label>
            <select name="cantina" id="cantina" required>
                <option value="">Ancora da selezionare...</option>
                <option value="new">Aggiungi Nuova Cantina</option><?php
                    $lastState = null;
                    foreach ($cantine as $cantina) {
                        if($lastState != $cantina["nomeStato"]){
                            if($lastState != null) {
                                ?>
                </optgroup>
                <?php
                            }
                            ?>

                <optgroup label="<?php echo $cantina["nomeStato"]; ?>">
                    <option value="<?php echo $cantina["idCantina"]; ?>"><?php echo $cantina["nomeCantina"]; ?></option>
                   <?php
                            $lastState = $cantina["nomeStato"];
                        } else {?>
                    <option value="<?php echo $cantina["idCantina"]; ?>"><?php echo $cantina["nomeCantina"]; ?></option>
                    <?php
                        }
                    }
                 ?>
                </optgroup>
            </select>
        </li>
        <li class="newCantina">
            <label for="nomeCantina">Nome Nuova Cantina</label>
            <input type="text" name="nomeCantina" value="" id="nomeCantina" required />
        </li>
        <li class="newCantina">
            <label for="stato">Stato di Origine nuova cantina</label>
            <select class="" name="statoCantina" id="stato" required>
                <option value="">Ancora da selezionare...</option>
                <?php
                foreach ($states as $state) {
                ?>
                <option value="<?php echo $state["sigla"]; ?>"><?php echo $state["nome"]; ?></option>
                <?php
                }
                ?>
            </select>
        </li>
        <li>
            <fieldset>
                <legend>Solfiti</legend>
                <input type="radio" name="solfiti" value="true" id="solfitiPresenti" required checked />
                <label for="solfitiPresenti">Presenti</label>
                <input type="radio" name="solfiti" value="false" id="solfitiNonPresenti" required />
                <label for="solfitiNonPresenti">Assenti</label>
            </fieldset>
        </li>
        <li>
            <fieldset>
                <legend>Certificazione Biologica</legend>
                <input type="radio" name="biologico" value="true" id="biologicoPresenti" required  />
                <label for="biologicoPresenti">Presente</label>
                <input type="radio" name="biologico" value="false" id="biologicoNonPresenti" required checked />
                <label for="biologicoNonPresenti">Assente</label>
            </fieldset>
        </li>
        <li class="vino">
            <fieldset>
                <legend>Fermo o Frizzante</legend>
                <input type="radio" name="gas" value="Fermo" id="fermo" />
                <label for="fermo">Fermo</label>
                <input type="radio" name="gas" value="Frizzante" id="frizzante" checked />
                <label for="frizzante">Frizzante</label>
            </fieldset>
        </li>
        <li class="vino">
            <fieldset>
                <legend>Classificazione del Vino</legend>
                <input type="radio" name="classificazione" value="Generico" id="generico" required checked/>
                <label for="generico">Generico</label>
                <input type="radio" name="classificazione" value="Varietale" id="varietale" required />
                <label for="varietale">Varietale</label>
                <input type="radio" name="classificazione" value="IGP" id="igp" required />
                <label for="igp">IGP</label>
                <input type="radio" name="classificazione" value="IGP" id="igt" required />
                <label for="igt">IGT</label>
                <input type="radio" name="classificazione" value="DOC" id="doc" required />
                <label for="doc">DOC</label>
                <input type="radio" name="classificazione" value="DOCG" id="docg" required />
                <label for="docg">DOCG</label>
                <input type="radio" name="classificazione" value="DOP" id="dop" required />
                <label for="dop">DOP</label>
            </fieldset>
        </li>
        <li class="vino vitigno">
            <label for="vitigno">Vitigno</label>
            <select name="vitigno" id="vitigno">
                <option value="">Ancora da selezionare...</option>
                <option value="new">Aggiungi Nuovo Vitigno</option>
                <optgroup label="Bacca Chiara">
                    <?php
                    foreach ($vitigni as $vitigno) {
                        if($vitigno["coloreBacca"]=="Chiara") {
                   ?>
                    <option value="<?php echo $vitigno["idVitigno"]; ?>"><?php echo $vitigno["nomeSpecie"]; ?></option>
                    <?php
                        }
                    }
                 ?>
                </optgroup>
                <optgroup label="Bacca Nera">
                    <?php
                    foreach ($vitigni as $vitigno) {
                        if($vitigno["coloreBacca"]=="Nera") {
                   ?>
                    <option value="<?php echo $vitigno["idVitigno"]; ?>"><?php echo $vitigno["nomeSpecie"]; ?></option>
                    <?php
                        }
                    }
                 ?>
            </optgroup>
            </select>
        </li>
        <li class="vino vitigno new">
            <label for="coloreBaccaNuovoVitigno">Colore Bacca Nuovo Vitigno</label>
            <select name="coloreBaccaNuovoVitigno" id="coloreBaccaNuovoVitigno" required>
                <option value="">Ancora da selezionare...</option>
                <option value="Chiara">Chiara</option>
                <option value="Nera">Nera</option>
            </select>
        </li>
        <li class="vino vitigno new">
            <label for="nomeNuovoVitigno">Nome Specie Nuovo Vitigno</label>
            <input type="text" name="nomeNuovoVitigno" value="" id="nomeNuovoVitigno" required/>
        </li>
        <li class="vino annata">
            <label for="anno">Annata</label>
            <input type="number" name="anno" id="anno" step="1" value="" min="1900" max="2099" />
        </li>
        <li class="vino indicazioneGeografica">
            <label for="indicazioneGeografica">Indicazione Geografica</label>
            <input type="text" name="indicazioneGeografica" id="indicazioneGeografica" value="" required />
        </li>
        <li class="vino menzione">
            <label for="menzione">Menzione</label>
            <select class="" name="menzione" id="menzione">
                <option value="">Ancora da selezionare...</option>
                <option value="new">Aggiungi nuova menzione</option>
                <optgroup label="Menzioni già utilizzate">
                    <?php
                    foreach ($menzioni as $menzione) {?>
                    <option value="<?php echo $menzione["idMenzione"]; ?>"><?php echo $menzione["menzione"]; ?></option>
                <?php } ?>
                </optgroup>
            </select>
        </li>
        <li class="vino menzione new">
            <label for="newMenzione">Nuova Menzione</label>
            <input type="text" name="newMenzione" id="newMenzione" value="" required/>
        </li>
        <li class="vino specificazione">
            <fieldset>
                <legend>Specificazione</legend>
                <input type="radio" name="specificazione" value="Nessuna" id="nessuna" checked />
                <label for="nessuna">Nessuna</label>
                <input type="radio" name="specificazione" value="Storica" id="storica"  />
                <label for="storica">Storica</label>
                <input type="radio" name="specificazione" value="Classica" id="classica"  />
                <label for="classica">Classica</label>
            </fieldset>
        </li>
        <li>
            <input type="submit" name="submit" value="Conferma"/>
        </li>
        <li>
            <input type="button" name="annulla" value="annulla">
        </li>
    </ul>
</form>
