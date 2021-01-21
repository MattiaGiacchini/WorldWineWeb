<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>

        <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
    </div>
    <form class="filter" action="index.html" method="post">
        <fieldset>
            <legend>Macrocategoria</legend>
            <ul>
                <li>
                    <input type="checkbox" name="categoria1" value="vino" id="filterVino"/>
                    <label for="filterVino"> Vino </label>
                </li>
                <li>
                    <input type="checkbox" name="categoria2" value="spumante" id="filterSpumante"/>
                    <label for="filterSpumante"> Spumante </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Colore</legend>
            <ul>
                <li>
                    <input type="checkbox" name="colore1" value="rosso" id="filterRed"/>
                    <label for="filterRed"> Rosso </label>
                </li>
                <li>
                    <input type="checkbox" name="colore2" value="bianco" id="filterWhite"/>
                    <label for="filterWhite"> Bianco </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Gas</legend>
            <ul>
                <li>
                    <input type="checkbox" name="gas1" value="fermo" id="filterFermo"/>
                    <label for="filterFermo"> Fermo </label>
                </li>
                <li>
                    <input type="checkbox" name="gas2" value="frizzante" id="filterFrizzante"/>
                    <label for="filterFrizzante"> Frizzante </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Tenore zuccherino</legend>
            <ul>
                <li>
                    <input type="checkbox" name="sugar1" value="dry" id="filterDry"/>
                    <label for="filterDry"> Dry </label>
                </li>
                <li>
                    <input type="checkbox" name="sugar2" value="extraDry" id="filterExtraDry"/>
                    <label for="filterExtraDry"> Extra Dry </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Cantina</legend>
            <ul>
                <li>
                    <input type="checkbox" name="cantina1" value="ginopino" id="filterGinopino"/>
                    <label for="filterGinopino"> Gino Pino </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="applica filtri">
    </form>
</div>

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
        </a>
        <button class="preference favourite" name="preference favourite"></button>
    </article>
<?php endforeach; ?>
</div>
