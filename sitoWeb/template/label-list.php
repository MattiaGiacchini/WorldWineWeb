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
                    <input type="radio" name="ordine" value="crescente" id="crescente" checked/>
                    <label for="crescente"> Crescente </label>
                </li>
                <li>
                    <input type="radio" name="ordine" value="decrescente" id="decrescente" />
                    <label for="decrescente"> Decrescente </label>
                </li>
            </ul>
        </fieldset>

        <input type="submit" name="applyFilters" id="applyFilters" value="applica filtri">
    </form>
</div>

<?php
    if(getUserRole() === "admin") {
        echo '<button id="addNewLabel" type="button" name="button">Nuova etichetta</button>';
    }
?>


<div class="mainContent">

    <?php if (count($templateParams["labels"]) == 0): ?>
        <article>
            <p>Nessuna etichetta trovata</p>
        </article>
    <?php else: {
        foreach ($templateParams["labels"] as $label): ?>

            <a class="tileLink" href=<?php echo "editProduct.php?idEtichetta=" . $label["idEtichetta"]; ?>>
                <article class="tile etichetta">
                    <div class="tileContent">
                        <h3><?php echo $label["vino"]; ?></h3>
                        <h4><?php echo $label["cantina"]; ?></h4>
                        <p>
                            <?php
                                if(!is_null($label["origine"])) {
                                    echo $label["origine"] . " - ";
                                }
                                echo $label["stato"];
                                if(!is_null($label["annata"])) {
                                    echo " - " . $label["annata"];
                                }
                            ?>
                        </p>
                        <div class="tileFooter">
                            <p class="tileImportantInfo"><?php echo "Vino " . $label["colore"]; ?></p>
                        </div>
                    </div>
                </article>
            </a>
        <?php endforeach; ?>

    <?php } endif; ?>



</div>
