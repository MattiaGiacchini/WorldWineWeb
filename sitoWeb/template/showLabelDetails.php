<div class="utilityBar">
    <div class="titleBar">
        <h2>Dettaglio Prodotto</h2>
    </div>
</div>
<div class="details">
    <div class="left">

        <article class="wineCard">
                <div class="wineCard-Container">
                    <img class="fotoVino" src="<?php echo getWineImgURL($prodotto["idEtichetta"], $prodotto["idContenitore"]); ?>" alt="Foto <?php echo $prodotto["categoria"]." ".$prodotto["colore"]; ?>" />
                    <div class="etichetta <?php echo $prodotto["colore"]; ?>">
                        <h3><?php echo $prodotto["nomeEtichetta"]; ?></h3>
                        <h4><?php echo $prodotto["nomeCantina"]; ?></h4>
                        <div class="LiterVol">
                            <h5><?php echo round($prodotto["capacita"], 3); ?>L</h5> <h5><?php echo round($prodotto["titoloAlcolico"], 1); ?>% Vol</h5>
                        </div>
                        <p class="origine"><?php echo $prodotto["indicazioneGeografica"]!=null ? $prodotto["indicazioneGeografica"]." - " : ""; echo $prodotto["stato"] != null ? $prodotto["stato"] : "";?></p>
                        <p class="certificato"><?php echo $prodotto["categoria"] == 'Vino' ? "Vino ".$prodotto["classificazione"] : "Spumante ".$prodotto["tenoreZuccherino"]; ; ?></p>
                        <p class="annata"><?php echo $prodotto["annata"]; ?></p>
                        <img src="./img/ratingStar-rev2.png" alt="voto: <?php echo $prodotto["mediaRecensioni"]; ?> su 5" />
                        <h6><?php echo $prodotto["prezzo"]; ?>€</h6>
                        <p><?php echo $prodotto["scorteMagazzino"] > 0 ? "Disponibile" : "Non Disponibile"; ?></p>
                    </div>
                </div><?php if($isClient): ?>
            <button class="preference  <?php echo $favouriteClass; ?>" name="preference" id="<?php echo $prodotto["idEtichetta"]."-".$prodotto["idContenitore"]."-".getLoggedUserId(); ?>"></button><?php endif; ?>
        </article>
        <?php if($isClient): ?>
        <form class="quantityToOrder" action="insertUpdateCartElement.php" method="post">
            <input type="hidden" name="idLabel" value="<?php echo $prodotto["idEtichetta"]; ?>">
            <input type="hidden" name="idContainer" value="<?php echo $prodotto["idContenitore"]; ?>">
            <input type="hidden" name="idUser" value="<?php echo getLoggedUserId(); ?>">
            <label for="qnt">Quantità da Ordinare</label>
            <input type="number" id="qnt" name="qnt" value="<?php if($cartElement != 0) { echo "1";}?>" min="0" max="<?php echo $cartElement; ?>" >
            <input type="submit" name="submit" value="aggiungi a carrello">
        </form><?php endif; ?>
    </div>
    <div class="right">
        <button>Descrizione Organolettica</button>
        <p><?php echo $prodotto["descrizione"] ?></p>
        <button>Caratteristiche</button>
        <div class="table">
            <table>
                <tr>
                  <th id="category">Categoria</th>
                  <td headers="category"><?php echo $prodotto["categoria"]; ?></td>
                </tr>
                <tr>
                  <th id="name">Nome</th>
                  <td headers="name"><?php echo $prodotto["nomeEtichetta"]; ?></td>
                </tr>
                <tr>
                  <th id="sugar">Tenore Zuccherino</th>
                  <td headers="sugar"><?php echo $prodotto["tenoreZuccherino"]; ?></td>
                </tr>
                <tr>
                  <th id="wineMaker">Cantina</th>
                  <td headers="wineMaker"><?php echo $prodotto["nomeCantina"]; ?></td>
                </tr><?php if($prodotto["annata"]): ?>
                <tr>
                  <th id="year">Annata</th>
                  <td headers="year"><?php echo $prodotto["annata"]; ?></td>
                </tr><?php endif; if($prodotto["classificazione"]): ?>
                <tr>
                  <th id="certificate">Certificato</th>
                  <td headers="certificate"><?php echo $prodotto["classificazione"]; ?></td>
                </tr><?php endif;  if($prodotto["nomeSpecie"]):?>
                <tr>
                  <th id="wineVariety">Vitigno</th>
                  <td headers="wineVariety"><?php echo $prodotto["nomeSpecie"]; ?></td>
                </tr><?php endif; ?>
                <tr>
                  <th id="alcol">Alcol(%)</th>
                  <td headers="alcol"><?php echo $prodotto["titoloAlcolico"]; ?>%</td>
                </tr>
                <tr>
                  <th id="typeContainer">Contenitore</th>
                  <td headers="typeContainer"><?php echo $prodotto["tipologia"]; ?></td>
                </tr>
                <tr>
                  <th id="capacityContainer">Capienza(L)</th>
                  <td headers="capacityContainer"><?php echo $prodotto["capacita"]; ?></td>
                </tr>
                <tr>
                  <th id="maxTemperature">Temperatura Massima cui Servire (C°)</th>
                  <td headers="maxTemperature"><?php echo $prodotto["tMax"] != null ? $prodotto["tMax"] : "Sconosciuta"; ?></td>
                </tr>
                <tr>
                  <th id="minTemperature">Temperatura Minima cui Servire (C°)</th>
                  <td headers="minTemperature"><?php echo $prodotto["tMin"] != null ? $prodotto["tMin"] : "Sconosciuta"; ?></td>
                </tr>
            </table>
        </div>
        <?php if($isClient): ?>
        <button><?php echo $myReview ? "Aggiorna la Tua Recensione" : "Aggiungi Nuova Recensione"; ?></button>
        <form class="newReview" action="addUpdateNewReview.php" method="POST">
            <ul>
                <li>
                    <input type="hidden" name="idLabel" value="<?php echo $prodotto["idEtichetta"]; ?>">
                    <input type="hidden" name="idContainer" value="<?php echo $prodotto["idContenitore"]; ?>">
                    <input type="hidden" name="idUser" value="<?php echo getLoggedUserId(); ?>">
                    <label for="title">Titolo della Recensione</label>
                    <input type="text" id="title" name="title" value="<?php echo $myReview ? $myReview["titolo"] : ""; ?>" max="100" required>
                </li>
                <li>
                    <label for="vote">Voto da assegnargli (da 1 a 5 stelle)</label>
                    <input type="number" id="vote" name="vote" step="1" min="1" max="5" value="<?php echo $myReview ? $myReview["valutazione"] : ""; ?>" required>
                </li>
                <li>
                    <label for="text">Testo della recensione (Massimo 500 caratteri)</label>
                    <textarea name="text" id="text" maxlength="500" rows="10" required><?php echo $myReview ? $myReview["testo"] : ""; ?></textarea>
                </li>
                <li>
                    <input type="submit" name="submit" value="<?php echo $myReview ? "Aggiorna" : "Inserisci"; ?>">
                </li>
            </ul>
        </form>
    <?php endif; ?>
        <button>Recensioni dei Clienti</button>
        <ul><?php if($recensioni): foreach($recensioni as $recensione):?>
            <li>
                <article class="review">
                    <img src="./img/ratingStar-rev2.png" alt="voto: <?php echo $recensione["valutazione"]; ?> su 5">
                    <h4><?php echo $recensione["titolo"]; ?></h4>
                    <h5><?php echo $recensione["ragioneSociale"] ? $recensione["ragioneSociale"] : $recensione["nome"]." ".$recensione["cognome"]; ?></h5>
                    <p><?php  echo $recensione["testo"]; ?></p>
                </article>
            </li>
        <?php endforeach; else: ?>
            <li>recensioni non presenti al momento</li>
        <?php endif;  ?></ul>
    </div>
</div>
