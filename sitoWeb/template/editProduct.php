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
                <optgroup label="non visibili a catalogo">
                    <option value="">nome  0,375L</option>
                    <option value="">nome  0,75L</option>
                </optgroup>
                <optgroup label="visibili a catalogo">
                    <option value="">nome  0,375L</option>
                    <option value="">nome  0,75L</option>
                </optgroup>
            </select>
        </li>
        <li class="update">
            <fieldset class="modify">
                <p>Dati del Contenitore Abbinato</p>
                <label for="visible">Visibile a catalogo</label>
                <input type="checkbox" name="Visibile" id="visible" value="true">
                <label for="price">Prezzo €</label>
                <input type="number" name="price" id="price" value="" min="0.00" step="0.01">
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
            <label for="idNewContainer">Contenitori Abbinabili</label>
            <select class="idNewContainer" name="idNewContainer" id="idNewContainer">
                <option value="">Seleziona il contenitore...</option>
                <option value="">nome  0,375L</option>
                <option value="">nome  0,75L</option>
            </select>
        </li>
        <li>
            <fieldset class="modify">
                <p>Dati di Abbinamento</p>
                <label for="visibleNewContainer">Visibile a catalogo</label>
                <input type="checkbox" name="visibleNewContainer" id="visibleNewContainer" value="true">
                <label for="priceNewContainer">Prezzo €</label>
                <input type="number" name="priceNewContainer" id="priceNewContainer" value="" min="0.00" step="0.01">
                <label for="photoNewContainer">Foto del Prodotto</label>
                <input type="file" id="photoNewContainer" name="photoNewContainer" accept="image/*"/>
            </fieldset>
        </li>
        <li>
            <input type="submit" value="Abbina">
        </li>
    </ul>
</form>
