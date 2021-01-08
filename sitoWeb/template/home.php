<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>

        <button type="button" name="filters" id="filterDropdown">Filtri &#9660;</button>
    </div>
    <form class="filter" action="index.html" method="post">
        <fieldset>
            <legend>Macrocategoria</legend>
            <ul>
                <li>
                    <input type="checkbox" name="categoria1" value="vino" id="filterVino"/>
                    <label for="filterVino"> Vino </label>
                </li>
                <li>
                    <input type="checkbox" name="categoria2" value="spumante" id="filterSpumante"/>
                    <label for="filterSpumante"> Spumante </label>
                </li>
            </ul>
        </fieldset>
            
        <fieldset>
            <legend>Colore</legend>
            <ul>
                <li>
                    <input type="checkbox" name="colore1" value="rosso" id="filterRed"/>
                    <label for="filterRed"> Rosso </label>
                </li>
                <li>
                    <input type="checkbox" name="colore2" value="bianco" id="filterWhite"/>
                    <label for="filterWhite"> Bianco </label>
                </li>
            </ul>
        </fieldset>
        
        <fieldset>
            <legend>Gas</legend>
            <ul>
                <li>
                    <input type="checkbox" name="gas1" value="fermo" id="filterFermo"/>
                    <label for="filterFermo"> Fermo </label>
                </li>
                <li>
                    <input type="checkbox" name="gas2" value="frizzante" id="filterFrizzante"/>
                    <label for="filterFrizzante"> Frizzante </label>
                </li>
            </ul>
        </fieldset>
    
        <fieldset>
            <legend>Tenore zuccherino</legend>
            <ul>
                <li>
                    <input type="checkbox" name="sugar1" value="dry" id="filterDry"/>
                    <label for="filterDry"> Dry </label>
                </li>
                <li>
                    <input type="checkbox" name="sugar2" value="extraDry" id="filterExtraDry"/>
                    <label for="filterExtraDry"> Extra Dry </label>
                </li>
            </ul>
        </fieldset>
        
        <fieldset>
            <legend>Cantina</legend>
            <ul>
                <li>
                    <input type="checkbox" name="cantina1" value="ginopino" id="filterGinopino"/>
                    <label for="filterGinopino"> Gino Pino </label>
                </li>
            </ul>
        </fieldset>
        
        <input type="submit" name="applyFilters" id="applyFilters" value="Applica filtri">
    </form>
</div>

<div class="article-container">

    <article class="wineCard">
        <a href="#">
            <div class="wineCard-Container">
                <img class="fotoVino" src="../upload/idVino/vino.png" alt="foto vino rosso" />
                <div class="etichetta">
                    <h3>Labrusco di Modena</h3>
                    <h4>BotteBuona</h4>
                    <div class="LiterVol">
                        <h5>0,75L</h5> <h5>15,0% Vol</h5>
                    </div>
                    <p class="origine">Rubicone - ITA</p>
                    <p class="certificato">D.O.C.G.</p>
                    <p class="annata">2019</p>
                    <img src="../img/ratingStar-rev2.png" alt="voto: 2 su 5" />
                    <h6>642,90€</h6>
                    <p>non disponibile</p>
                </div>
            </div>
        </a>
        <button class="preference favourite" name="preference favourite"></button>
    </article>

</div>
