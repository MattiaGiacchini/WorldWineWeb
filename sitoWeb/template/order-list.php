<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
        <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
    </div>
    <form class="filter" action="#" method="get">
        <fieldset>
            <legend>Ordine alfabetico</legend>
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
                    <input type="checkbox" name="approvato" value="true" id="approved" />
                    <label for="approved"> Approvati </label>
                </li>
                <li>
                    <input type="checkbox" name="elaborazione" value="true" id="processing" />
                    <label for="processing"> In elaborazione </label>
                </li>
                <li>
                    <input type="checkbox" name="spedito" value="true" id="shipped" />
                    <label for="shipped"> Spediti </label>
                </li>
                <li>
                    <input type="checkbox" name="consegnato" value="true" id="delivered" />
                    <label for="delivered"> Consegnati </label>
                </li>
                <li>
                    <input type="checkbox" name="annullato" value="true" id="rejected" />
                    <label for="rejected"> Rifiutati </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="Applica filtri">
    </form>
</div>


<div class="mainContent">

    <?php if (count($templateParams["orders"]) == 0): ?>
        <article>
            <p>Nessun collaboratore trovato</p>
        </article>
    <?php else: {
        foreach ($templateParams["orders"] as $orders): ?>

            <a class="tileLink" href=<?php echo "user.php?utente=" .  $collaboratore["idUtente"]; ?>>
                <article class="tile collaboratore <?php if ($collaboratore["attivo"] == 0) echo "deactivated"; ?>">
                    <img class="tileImg" src="<?php echo $imgURL ; ?>" alt="<?php echo $collaboratore["cognome"] . " " . $collaboratore["nome"] ?>" />
                    <div class="tileContent">
                        <div class="tileBody">
                            <h3><?php echo $collaboratore["cognome"] . " " . $collaboratore["nome"]; ?></h3>
                            <p>ID <?php printf("%05d", $collaboratore["idUtente"]); ?></p>
                        </div>
                    </div>
                </article>
            </a>

        <?php endforeach; ?>

    <?php } endif; ?>

    <a class="tileLink" href="orderManagement.html">
        <article class="tile etichetta">
            <div class="tileContent">
                    <h3>26/01/2021</h3>
                    <h4>€ 126.24</h4>
                    <p>Consegnato</p>

                <div class="tileFooter">
                    <p class="tileImportantInfo">#47884</p>
                </div>
            </div>
        </article>
    </a>

</div>
