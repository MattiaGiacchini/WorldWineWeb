<div class="utilityBar">
    <div class="titleBar">
        <h2><?php echo $templateParams["titoloPagina"]; ?></h2>
    </div>
</div>
<form class="loginForm" action="#" method="POST">
    <ul>
        <?php
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
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
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
