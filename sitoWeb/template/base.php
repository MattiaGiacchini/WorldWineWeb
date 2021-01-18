<?php
    $userRole = getUserRole();
    $username = getUserName();
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">

    <title><?php echo $templateParams["titoloScheda"]; ?></title>

    <script type="text/javascript" src="./js/jquery-1.11.3.min.js"> </script>
    <script type="text/javascript" src="./js/utils.js"></script>

    <?php
        if (isset($templateParams["jsAggiuntivi"])) {
            echo $templateParams["jsAggiuntivi"];
        }
        if (isset($templateParams["cssAggiuntivi"])) {
            echo $templateParams["cssAggiuntivi"];
        }
    ?>

    <link rel="stylesheet" type="text/css" href="./css/basicStyle.css">
    <link rel="stylesheet" type="text/css" href="./css/productCard.css">
    <link rel="stylesheet" type="text/css" href="./css/tileStyle.css">
    <link rel="stylesheet" type="text/css" href="./css/formStyle.css">


    <link rel="shortcut icon" href="<?php echo UPLOAD_DIR; ?>/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo UPLOAD_DIR; ?>/favicon.ico" type="image/x-icon">

  </head>

  <body>
    <header>
        <button type="button" name="menu">≡</button>
        <a href="index.php"><h1>World Wine Web</h1></a>
    </header>
    <nav><?php if(isUserLoggedIn()) { ?>
        <section>
            <a href="areaPersonale.php">
                <h2>Benvenuto <?php echo getUserName(); ?></h2>
                <p><?php if(getUserRole() != "client") { echo $userRole; } ?></p>
                <img src="<?php echo getUserImgURL(getLoggedUserId()); ?>" alt="<?php echo $username; ?>" /> 
            </a>
        </section> <?php } ?>
        <ul>
            <li><a href="index.php">Home</a></li>

            <?php
                switch ($userRole) {
                    case 'client':
                        echo '<li><a href="cart.php">Carrello</a></li>';
                        echo '<li><a href="orders.php">Ordini</a></li>';
                        echo '<li><a href="personalArea.php">Area Personale</a></li>';
                        echo '<li><a href="logout.php">Logout</a></li>';
                        break;

                    case 'admin':
                        echo '<li><a href="labels.php">Listino etichette</a></li>';
                        echo '<li><a href="collaborators.php">Collaboratori</a></li>';
                        echo '<li><a href="personalArea.php">Area Personale</a></li>';
                        echo '<li><a href="logout.php">Logout</a></li>';

                    case 'collaborator':
                        echo '<li><a href="orders.php">Gestione Ordini</a></li>';
                        echo '<li><a href="warehouse.php">Magazzino</a></li>';
                        echo '<li><a href="personalArea.php">Area Personale</a></li>';
                        echo '<li><a href="logout.php">Logout</a></li>';
                        break;

                    default:
                        echo '<li><a href="login.php">Login</a></li>';
                        break;
                }
            ?>

        </ul>
    </nav>

    <main>
        <?php
            if(isset($templateParams["indirizzoPagina"])) {
                require($templateParams["indirizzoPagina"]);
            }
         ?>
    </main>

    <footer></footer>
  </body>
</html>
