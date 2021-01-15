<?php
    header ("Content-Type: text / html; charset = utf-8");
    $states = $dataBase->getStates();
    $vitigni = $dataBase->getVitigni();
    $indexVitigno = 0;
?><div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
    </div>
</div>

<form name="newWineLabel" class="newWineLabel" action="#" method="GET">
    <ul>
        <li class="id">
            <label for="id">ID Etichetta</label>
            <input type="text" id="id" name="id" value="" readonly />
        </li>
        <li>
            <fieldset>
                <legend>Categoria</legend>
                <input type="radio" name="categoria" value="vino" id="vino" checked />
                <label for="vino" > Vino </label>
                <input type="radio" name="categoria" value="spumante" id="spumante" />
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
                <input type="radio" name="colore" value="rosso" id="rosso" checked />
                <label for="rosso"> Rosso </label>
                <input type="radio" name="colore" value="rosé" id="rose" />
                <label for="rose"> Rosé </label>
                <input type="radio" name="colore" value="bianco" id="bianco" />
                <label for="bianco"> Bianco </label>
            </fieldset>
        </li>
        <li>
            <label for="alcol">Titolo alcolico</label>
            <input type="number" name="alcol" value="0" id="alcol"
                min="0.0" max="100.0" step="0.1" required />
        </li>
        <li>
            <label for="zucchero">Tenore Zuccherino</label>
            <select name="zucchero" id="zucchero" required>
                <option value="">Ancora da selezionare...</option>
                <optgroup label="Spumante" class="spumante">
                    <option value="brut nature">Brut Nature </option>
                    <option value="extra brut">Extra Brut </option>
                    <option value="brut">Brut</option>
                    <option value="extra dry">Extra Dry</option>
                    <option value="dry">Dry</option>
                    <option value="demi sec">Demi Sec</option>
                    <option value="dolce">Dolce</option>
                </optgroup>
                <optgroup label="Vino" class="vino">
                    <option value="secco">Secco</option>
                    <option value="abboccato">Abboccato</option>
                    <option value="amabile">Amabile</option>
                    <option value="dolce">Dolce</option>
                </optgroup>
            </select>
        </li>
        <li class="vino">
            <fieldset>
                <legend>Fermo o Frizzante</legend>
                <input type="radio" name="gas" value="fermo" id="fermo" />
                <label for="fermo">Fermo</label>
                <input type="radio" name="gas" value="frizzante" id="frizzante" checked />
                <label for="frizzante">Frizzante</label>
            </fieldset>
        </li>
        <li>
            <label for="cantina">Cantina</label>
            <select name="cantina" id="cantina" required>
                <option value="">Ancora da selezionare...</option>
                <option value="new">Aggiungi Nuova Cantina</option>
                <optgroup label="Italia">
                    <option value="cantina1">cantina1</option>
                    <option value="cantina2">cantina2</option>
                    <option value="cantina3">cantina3</option>
                </optgroup>
                <optgroup label="Francia">
                    <option value="cantina4">cantina4</option>
                    <option value="cantina5">cantina5</option>
                </optgroup>
            </select>
        </li>
        <li class="newCantina">
            <label for="nomeCantina">Nome Nuova Cantina</label>
            <input type="text" name="nomeCantina" value="" id="nomeCantina" required />
        </li>
        <li class="newCantina">
            <label for="stato">Stato di Origine nuova cantina</label>
            <select class="" name="stato" id="stato" required>
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
            <label for="solfiti">Contiene Solfiti</label>
            <input type="checkbox" name="solfiti" value="true" id="solfiti" />
        </li>
        <li>
            <label for="biologico">Certificazione Biologica</label>
            <input type="checkbox" name="biologico" value="true" id="biologico" />
        </li>
        <li class="vino">
            <fieldset>
                <legend>Indicazione Geografica</legend>
                <input type="radio" name="ig" value="presente" id="presente" />
                <label for="presente">Presente</label>
                <input type="radio" name="ig" value="Assente" id="Assente" checked />
                <label for="Assente">Assente</label>
            </fieldset>
        </li>
        <li class="doFull">
            <fieldset>
                <legend>Certificazione</legend>
                <input type="radio" name="certificato" value="igp" id="igp" required />
                <label for="igp">IGP</label>
                <input type="radio" name="certificato" value="igt" id="igt" required />
                <label for="igt">IGT</label>
                <input type="radio" name="certificato" value="doc" id="doc" required />
                <label for="doc">DOC</label>
                <input type="radio" name="certificato" value="docg" id="docg" required />
                <label for="docg">DOCG</label>
                <input type="radio" name="certificato" value="dop" id="dop" required />
                <label for="dop">DOP</label>
            </fieldset>
        </li>
        <li class="noIg">
            <fieldset>
                <legend>Classificazione</legend>
                <input type="radio" name="classificazione" value="generico" id="generico" required />
                <label for="generico">Generico</label>
                <input type="radio" name="classificazione" value="varietale" id="varietale" required />
                <label for="varietale">Varietale</label>
            </fieldset>
        </li>
        <li class="varietale">
            <label for="vitigno">Vitigno</label>
            <select name="vitigno" id="vitigno">
                <option value="">Ancora da selezionare...</option>
                <option value="new">Aggiungi Nuovo Vitigno</option>
                <optgroup label="Bacca Chiara"><?php
                    foreach ($vitigni as $vitigno) {
                        if($vitigno["coloreBacca"]=="Chiara") {
                   ?>
                    <option value="<?php echo $vitigno["idVitigno"]; ?>"><?php echo $vitigno["nomeSpecie"]; ?></option> <?php
                        }
                    }
                    $indexVitigno++;
                 ?>
                </optgroup>
                <optgroup label="Bacca Scura"><?php
                    foreach ($vitigni as $vitigno) {
                        if($vitigno["coloreBacca"]=="Nera") {
                   ?>
                    <option value="<?php echo $vitigno["idVitigno"]; ?>"><?php echo $vitigno["nomeSpecie"]; ?></option> <?php
                        }
                    }
                    $indexVitigno++;
                 ?>

            </optgroup>
            </select>
        </li>
        <li class="newVitigno">
            <label for="coloreBaccaNuovoVitigno">Colore della Bacca del Vitigno da aggiungere</label>
            <select name="coloreBaccaNuovoVitigno" id="coloreBaccaNuovoVitigno" required>
                <option value="">Ancora da selezionare...</option>
                <option value="chiara">Chiara</option>
                <option value="scura">Scura</option>
            </select>
        </li>
        <li class="newVitigno">
            <label for="nomeNuovoVitigno">Nome della Specie del Vitigno da aggiungere</label>
            <input type="text" name="nomeNuovoVitigno" value="" id="nomeNuovoVitigno" required/>
        </li>
        <li class="varietale">
            <label for="anno">Annata</label>
            <input type="number" name="anno" id="anno" step="1" value="" min="1900" max="2099" />
        </li>
        <li class="doFull">
            <label for="indicazioneGeografica">Indicazione Geografica</label>
            <input type="text" name="indicazioneGeografica" id="indicazioneGeografica" value="" required />
        </li>
        <li class="doFull">
            <label for="vigna">Vigna di produzione (opzionale)</label>
            <input type="text" name="vigna" id="vigna" value="" />
        </li>
        <li class="doFull">
            <label for="menzione">Menzione</label>
            <select class="" name="menzione" id="menzione">
                <option value="">Ancora da selezionare...</option>
                <option value="new">Aggiungi nuova menzione</option>
                <optgroup label="Menzioni già utilizzate">
                    <option value="1">Passito</option>
                    <option value="2">Passito Liquoroso</option>
                    <option value="3">Riserva</option>
                    <option value="4">Riserva Superiore</option>
                    <option value="5">Novello</option>
                    <option value="6">Granselezione</option>
                    <option value="7">Superiore</option>
                </optgroup>
            </select>
        </li>
        <li class="newMenzione">
            <label for="newMenzione">Nuova Menzione</label>
            <input type="text" name="newMenzione" id="newMenzione" value="" required/>
        </li>
        <li class="doFull">
            <fieldset>
                <legend>Specificazione</legend>
                <input type="radio" name="specificazione" value="nessuna" id="nessuna" checked />
                <label for="nessuna">Nessuna</label>
                <input type="radio" name="specificazione" value="storica" id="storica"  />
                <label for="storica">Storica</label>
                <input type="radio" name="specificazione" value="classica" id="classica"  />
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
