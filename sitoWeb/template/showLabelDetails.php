<div class="utilityBar">
    <div class="titleBar">
        <h2>Dettaglio Prodotto</h2>
    </div>
</div>
<div class="details">
    <div class="left">

        <article class="wineCard">
            <a href="#">
                <div class="wineCard-Container">
                    <img class="fotoVino" src="<?php echo getWineImgURL($prodotto["idEtichetta"], $prodotto["idContenitore"]); ?>" alt="Foto <?php echo $prodotto["categoria"]." ".$prodotto["colore"]; ?>" />
                    <div class="etichetta">
                        <h3><?php echo $prodotto["nomeEtichetta"]; ?></h3>
                        <h4><?php echo $prodotto["nomeCantina"]; ?></h4>
                        <div class="LiterVol">
                            <h5><?php echo $prodotto["capacita"]; ?>L</h5> <h5><?php echo round($prodotto["titoloAlcolico"], 1); ?>% Vol</h5>
                        </div>
                        <p class="origine"><?php echo $prodotto["indicazioneGeografica"]!=null ? $prodotto["indicazioneGeografica"]." - " : ""; echo $prodotto["stato"] != null ? $prodotto["stato"] : "";?></p>
                        <p class="certificato"><?php echo $prodotto["classificazione"]; ?></p>
                        <p class="annata"><?php echo $prodotto["annata"]; ?></p>
                        <img src="../img/ratingStar-rev2.png" alt="voto: <?php echo $prodotto["mediaRecensioni"]; ?> su 5" />
                        <h6><?php echo $prodotto["prezzo"]; ?>€</h6>
                        <p><?php echo $prodotto["scorteMagazzino"] > 0 ? "Disponibile" : "Non Disponibile"; ?></p>
                    </div>
                </div>
            </a>
            <button class="preference favourite" name="preference favourite"></button>
        </article>

        <form class="quantityToOrder" action="#" method="post">
            <label for="qnt">Quantità da Ordinare</label>
            <input type="number" id="qnt" name="qnt" value="" min="0" step="1">
            <input type="submit" name="submit" value="aggiungi a carrello">
        </form>
    </div>
    <div class="right">
        <button>Descrizione Organolettica</button>
        <p>Colore rosso intenso con riflessi percorsi da un vivissimo viola; gusto dal tono frizzante con profumi di mora e frutta rossa matura. Sapore avvolgente con piacevole equilibrio dato dalla acidità profilante, dal tannino strutturante, dalla morbidezza omniavvolgente. Vino di moderata gradazione alcolica, di immediata piacevolezza espressiva.</p>
        <button>Caratteristiche</button>
        <div class="table">
            <table>
                <tr>
                  <th id="category">Categoria</th>
                  <td headers="category">Vino</td>
                </tr>
                <tr>
                  <th id="name">Nome</th>
                  <td headers="name">Lambrusco di Modena</td>
                </tr>
                <tr>
                  <th id="wineMaker">Cantina</th>
                  <td headers="wineMaker">BotteBuona</td>
                </tr>
                <tr>
                  <th id="year">Annata</th>
                  <td headers="year">2019</td>
                </tr>
                <tr>
                  <th id="certificate">Certificato</th>
                  <td headers="certificate">D.O.C.G.</td>
                </tr>
                <tr>
                  <th id="wineVariety">Vitigno</th>
                  <td headers="wineVariety">Lambrusco</td>
                </tr>
                <tr>
                  <th id="alcol">Alcol(%)</th>
                  <td headers="alcol">15.0</td>
                </tr>
                <tr>
                  <th id="typeContainer">Contenitore</th>
                  <td headers="typeContainer">Bottiglia di Vetro</td>
                </tr>
                <tr>
                  <th id="capacityContainer">Capienza(L)</th>
                  <td headers="capacityContainer">0,75</td>
                </tr>
                <tr>
                  <th id="maxTemperature">Temperatura Massima cui Servire (C°)</th>
                  <td headers="maxTemperature">18.0</td>
                </tr>
                <tr>
                  <th id="minTemperature">Temperatura Minima cui Servire (C°)</th>
                  <td headers="minTemperature">16.0</td>
                </tr>
                <tr>
                  <th id="combination">Abbinamenti Consigliati</th>
                  <td headers="combination">carne, pesce, antipasti, pesce, antipasti,carne, pesce, pesce, antipasti, pesce, antipasti,carne, pesce, pesce, antipasti, pesce, antipasti,carne, pesce, pesce, antipasti, pesce, antipasti,carne, pesce, antipasti </td>
                </tr>
            </table>
        </div>
        <button>Aggiungi Nuova Recensione</button>
        <form class="newReview" action="#" method="post">
            <ul>
                <li>
                    <label for="title">Titolo della Recensione</label>
                    <input type="text" id="title" name="title" value="" required>
                </li>
                <li>
                    <label for="vote">Voto da assegnargli (da 1 a 5 stelle)</label>
                    <input type="number" id="vote" name="vote" step="1" min="1" max="5" value="" required>
                </li>
                <li>
                    <label for="text">Testo della recensione</label>
                    <textarea name="text" id="text" maxlength="500" rows="10" required></textarea>
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma">
                </li>
            </ul>
        </form>
        <button>Recensioni dei Clienti</button>
        <ul>
            <li>
                <article class="review">
                    <img src="../img/ratingStar-rev2.png" alt="voto: 1 su 5">
                    <h4>Titolo Recensione</h4>
                    <h5>09/10/2022 - utentexyz</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </article>
            </li>
            <li>
                <article class="review">
                    <img src="../img/ratingStar-rev2.png" alt="voto: 2.5 su 5">
                    <h4>Titolo Recensione</h4>
                    <h5>09/10/2022 - utentexyz</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </article>
            </li>
            <li>
                <article class="review">
                    <img src="../img/ratingStar-rev2.png" alt="voto: 4.75 su 5">
                    <h4>Titolo Recensione</h4>
                    <h5>09/10/2022 - utentexyz</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </article>
            </li>
            <li>
                <article class="review">
                    <img src="../img/ratingStar-rev2.png" alt="voto: 5 su 5">
                    <h4>Titolo Recensione</h4>
                    <h5>09/10/2022 - utentexyz</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </article>
            </li>
            <li>
                <article class="review">
                    <img src="../img/ratingStar-rev2.png" alt="voto: 3 su 5">
                    <h4>Titolo Recensione</h4>
                    <h5>09/10/2022 - utentexyz</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </article>
            </li>
            <li>
                <article class="review">
                    <img src="../img/ratingStar-rev2.png" alt="voto: 1 su 5">
                    <h4>Titolo Recensione</h4>
                    <h5>09/10/2022 - utentexyz</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </article>
            </li>
        </ul>
    </div>
</div>
