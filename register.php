<?php
include __DIR__ . "/header.php"
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registreren</title>
</head>
<body>
    <?php
        $error = NULL;
        if (isset($_POST["submit"])) {
            $voornaam = $_POST["voornaam"];
            if ($_POST["tussenvoegsel"] == ""){
                $tussenvoegsel = NULL;
            } else {
                $tussenvoegsel = $_POST["tussenvoegsel"];
            }
            $achternaam = $_POST["achternaam"];
            $postcode = $_POST["postcode"];
            $huisnummer = $_POST["huisnummer"];
            $straatnaam = $_POST["straatnaam"];
            $woonplaats = $_POST["woonplaats"];
            $betaalmethode = $_POST["betaalmethode"];

            // controleer voor incorrecte inputs
            if (!preg_match("/^[a-zA-Z]*$/", ($voornaam . $tussenvoegsel . $achternaam))) {
                $error = "Naam is incorrect";
            }

            if (!preg_match("/^[0-9]{4}[a-zA-Z]{2}$/", $postcode)) {
                $error = "Postcode is incorrect";
            }

            if (!preg_match("/^[a-zA-Z]*$/", $straatnaam)) {
                $error = "Straatnaam is incorrect";
            }

            if (!preg_match("/^[a-zA-Z]*$/", $woonplaats)) {
                $error = "Woonplaats is incorrect";
            }

            if (empty($voornaam) || empty($achternaam) || empty($postcode) || empty($huisnummer) || empty($straatnaam) || empty($woonplaats) || empty($betaalmethode) || $betaalmethode === ""){
                $error = "Verplichte velden* zijn niet ingevuld!";
            }

            // voeg klant toe aan de database
        
            if ($error == NULL && !isset($_SESSION["username"])) {
                addCustomer($voornaam, $tussenvoegsel, $achternaam, $postcode, $huisnummer, $straatnaam, $woonplaats, $databaseConnection);
            }
            
        }
    ?>

    <div name="checkoutContainer" id="CenteredContent">
        <div class="checkout-header">
            <h1>Registreren</h1>
            <a href="cart.php">< Terug </a>
            <?php
                if ($error !== NULL){
                    echo('<p class="error">' . $error . '</p>');
                }
            ?>
        </div>

        <form method="POST">
        <?php
                //check if there's a user that is logged in
                if(!isset($_SESSION['klant']))
                {
                    ?>
            <div class="row">
           
                <div class="col-33">
                    <label for="voornaam">Voornaam *</label>
                    <input type="text" name="voornaam" id="voornaam" placeholder="Jan">
                </div>
                <div class="col-33">
                    <label for="tussenvoegsel">Tussenvoegsel</label>
                    <input type="text" name="tussenvoegsel" id="tussenvoegsel" placeholder="van">
                </div>
                <div class="col-33">
                    <label for="achternaam">Achternaam *</label>
                    <input type="text" name="achternaam" id="achternaam" placeholder="Bergen">
                </div>
            </div>

            <div class="row">
                <div class="col-50">
                    <label for="postcode">Postcode *</label>
                    <input type="text" name="postcode" id="postcode" placeholder="1234AB">
                </div>
                <div class="col-50">
                    <label for="huisnummer">Huisnummer *</label>
                    <input type="text" name="huisnummer" id="huisnummer" placeholder="123">
                </div>
            </div>

            <div class="row">
                <div class="col-100">
                    <label for="straatnaam">Straatnaam *</label>
                    <input type="text" name="straatnaam" id="straatnaam" placeholder="Sesamstraat">
                </div>
            </div>

            <div class="row">
                <div class="col-100">
                    <label for="woonplaats">Woonplaats *</label>
                    <input type="text" name="woonplaats" id="woonplaats" placeholder="Utrecht">
                </div>
            </div>
           
            <div id="accountform">
                <div class="row">
                    <div class="col-100">
                        <label for="email">Email *</label>
                        <input type="text" name="email" id="email" placeholder="email@example.com">
                    </div>
                </div>
                <div class="row">
                    <div class="col-100">
                        <label for="wachtwoord">Wachtwoord * </label>
                        <input type="password" name="wachtwoord" id="wachtwoord" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-100">
                        <label for="wachtwoordHerhalen">Wachtwoord herhalen* </label>
                        <input type="password" name="wachtwoordHerhalen" id="wachtwoordHerhalen" placeholder="">
                    </div>
                </div>
            </div>
            
            <?php
                }
            ?>
            
            <div class="close-line"></div>

            <div id="checkout-button-container">
                <input type="submit" name="submit" id="checkout-button" value="Registreren">
            </div>
        </form>
    </div>
</body>
</html>


