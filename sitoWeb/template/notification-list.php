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
                    <input type="radio" name="ordine" value="crescente" id="crescente"/>
                    <label for="crescente"> Crescente </label>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <legend>Stato notifiche</legend>
            <ul>
                <li>
                    <input type="checkbox" name="daLeggere" value="true" id="daLeggere" />
                    <label for="daLeggere"> Da leggere </label>
                </li>
                <li>
                    <input type="checkbox" name="lette" value="true" id="lette" />
                    <label for="lette"> Già lette </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="applica filtri">
    </form>
</div>

<div class="mainContent notice">

    <?php if (count($templateParams["notifiche"]) == 0): ?>
        <article>
            <p>Nessuna notifica trovata</p>
        </article>
    <?php else: {
        foreach ($templateParams["notifiche"] as $notification): ?>

            <div class="tile notice <?php if ($notification["visualizzato"] == 1) {echo " deactivated";} ?>">
                <div class="tileContent">
                    <h3><?php echo $notification["categoria"]; ?></h3>
                    <?php if ($notification["visualizzato"] == 0) { ?>
                        <button type="button" id="<?php echo $notification["idNotifica"]; ?>" name="<?php echo "notifica".$notification["idNotifica"]; ?>">segna come letto</button>
                    <?php } ?>

                    <p><?php echo $notification["data"]; ?></p>
                    <p><?php echo $notification["messaggio"]; ?></p>
                </div>
            </div>

        <?php endforeach; ?>

    <?php } endif; ?>

</div>
