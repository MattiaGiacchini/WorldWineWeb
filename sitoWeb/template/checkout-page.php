<div class="utilityBar">
    <div class="titleBar"> <h2><?php echo $templateParams["titoloPagina"]; ?></h2> </div>
</div>


<div>
    <?php var_dump($_POST); ?>
    <?php

        var_dump( array_keys($_POST) );
     ?>
        <form name="checkoutForm" class="checkout" action="index.html" method="post">
            <section class="riepilogoOrdine">
                <h3>Riepilogo ordine</h3>
                <article class="tile riepilogo">
                    <div class="tileContent">
                        <div class="tileBody">
                            <h4>Totale ordine</h4>
                            <p id="cartValue">120,00 €</p>
                        </div>
                    </div>
                </article>
                <ul>
                    <li>Pinot Biano - 6pz - 25.00 €</li>
                    <li>Pinot Grigio - 2pz - 25.00 €</li>
                    <li>Pinot Nero - 1pz - 25.00 €</li>
                    <li>Sangiovese - 7pz - 25.00 €</li>
                    <li>Trebbiano - 24pz - 25.00 €</li>
                    <li>Chardonnay - 8pz - 25.00 €</li>
                </ul>

            </section>
            <ul class="address">
                <li>
                    <label for="shippingAddress">Indirizzo di spedizione</label>
                    <select name="shippingAddress" id="shippingAddress" required>
                        <option value="">Seleziona indirizzo</option>
                        <option value="new">Aggiungi nuovo indirizzo</option>
                        <optgroup label="Indirizzi salvati">
                            <option value="address1">Via Bolsena, 11</option>
                            <option value="address2">Via Caduti per la Libertà, 206</option>
                        </optgroup>
                    </select>
                </li>
                <li>
                    <label for="firstname">Nome</label>
                    <input type="text" id="firstname" name="firstname" required readonly />
                </li>
                <li>
                    <label for="lastname">Cognome</label>
                    <input type="text" id="lastname" name="lastname" required readonly />
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
                    <label for="province">Provincia</label>
                    <input type="text" id="province" name="province" required readonly />
                </li>
                <li>
                    <label for="state">Stato</label>
                    <input type="text" id="state" name="state" required readonly />
                </li>
                <li>
                    <label for="zip">Codice postale</label>
                    <input type="number" id="zip" name="zip" min="00001" max="99999" required readonly />
                </li>
            </ul>
            <ul class="payment">
                <li>
                    <label for="payment">Metodo di pagamento</label>
                    <select name="payment" id="payment" required>
                        <option value="">Seleziona metodo</option>
                        <option value="new">Aggiungi nuovo metodo di pagamento</option>
                        <optgroup label="Metodi salvati">
                            <option value="pay1">**** **** **** *457</option>
                            <option value="pay2">**** **** **** *716</option>
                            <option value="pay3">**** **** **** *124</option>
                        </optgroup>
                    </select>
                </li>
                <li>
                    <label for="cardname">Intestatario</label>
                    <input type="text" id="cardname" name="cardname" required readonly />
                </li>
                <li>
                    <label for="cardTipology">Tipologia carta</label>
                    <select name="cardTipology" id="cardTipology" required>
                        <option value="">Seleziona tipologia</option>
                        <option value="visa">VISA</option>
                        <option value="vpay">V-PAY</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="maestro">Maestro</option>
                    </select>
                </li>
                <li>
                    <label for="cardnumber">Numero della carta</label>
                    <input type="text" id="cardnumber" name="cardnumber" required readonly />
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
