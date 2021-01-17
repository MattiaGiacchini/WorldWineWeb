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
                    <input type="radio" name="ordine" value="crescente" id="crescente" checked />
                    <label for="crescente"> Crescente </label>
                </li>
                <li>
                    <input type="radio" name="ordine" value="decrescente" id="decrescente" />
                    <label for="decrescente"> Decrescente </label>
                </li>
            </ul>
        </fieldset>
        <fieldset>
            <legend>Stato collaboratore</legend>
            <ul>
                <li>
                    <input type="checkbox" name="attivo" value="true" id="active" checked />
                    <label for="active"> Attivi </label>
                </li>
                <li>
                    <input type="checkbox" name="disattivato" value="true" id="deactivated" checked />
                    <label for="deactivated"> Disattivati </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="applica filtri" />
    </form>
</div>


<button id="addNewColaborator" type="button" name="button">Nuovo collaboratore</button>


<div class="mainContent">

    <?php if (count($templateParams["collaborators"]) == 0): ?>
        <article>
            <p>Nessun collaboratore trovato</p>
        </article>
    <?php else: {
        foreach ($templateParams["collaborators"] as $collaboratore): ?>

            <?php $imgURL = getUserImgURL( $collaboratore["idUtente"]); ?>

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


</div>
