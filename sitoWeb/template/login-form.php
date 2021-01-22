<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
    </div>
</div>
<form class="loginForm" action="#" method="POST">
    <ul>
        <?php
            if(isset($_SESSION["msg"])){
               unset($_SESSION["msg"]);
                ?>
        <li>
            <p>La registrazione è avvenuta con successo!</p>
        </li>
                <?php
            }

            if (isset($templateParams["errorelogin"])) {
                ?>
        <li>
            <p><?php echo $templateParams["errorelogin"]; ?></p>
        </li>
                <?php
            }
        ?>
        <li>
            <label for="email">E-mail</label> <input type="email" id="email" name="email"
                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required />
        </li>
        <li>
            <label for="psw">Password</label> <input type="Password" id="psw" name="psw" required />
        </li>
        <li>
            <input type="submit" name="submit" value="Login" />
        </li>
        <li>
            <p>Non hai un account? <a href="register.php"> Registrati </a></p>
        </li>
    </ul>
</form>
