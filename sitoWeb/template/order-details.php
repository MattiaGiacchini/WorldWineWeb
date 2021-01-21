<div class="utilityBar">
    <div class="titleBar"><h2><?php echo $templateParams["titoloPagina"]; ?></h2></div>
</div>
<?php
    $orderDetail = $templateParams["orderDetails"];
    $userData = $templateParams["userData"];
?>
<div class="mainContent">
    <section class="orderData">
        <h3>Dettagli ordine</h3>
        <article class="tile etichetta">
            <div class="tileContent">
                <h3><?php echo $orderDetail["data"]; ?></h3>
                <h4><?php echo $orderDetail["statoDiAvanzamento"]; ?></h4>
                <p><?php  ?></p>
                <div class="tileFooter">
                    <p class="tileImportantInfo">#<?php printf("%05d", $orderDetail["idOrdine"]); ?></p>
                </div>
            </div>
        </article>
        <div class="orderDetails">

            <?php if (count($templateParams["orderProductsDetails"]) == 0): ?>
                <article>
                    <p>Ordine errato</p>
                </article>
            <?php else: { ?>
                <?php $orderValueNoIVA = 0; ?>
                <table class="orderProducts">
                <caption>Riepilogo dell'ordine</caption>
                <thead>
                    <tr>
                        <th id="prod" scope"col">Prodotto</th>
                        <th id="desc" scope="col">Descrizione</th>
                        <th id="qty" scope="col">Qtà</th>
                        <th id="price" scope="col">Prezzo €</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($templateParams["orderProductsDetails"] as $detail): ?>
                    <?php $orderValueNoIVA = $orderValueNoIVA + ($detail["prezzo"] * $detail["quantita"]); ?>
                    <tr>
                        <td headers="prod" scope><?php echo $detail["idEtichetta"] . "." . $detail["idContenitore"]; ?></td>
                        <td headers="desc"><?php echo $detail["nomeVino"] . " - " . $detail["nomeCantina"]; ?></td>
                        <td headers="qty"><?php echo $detail["quantita"]; ?></td>
                        <td headers="price"><?php echo number_format((float) $detail["prezzo"], 2, '.', ''); ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th id="subTot" colspan="3" scope="row">Subtotale €</th>
                        <td headers="subTot price"><?php echo number_format((float) $orderValueNoIVA, 2, '.', ''); ?></td>
                    </tr>
                    <tr>
                        <th id="IVA" colspan="3" scope="row">IVA €</th>
                        <td headers="IVA price"><?php echo number_format((float)($templateParams["orderValue"] - $orderValueNoIVA), 2, '.', ''); ?></td>
                    </tr>
                    <tr>
                        <th id="tot" colspan="3" scope="row">Totale Complessivo €</th>
                        <td headers="tot price"> <?php echo number_format((float) $templateParams["orderValue"], 2, '.', ''); ?></td>
                    </tr>
                </tfoot>
            </table>
            <?php } endif; ?>
        </div>
    </section>

    <section class="clientData">
        <h3>Dati del cliente</h3>
        <article class="tile etichetta">
            <div class="tileContent">
                <h3>
                    <?php
                        if (!is_null($userData["ragioneSociale"])) {
                            echo $userData["ragioneSociale"];
                        } else {
                            echo $userData["cognome"] . " " . $userData["nome"];
                        }
                     ?>
                </h3>
                <h4>
                    <?php
                        if (!is_null($userData["partitaIva"])) {
                            echo "P. IVA: " . $userData["partitaIva"];
                        } else {
                            echo "CF: " . $userData["cf"];
                        }
                     ?>
                 </h4>
                <p><?php echo $userData["email"]; ?></p>
            </div>
        </article>
        <article class="tile etichetta">
            <div class="tileContent">
                <h3><?php echo "Via ". $orderDetail["spedizioneVia"] . ", " . $orderDetail["spedizioneCivico"]; ?></h3>
                <h4><?php echo $orderDetail["spedizioneCitta"]; ?></h4>
                <p><?php echo $orderDetail["spedizioneNome"]; ?></p>
                <div class="tileFooter">
                    <p class="tileImportantInfo"><?php echo $orderDetail["spedizioneCap"]; ?></p>
                </div>
            </div>
        </article>
        <article class="tile etichetta">
            <div class="tileContent">
                <h3><?php echo $orderDetail["pagamentoNumeroCarta"]; ?></h3>
                <h4><?php echo substr($orderDetail["pagamentoScadenza"], 0, 7); ?></h4>
                <p><?php echo $orderDetail["pagamentoIntestatario"]; ?></p>
                <div class="tileFooter">
                    <p class="tileImportantInfo"><?php echo $orderDetail["pagamentoTipologiaCarta"]; ?></p>
                </div>
            </div>
        </article>
        <form class="orderManagementButtons" id="orderManagementButtons" action="single-order.php?<?php echo "ordine=" . $orderDetail["idOrdine"]; ?>" method="post">
            <?php
                if (getUserRole() === "client") {
                    if ($orderDetail["statoDiAvanzamento"] == ORDER_STATUS[0]) {
                        echo '<input type="submit" name="statoDiAvanzamento" value="annulla ordine"/>';
                    }
                }else {
                    switch ($orderDetail["statoDiAvanzamento"]) {
                        case ORDER_STATUS[0]:
                            echo '<input type="submit" name="statoDiAvanzamento" value="accetta"/>';
                            echo '<input type="submit" name="statoDiAvanzamento" value="annulla ordine"/>';
                            break;
                        case  ORDER_STATUS[1]:
                            echo '<input type="submit" name="statoDiAvanzamento" value="spedisci"/>';
                            break;
                        case  ORDER_STATUS[2]:
                            echo '<input type="submit" name="statoDiAvanzamento" value="consegnato"/>';
                            break;
                        default:
                            break;
                    }
                }

                if ($orderDetail["statoDiAvanzamento"] != ORDER_STATUS[-1]) {
                    echo '<button type="button" class="print" onclick="window.print()" name="print">Stampa fattura</button>';
                }
            ?>
        </form>
    </section>
</div>
