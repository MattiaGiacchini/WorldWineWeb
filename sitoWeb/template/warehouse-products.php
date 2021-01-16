<div class="utilityBar">
    <div class="titleBar">
        <h2>Magazzino</h2>
        <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
    </div>
    <form class="filter" action="index.html" method="post">
        <fieldset>
            <legend>Ordine alfabetico</legend>
            <ul>
                <li>
                    <input type="radio" name="ordine" value="decrescente" id="decrescente" checked/>
                    <label for="decrescente"> Decrescente </label>
                </li>
                <li>
                    <input type="radio" name="ordine" value="crescente" id="crescente"/>
                    <label for="crescente"> Crescente </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Stato prodotto</legend>
            <ul>
                <li>
                    <input type="checkbox" name="stato" value="active" id="active" checked/>
                    <label for="active"> Attivi </label>
                </li>
                <li>
                    <input type="checkbox" name="stato" value="deactivated" id="deactivated" checked />
                    <label for="deactivated"> Disattivati </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="Applica filtri">
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
                $idEtichetta = $products["idEtichetta"];
                $idContenitore = $products["idContenitore"];
                $imgURL = getImgURL($idEtichetta, $idContenitore);
            ?>
            <a class="tileLink" href=<?php echo "warehouse-management.php?etichetta=" . $idEtichetta . "&contenitore=" . $idContenitore; ?>>
                <article class="tile ">
                    <img class="tileImg" src=<?php echo WINE_PHOTO_DIR . $imgURL ; ?> alt="vino">
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
