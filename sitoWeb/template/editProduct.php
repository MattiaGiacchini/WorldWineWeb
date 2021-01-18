<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
    </div>
</div>
<div class="link">
    <button type="button" name="button" onclick="document.location='./newWineLabel.html'">Modifica Etichetta</button>
</div>
<form name="editProduct" class="editProduct" action="#" method="POST">
    <ul>
        <li class="update">
            <label for="id">Contenitori Abbinati</label>
            <select class="id" name="id" id="id">
                <option value="">Seleziona per i dettagli...</option>
                <?php if(count($templateParams["visible"]) !=0 ) { ?>
                <optgroup label="visibili a catalogo">
                <?php   foreach ($templateParams["visible"] as $container) { ?>
                    <option value="<?php echo $container["idContenitore"] ?>"><?php echo sprintf('%2.3f',$container["capacitaContenitore"])."L - ".$container["nomeContenitore"]; ?></option>
                <?php   } ?>
                </optgroup>
                <?php }
                if(count($templateParams["invisible"]) !=0 ) {?>
                <optgroup label="non visibili a catalogo">
                <?php foreach ($templateParams["visible"] as $container) { ?>
                    <option value="<?php echo $container["idContenitore"] ?>"><?php echo sprintf('%2.3f',$container["capacitaContenitore"])."L - ".$container["nomeContenitore"]; ?></option>
                <?php } ?>
                </optgroup>
                <?php } ?>
            </select>
        </li>
        <li class="update">
            <fieldset class="modify">
                <p>Dati del Contenitore Abbinato</p>
                <label for="visible">Visibile a catalogo</label>
                <input type="checkbox" name="Visibile" id="visible" value="true">
                <label for="price">Prezzo €</label>
                <input type="number" name="price" id="price" value="" min="0.00" step="0.01">
                <label for="iva">Imponibile %</label>
                <input type="number" name="iva" id="iva" value="" max="100.00" min="0.00" step="0.01">
                <label for="photo">Foto del Prodotto</label>
                <input type="file" id="photo" name="photo" accept="image/*"/>
            </fieldset>
        </li>
        <li class="update">
            <input type="submit" value="Aggiorna">
        </li>
        <li>
            <button type="button" name="button">Aggiungi Nuovo Abbinamento</button>
        </li>
    </ul>
</form>
<form name="addNewProduct" class="addNewProduct" action="#" method="POST">
    <ul>
        <li>
            <p>Contenitore da Abbinare</p>
        <li>
        <li>
            <label for="idNewContainer">Contenitori non ancora Abbinati</label>
            <select class="idNewContainer" name="idNewContainer" id="idNewContainer">
                <option value="">Seleziona il contenitore...</option>
                <?php if(count($templateParams["unsetted"]) !=0 ) { ?>
                <optgroup label="visibili a catalogo">
                <?php   foreach ($templateParams["unsetted"] as $container) { ?>
                    <option value="<?php echo $container["idContenitore"] ?>"><?php echo sprintf('%06.3f', $container["capacitaContenitore"])."L - ".$container["nomeContenitore"]; ?></option>
                <?php   } ?>
                </optgroup>
            <?php } ?>
            </select>
        </li>
        <li>
            <fieldset class="modify">
                <p>Dati di Abbinamento</p>
                <label for="visibleNewContainer">Visibile a catalogo</label>
                <input type="checkbox" name="visibleNewContainer" id="visibleNewContainer" value="true">
                <label for="priceNewContainer">Prezzo €</label>
                <input type="number" name="priceNewContainer" id="priceNewContainer" value="" min="0.00" step="0.01">
                <label for="ivaNewContainer">Imponibile (iva %)</label>
                <input type="number" name="ivaNewContainer" id="ivaNewContainer" value="" max="100.00" min="0.00" step="0.01">
                <label for="photoNewContainer">Foto del Prodotto</label>
                <input type="file" id="photoNewContainer" name="photoNewContainer" accept="image/*"/>
            </fieldset>
        </li>
        <li>
            <input type="submit" value="Abbina">
        </li>
    </ul>
</form>
