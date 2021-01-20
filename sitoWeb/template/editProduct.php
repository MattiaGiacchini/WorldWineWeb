<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
    </div>
</div>
<div class="link">
    <button type="button" name="button" onclick="document.location='./newWineLabel.html?idEtichetta=<?php echo $_GET["idEtichetta"]; ?>'">Visualizza Etichetta</button>
</div>
<form name="editProduct" class="editProduct" action="./insertUpdateProduct.php" method="POST" enctype="multipart/form-data">
    <ul><?php if (isset($_SESSION["msg"])): ?>
        <li>
            <p><?php echo $_SESSION["msg"]; ?></p>
        </li>
        <?php unset($_SESSION["msg"]); endif;?>
        <li>
            <input type="hidden" name="idLabel"         id="idLabel"        value="<?php echo $_GET["idEtichetta"]; ?>">
            <input type="hidden" name="lastVisible"     id="lastVisible"    value="">
            <input type="hidden" name="lastPrice"       id="lastPrice"      value="">
            <input type="hidden" name="lastiva"         id="lastIva"        value="">
            <input type="hidden" name="lastPhoto"       id="lastPhoto"      value="">

            <label for="id">Contenitori Abbinati</label>
            <select class="id" name="id" id="id">
                <option value="">Seleziona il contenitore...</option><?php
                if(count($templateParams["unsetted"]) != 0) { ?>
                <option value="new">Aggiungi Nuovo Abbinamento...</option>
                <?php }
                if(count($templateParams["visible"]) !=0 ) { ?>
                <optgroup label="visibili a catalogo">
                <?php   foreach ($templateParams["visible"] as $container) { ?>
                    <option value="<?php echo $container["idContenitore"] ?>"><?php echo sprintf('%2.3f',$container["capacitaContenitore"])."L - ".$container["nomeContenitore"]; ?></option>
                <?php   } ?>
                </optgroup>
                <?php }
                if(count($templateParams["invisible"]) !=0 ) {?>
                <optgroup label="non visibili a catalogo">
                <?php foreach ($templateParams["invisible"] as $container) { ?>
                    <option value="<?php echo $container["idContenitore"] ?>"><?php echo sprintf('%2.3f',$container["capacitaContenitore"])."L - ".$container["nomeContenitore"]; ?></option>
                <?php } ?>
                </optgroup>
                <?php } ?>
            </select>
        </li>
        <li class="newContainer">
            <label for="idNewContainer">Contenitori non ancora Abbinati</label>
            <select class="idNewContainer" name="idNewContainer" id="idNewContainer">
                <option value="">Seleziona il contenitore...</option>
                <?php if(count($templateParams["unsetted"]) !=0 ) {
                        foreach ($templateParams["unsetted"] as $container) { ?>
                <option value="<?php echo $container["idContenitore"] ?>"><?php echo sprintf('%06.3f', $container["capacitaContenitore"])."L - ".$container["nomeContenitore"]; ?></option>
                <?php   }
                } ?>
            </select>
        </li>
        <li>
            <div class="figure">
                <figure>
                    <figcaption>Immagine attualmente in uso</figcaption>
                    <img src="<?php echo getWineImgURL(0,0); ?>" id="photo" alt="Immagine di default">
                </figure>
            </div>
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
                <label for="newPhoto">Carica nuova foto</label>
                <input type="file" id="newPhoto" name="newPhoto" accept="image/gif,image/jpeg,image/png"/>
            </fieldset>
        </li>
        <li class="update">
            <input type="submit" value="inserisci">
        </li>
    </ul>
</form>
