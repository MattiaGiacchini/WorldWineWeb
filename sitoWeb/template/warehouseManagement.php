        <?php $product =$templateParams["product"]; ?>
        <div class="utilityBar">
            <div class="titleBar">
                <h2><?php echo $templateParams["titoloPagina"] ?></h2>
                <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
            </div>
            <form class="filter" action="index.html" method="post">
                <fieldset>
                    <legend>Ordine cronologico</legend>
                    <ul>
                        <li>
                            <input type="radio" name="ordine" value="crescente" id="crescente"/>
                            <label for="crescente"> Crescente </label>
                        </li>
                        <li>
                            <input type="radio" name="ordine" value="decrescente" id="decrescente" checked/>
                            <label for="decrescente"> Decrescente </label>
                        </li>
                    </ul>
                </fieldset>

                <input type="submit" name="applyFilters" id="applyFilters" value="Applica filtri">
            </form>
        </div>


        <article class="tile ">
            <img class="tileImg" src="<?php echo UPLOAD_DIR; ?>/idVino/pinotBianco.png" alt="vino">
            <div class="tileContent">
                <div class="tileBody">
                    <h3><?php echo $product["name"] ?></h3>
                    <h4><?php echo $product["producer"] ?></h4>
                    <p><?php echo $product["size"] ?>L</p>
                </div>
                <div class="tileFooter">
                    <p>Quantità: <?php echo $product["availability"]  ?> pezzi</p>
                    <p class="tileImportantInfo"><?php echo $product["price"] ?> €</p>
                </div>
            </div>
        </article>

        <section class="stockManagement">
            <h3>Gestione scorte</h3>
            <form class="warehouseStock" action="#" method="post">
                <ul>
                    <li>
                        <label for="amount">Quantità da aggiungere o rimuovere</label>
                        <input type="number" id="amount" name="amount" required step="1" />
                    </li>
                    <li id="loadDateTime">
                        <label for="currentdate">Data e ora</label>
                        <input type="datetime-local" id="currentdate" name="currentdate" />
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
                                <h4><?php echo $warehouseLoad["date"]; ?> - <?php echo $warehouseLoad["time"]; ?></h4>
                                <p><?php echo $warehouseLoad["description"]; ?></p>
                            </div>
                        </div>
                        <p><?php echo $warehouseLoad["amount"]; ?></p>
                    </article>

                <?php endforeach; ?>

            <?php } endif; ?>
            <?php $templateParams ?>








        </section>
