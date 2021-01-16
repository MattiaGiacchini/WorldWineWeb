        <?php
            $product = $templateParams["product"];
            $idEtichetta = $_GET["etichetta"];
            $idContenitore = $_GET["contenitore"];
            $imgURL = getImgURL($idEtichetta, $idContenitore);
        ?>
        <div class="utilityBar">
            <div class="titleBar">
                <h2><?php echo $templateParams["titoloPagina"] ?></h2>
                <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
            </div>
            <form class="filter" action="#" method="get">
                <fieldset>
                    <legend>Ordine cronologico</legend>
                    <ul>
                        <li>
                            <input type="radio" name="ordine" value="decrescente" id="decrescente" checked>
                            <label for="decrescente"> Decrescente </label>
                        </li>
                        <li>
                            <input type="radio" name="ordine" value="crescente" id="crescente"/>
                            <label for="crescente"> Crescente </label>
                        </li>
                    </ul>
                </fieldset>

                <input type="hidden" name="etichetta" value="<?php echo $idEtichetta ?>">
                <input type="hidden" name="contenitore" value="<?php echo $idContenitore ?>">

                <input type="submit" name="applyFilters" id="applyFilters" value="applica filtri">
            </form>
        </div>

        <article class="tile ">
            <img class="tileImg" src="<?php echo WINE_PHOTO_DIR . $imgURL ; ?>" alt="vino">
            <div class="tileContent">
                <div class="tileBody">
                    <h3><?php echo $product[0]["NomeVino"] ?></h3>
                    <h4><?php echo $product[0]["NomeCantina"] ?></h4>
                    <p><?php echo $product[0]["capacita"] ?>L</p>
                </div>
                <div class="tileFooter">
                    <p>Quantità: <?php echo $product[0]["scorteMagazzino"] ?> pezzi</p>
                    <p class="tileImportantInfo"><?php echo $product[0]["prezzo"] ?> €</p>
                </div>
            </div>
        </article>

        <section class="stockManagement">
            <h3>Gestione scorte</h3>
            <form class="warehouseStock" action="#" method="post">
                <ul>
                    <li>
                        <label for="amount">Quantità da aggiungere o rimuovere</label>
                        <input type="number" id="amount" name="amount" required step="1" autofocus/>
                    </li>
                    <li>
                        <input type="submit" name="submit" value="Aggiungi">
                    </li>
                </ul>
            </form>
        </section>

        <section class="warehouseMovements">
            <h3>Movimenti magazzino</h3>

            <?php if (count($templateParams["warehouseMovements"]) == 0): ?>
                <article>
                    <p>Nessun movimento a magazzino trovato</p>
                </article>
            <?php else: {
                foreach ($templateParams["warehouseMovements"] as $warehouseLoad): ?>
                    <article class="tile magazzino">
                        <div class="tileContent">
                            <div class="tileBody">
                                <h4><?php echo $warehouseLoad["data"]; ?></h4>
                                <p><?php echo $warehouseLoad["nome"]; ?> <?php echo $warehouseLoad["cognome"] ?></p>
                            </div>
                        </div>
                        <p><?php echo $warehouseLoad["quantita"]; ?></p>
                    </article>

                <?php endforeach; ?>

            <?php } endif; ?>

        </section>
