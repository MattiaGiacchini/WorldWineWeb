<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
        <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
    </div>
    <form class="filter" action="#" method="get">
        <fieldset>
            <legend>Ordine cronologico</legend>
            <ul>
                <li>
                    <input type="radio" name="ordine" value="decrescente" id="decrescente" checked/>
                    <label for="decrescente"> Decrescente </label>
                </li>
                <li>
                    <input type="radio" name="ordine" value="crescente" id="crescente" />
                    <label for="crescente"> Crescente </label>
                </li>
            </ul>
        </fieldset>
        <fieldset>
            <legend>Stato ordini</legend>
            <ul>
                <li>
                    <input type="checkbox" name="accettazione" value="true" id="waiting" checked/>
                    <label for="waiting"> Da accettare </label>
                </li>
                <li>
                    <input type="checkbox" name="approvato" value="true" id="approved" checked/>
                    <label for="approved"> Approvati </label>
                </li>
                <li>
                    <input type="checkbox" name="elaborazione" value="true" id="processing" checked />
                    <label for="processing"> In elaborazione </label>
                </li>
                <li>
                    <input type="checkbox" name="spedito" value="true" id="shipped" checked/>
                    <label for="shipped"> Spediti </label>
                </li>
                <li>
                    <input type="checkbox" name="consegnato" value="true" id="delivered" checked/>
                    <label for="delivered"> Consegnati </label>
                </li>
                <li>
                    <input type="checkbox" name="annullato" value="true" id="rejected" checked/>
                    <label for="rejected"> Rifiutati </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="applica filtri">
    </form>
</div>


<div class="mainContent">

    <?php if (count($templateParams["orders"]) == 0): ?>
        <article>
            <p>Nessun ordine trovato</p>
        </article>
    <?php else: {
        foreach ($templateParams["orders"] as $orders): ?>

            <a class="tileLink" href=<?php echo "order-management.php?ordine=" . $orders["idOrdine"]; ?>>
                <article class="tile etichetta <?php if ($orders["statoDiAvanzamento"] === "annullato") echo "deactivated"; ?>">
                    <div class="tileContent">
                        <h3><?php echo $orders["data"]; ?></h3>
                        <h4>€ <?php echo $orders["totaleOrdine"]; ?></h4>
                        <p><?php echo $orders["statoDiAvanzamento"]; ?></p>

                        <div class="tileFooter">
                            <p class="tileImportantInfo"># <?php printf("%05d", $orders["idOrdine"]); ?></p>
                        </div>
                    </div>
                </article>
            </a>

        <?php endforeach; ?>

    <?php } endif; ?>


</div>
