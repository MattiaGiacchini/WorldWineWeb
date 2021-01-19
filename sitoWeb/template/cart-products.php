<div class="utilityBar">
    <div class="titleBar"> <h2><?php echo $templateParams["titoloPagina"]; ?></h2> </div>
</div>

<form class="singleButtonForm" action="checkout.php" method="post">
<section class="articoli">
    <h3>Articoli</h3>


    <?php if (count($templateParams["cartProducts"]) == 0): ?>
        <article>
            <p>Nessun prodotto nel carrello</p>
        </article>
    <?php else: {
        foreach ($templateParams["cartProducts"] as $product): ?>

            <?php $imgURL = getWineImgURL($product["idEtichetta"], $product["idContenitore"]); ?>
                <article class="tile cart product <?php if ($product["attivo"] == 0) echo "deactivated"; ?>">
                    <a class="tileLink" href=<?php echo "warehouse-management.php?etichetta=" . $product["idEtichetta"] . "&contenitore=" . $product["idContenitore"]; ?>>
                        <img class="tileImg" src=<?php echo $imgURL ; ?> alt="vino">
                    </a>
                    <div class="tileContent">
                        <div class="tileBody">
                            <h3><?php echo $product["NomeVino"] ?></h3>
                            <h4><?php echo $product["NomeCantina"] ?></h4>
                            <p><?php echo $product["capacita"] ?>L</p>
                        </div>

                        <div class="tileFooter">
                            <div class="quantity">
                                <label for="<?php echo $product["idEtichetta"] ."_" . $product["idContenitore"]; ?>">Quantità</label>
                                <input class="quantityInput" id="<?php echo $product["idEtichetta"] . "_" . $product["idContenitore"]; ?>" type="number" name="<?php echo $product["idEtichetta"] ."_" . $product["idContenitore"]; ?>" max="<?php echo $product["scorteMagazzino"]; ?>" value="<?php echo $product["quantitaDefinitiva"] ?>">
                                <p> pezzi</p>
                            </div>
                            <p class="tileImportantInfo"><?php echo $product["prezzo"] ?> €</p>
                        </div>
                    </div>
                </article>


        <?php endforeach; ?>
</section>
<section class="riepilogoOrdine">
    <h3>Riepilogo ordine</h3>
    <article class="tile riepilogo">
        <div class="tileContent">
            <div class="tileBody">
                <h4>Totale ordine</h4>
                <p id="cartValue">€ <?php echo $templateParams["cartValue"]; ?></p>
            </div>
        </div>
    </article>


    <?php } endif; ?>
    <?php if (count($templateParams["cartProducts"]) > 0){
        echo '<input type="submit" name="checkout" value="checkout">';
    }?>

</form>

</section>
