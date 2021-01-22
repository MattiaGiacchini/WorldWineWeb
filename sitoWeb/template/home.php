<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>

        <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
    </div>
    <form class="filter" action="#" method="get">
        <?php if (getUserRole() === "client") { ?>
            <fieldset>
                <legend>Preferiti</legend>
                <ul>
                    <li>
                        <input type="checkbox" name="Preferiti" value="Preferiti" id="filterPreferiti"/>
                        <label for="filterPreferiti"> Preferiti </label>
                    </li>
                </ul>
            </fieldset>
        <?php } ?>

        <fieldset>
            <legend>Macrocategoria</legend>
            <ul>
                <li>
                    <input type="checkbox" name="Vino" value="Vino" id="filterVino"/>
                    <label for="filterVino"> Vino </label>
                </li>
                <li>
                    <input type="checkbox" name="Spumante" value="Spumante" id="filterSpumante"/>
                    <label for="filterSpumante"> Spumante </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Colore</legend>
            <ul>
                <li>
                    <input type="checkbox" name="Rosso" value="Rosso" id="filterRed"/>
                    <label for="filterRed"> Rosso </label>
                </li>
                <li>
                    <input type="checkbox" name="Rosato" value="Rosato" id="filterRose"/>
                    <label for="filterRose"> Rosato </label>
                </li>
                <li>
                    <input type="checkbox" name="Bianco" value="Bianco" id="filterWhite"/>
                    <label for="filterWhite"> Bianco </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Gas</legend>
            <ul>
                <li>
                    <input type="checkbox" name="Fermo" value="Fermo" id="filterFermo"/>
                    <label for="filterFermo"> Fermo </label>
                </li>
                <li>
                    <input type="checkbox" name="Frizzante" value="Frizzante" id="filterFrizzante"/>
                    <label for="filterFrizzante"> Frizzante </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Classificazione</legend>
            <ul>
                <li>
                    <input type="checkbox" name="Generico" value="Generico" id="filterGenerico"/>
                    <label for="filterGenerico"> Generico </label>
                </li>
                <li>
                    <input type="checkbox" name="Varietale" value="Varietale" id="filterVarietale"/>
                    <label for="filterVarietale"> Varietale </label>
                </li>
                <li>
                    <input type="checkbox" name="IGP" value="IGP" id="filterIGP"/>
                    <label for="filterIGP"> IGP </label>
                </li>
                <li>
                    <input type="checkbox" name="IGT" value="IGT" id="filterIGT"/>
                    <label for="filterIGT"> IGT </label>
                </li>
                <li>
                    <input type="checkbox" name="DOC" value="DOC" id="filterDOC"/>
                    <label for="filterDOC"> DOC </label>
                </li>
                <li>
                    <input type="checkbox" name="DOP" value="DOP" id="filterDOP"/>
                    <label for="filterDOP"> DOP </label>
                </li>
                <li>
                    <input type="checkbox" name="DOCG" value="DOCG" id="filterDOCG"/>
                    <label for="filterDOCG"> DOCG </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="applica filtri">
    </form>
</div>

<?php if (isset($_SESSION["orderCreated"])) { ?>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <em>Grazie!</em> Il tuo ordine è stato ricevuto.
    </div>
    <?php unset($_SESSION["orderCreated"]); ?>
<?php } ?>

<div class="article-container">
<?php foreach($templateParams["products"] as $prodotto):?>
    <article class="wineCard">
        <a href="./showLabelDetails.php?idLabel=<?php echo $prodotto["idEtichetta"]."&idContainer=".$prodotto["idContenitore"];?>">
            <div class="wineCard-Container">
                <img class="fotoVino" src="<?php echo getWineImgURL($prodotto["idEtichetta"], $prodotto["idContenitore"]); ?>" alt="Foto <?php echo $prodotto["categoria"]." ".$prodotto["colore"]; ?>" />
                <div class="etichetta">
                    <h3><?php echo $prodotto["nomeEtichetta"]; ?></h3>
                    <h4><?php echo $prodotto["nomeCantina"]; ?></h4>
                    <div class="LiterVol">
                        <h5><?php echo round($prodotto["capacita"], 3); ?>L</h5> <h5><?php echo round($prodotto["titoloAlcolico"], 1); ?>% Vol</h5>
                    </div>
                    <p class="origine"><?php echo $prodotto["indicazioneGeografica"]!=null ? $prodotto["indicazioneGeografica"]." - " : ""; echo $prodotto["stato"] != null ? $prodotto["stato"] : "";?></p>
                    <p class="certificato"><?php echo $prodotto["categoria"] == 'Vino' ? "Vino ".$prodotto["classificazione"] : "Spumante ".$prodotto["tenoreZuccherino"]; ?></p>
                    <p class="annata"><?php echo $prodotto["annata"]; ?></p>
                    <img src="./img/ratingStar-rev2.png" alt="voto: <?php echo $prodotto["mediaRecensioni"]; ?> su 5" />
                    <h6><?php echo $prodotto["prezzo"]; ?>€</h6>
                    <p><?php echo $prodotto["scorteMagazzino"] > 0 ? "Disponibile" : "Non Disponibile"; ?></p>
                </div>
            </div>
        </a><?php if($isClient): ?>
        <button class="preference <?php echo $prodotto["favorite"] ? "favourite" : "not-favourite"; ?>" name="preference" id="<?php echo $prodotto["idEtichetta"]."-".$prodotto["idContenitore"]."-".$userId; ?>"></button><?php endif; ?>
    </article>
<?php endforeach; ?>
</div>
