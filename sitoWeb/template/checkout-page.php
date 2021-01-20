<?php
    header ("Content-Type: text / html; charset = utf-8");
    $states = $dataBase->getStates();
?>
<div class="utilityBar">
    <div class="titleBar"> <h2><?php echo $templateParams["titoloPagina"]; ?></h2> </div>
</div>

<?php if(isset($_POST)) {var_dump($_POST);} ?>

<div>
    <form name="checkoutForm" class="checkout" action="checkout.php" method="post">
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

            <?php if (count($templateParams["cartProducts"]) == 0): ?>
                <article>
                    <p>Nessun prodotto nel carrello</p>
                </article>
            <?php else: {
                foreach ($templateParams["cartProducts"] as $product): ?>

                    <?php $imgURL = getWineImgURL($product["idEtichetta"], $product["idContenitore"]); ?>
                        <article class="tile prodotto checkout <?php if ($product["attivo"] == 0) echo "deactivated"; ?>">
                                <img class="tileImg" src=<?php echo $imgURL ; ?> alt="vino">
                            <div class="tileContent">
                                <div class="tileBody">
                                    <h3><?php echo $product["NomeVino"]; ?></h3>
                                    <p><?php echo $product["NomeCantina"]; ?></p>
                                    <p>€ <?php echo $product["prezzo"]; ?> - <?php echo $product["quantitaDefinitiva"]; ?> pezzi</p>
                                </div>
                            </div>
                        </article>
                <?php endforeach; ?>

            <?php } endif; ?>

        </section>

        <ul class="address">
            <li>
                <label for="shippingAddress">Indirizzo di spedizione</label>
                <select name="shippingAddress" id="shippingAddress" required>
                    <option value="">Seleziona indirizzo</option>
                    <option value="new">Aggiungi nuovo indirizzo</option>

                    <?php if (count($templateParams["addresses"]) > 0): {?>
                        <optgroup label="Indirizzi salvati">
                        <?php foreach ($templateParams["addresses"] as $address): ?>
                            <option value="<?php echo $address["idIndirizzo"]; ?>">Via <?php echo $address["via"] . ", " . $address["civico"]; ?></option>
                        <?php endforeach; ?>
                        </optgroup>
                    <?php } endif; ?>
                </select>
            </li>
            <li>
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" required readonly />
            </li>
            <li>
                <label for="adr">Via</label>
                <input type="text" id="adr" name="address" required readonly />
            </li>
            <li>
                <label for="civic">Civico</label>
                <input type="number" id="civic" name="civic" min="1" max="99999999" required readonly />
            </li>
            <li>
                <label for="city">Città</label>
                <input type="text" id="city" name="city" required readonly />
            </li>
            <li>
                <label for="zip">Codice postale</label>
                <input type="number" id="zip" name="zip" min="00001" max="99999" required readonly />
            </li>
            <li>
                <label for="province">Provincia</label>
                <input type="text" id="province" name="province" required readonly />
            </li>
            <li>
                <label for="state">Stato</label>
                <select class="state" name="state" id="state" required >
                    <option value="">Selezione stato</option>
                    <?php foreach ($states as $state) { ?>
                        <option value="<?php echo $state["sigla"]; ?>"><?php echo $state["nome"]; ?></option>
                    <?php } ?>
                </select>
            </li>
        </ul>
        <ul class="payment">
            <li>
                <label for="payment">Metodo di pagamento</label>
                <select name="payment" id="payment" required>
                    <option value="">Seleziona metodo</option>
                    <option value="new">Aggiungi nuovo metodo di pagamento</option>
                    <?php if (count($templateParams["payments"]) > 0): {?>
                        <optgroup label="Metodi salvati">
                        <?php foreach ($templateParams["payments"] as $payment): ?>
                            <option value="<?php echo $payment["numeroCarta"]; ?>"> <?php echo substr_replace($payment["numeroCarta"],"** **** **** ",2,10); ?></option>
                        <?php endforeach; ?>
                        </optgroup>
                    <?php } endif; ?>
                </select>
            </li>
            <li>
                <label for="cardname">Intestatario</label>
                <input type="text" id="cardname" name="cardname" required readonly />
            </li>
            <li>
                <label for="cardTipology">Tipologia carta</label>
                <select name="cardTipology" id="cardTipology" required >
                    <option value="">Seleziona tipologia</option>
                    <option value="VISA">VISA</option>
                    <option value="V-PAY">V-PAY</option>
                    <option value="Mastercard">Mastercard</option>
                    <option value="Maestro">Maestro</option>
                </select>
            </li>
            <li>
                <label for="cardnumber">Numero della carta</label>
                <input type="text" maxlength="16" id="cardnumber" name="cardnumber" required readonly />
            </li>
            <li>
                <label for="expiration">Scadenza</label>
                <input type="month" id="expiration" name="expiration" required readonly />
            </li>
            <li>
                <label for="cvv">CVV</label>
                <input type="number" id="cvv" name="cvv" min="001" max="999" required readonly />
            </li>

            <li>
                <input id="confirmOrder" type="submit" name="submit" value="Conferma" />
            </li>
        </ul>
    </form>

</div>
