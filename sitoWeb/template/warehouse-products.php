<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"] ?></h2>
        <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
    </div>
    <form class="filter" action="#" method="get">
        <fieldset>
            <legend>Ordine alfabetico</legend>
            <ul>
                <li>
                    <input type="radio" name="ordine" value="crescente" id="crescente" checked/>
                    <label for="crescente"> Crescente </label>
                </li>
                <li>
                    <input type="radio" name="ordine" value="decrescente" id="decrescente"/>
                    <label for="decrescente"> Decrescente </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Stato prodotto</legend>
            <ul>
                <li>
                    <input type="checkbox" name="attivo" value="true" id="active" checked/>
                    <label for="active"> Attivi </label>
                </li>
                <li>
                    <input type="checkbox" name="disattivato" value="true" id="deactivated" checked />
                    <label for="deactivated"> Disattivati </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="applica filtri">
    </form>
</div>



<div class="mainContent">

    <?php if (count($templateParams["warehouseProducts"]) == 0): ?>
        <article>
            <p>Nessun prodotto trovato</p>
        </article>
    <?php else: {
        foreach ($templateParams["warehouseProducts"] as $products): ?>

            <?php
                $imgURL = getWineImgURL($products["idEtichetta"], $products["idContenitore"]);
            ?>
            <a class="tileLink" href=<?php echo "warehouse-management.php?etichetta=" . $products["idEtichetta"] . "&contenitore=" . $products["idContenitore"]; ?>>
                <article class="tile <?php if ($products["attivo"] == 0) echo "deactivated"; ?>">
                    <img class="tileImg" src=<?php echo $imgURL ; ?> alt="vino">
                    <div class="tileContent">
                        <div class="tileBody">
                            <h3><?php echo $products["NomeVino"] ?></h3>
                            <h4><?php echo $products["NomeCantina"] ?></h4>
                            <p><?php echo $products["capacita"] ?>L</p>
                        </div>
                        <div class="tileFooter">
                            <p>Quantità: <?php echo $products["scorteMagazzino"] ?> pezzi</p>
                            <p class="tileImportantInfo"><?php echo $products["prezzo"] ?> €</p>
                        </div>
                    </div>
                </article>
            </a>


        <?php endforeach; ?>

    <?php } endif; ?>


</div>
