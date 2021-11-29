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
    <title>Bestellen</title>
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
            <h1>Bestellen</h1>
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
                if(!isset($_SESSION['username']))
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
           
            <div id="accountform" style=" display: none;">
                <div class="row">
                    <div class="col-100">
                        <label for="gebruikersnaam">Gebruikersnaam *: </label>
                        <input type="text" name="gebruikersnaam" id="gebruikersnaam" placeholder="JohnDoe123">
                    </div>
                </div>
                <div class="row">
                    <div class="col-100">
                        <label for="wachtwoord">Wachtwoord *: </label>
                        <input type="password" name="wachtwoord" id="wachtwoord" placeholder="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-100">
                    <button 
                    type="button"
                    onclick="revealUserPass(this)"
                    class="buyBtn p-2 rounded">Ik wil een account aanmaken</button>
                    <script>
                        function revealUserPass(btn){
                            var x = document.getElementById("accountform");
                            if (x.style.display === "none") {
                                x.style.display = "block";
                                btn.innerHTML = "Ik wil geen account aanmaken";
                            } else {
                                x.style.display = "none";
                                btn.innerHTML = "Ik wil een account aanmaken";
                            }
                        }
                    </script>
                </div>
               
            </div>
            <?php
                }
            ?>
            <div class="row">
                <div class="col-100 d-flex align-items-center ">
                    <svg version="1.1" height="50" width="50" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 306.1 269.8" style="enable-background:new 0 0 306.1 269.8;" xml:space="preserve"> <style type="text/css"> .st0{fill:#FFFFFF;} .st1{fill:#CC0066;} </style> <g> <g> <path class="st0" d="M0,20v229.8c0,11,9,20,20,20h137.3c103.8,0,148.8-58.1,148.8-135.2C306.1,57.9,261.1,0,157.3,0H20 C9,0,0,9,0,20z"/> <path class="st1" d="M91.9,56.4v169.8h73.9c67.1,0,96.2-37.9,96.2-91.5c0-51.3-29.1-91.1-96.2-91.1h-61.1 C97.6,43.6,91.9,49.4,91.9,56.4z"/> <g> <g> <path d="M157.3,251.5H37.9c-10.6,0-19.2-8.6-19.2-19.2V37.6c0-10.6,8.6-19.2,19.2-19.2h119.4c113.3,0,130.2,72.9,130.2,116.3 C287.5,210,241.2,251.5,157.3,251.5z M37.9,24.8c-7.1,0-12.8,5.7-12.8,12.8v194.7c0,7.1,5.7,12.8,12.8,12.8h119.4 c79.8,0,123.8-39.2,123.8-110.4c0-95.6-77.6-109.9-123.8-109.9H37.9z"/> </g> </g> </g> <g> <path class="st0" d="M117.9,111.8c2.6,0,5,0.4,7.3,1.2c2.3,0.8,4.2,2.1,5.9,3.7c1.6,1.7,2.9,3.8,3.9,6.2c0.9,2.5,1.4,5.4,1.4,8.8 c0,3-0.4,5.7-1.1,8.2c-0.8,2.5-1.9,4.7-3.4,6.5c-1.5,1.8-3.4,3.2-5.7,4.3c-2.3,1-5,1.6-8.1,1.6h-17.5v-40.6H117.9z M117.3,144.9 c1.3,0,2.5-0.2,3.8-0.6c1.2-0.4,2.3-1.1,3.2-2.1c0.9-1,1.7-2.2,2.3-3.8c0.6-1.6,0.9-3.4,0.9-5.7c0-2-0.2-3.9-0.6-5.5 c-0.4-1.6-1.1-3.1-2-4.2s-2.1-2.1-3.6-2.7c-1.5-0.6-3.3-0.9-5.5-0.9h-6.4v25.6H117.3z"/> <path class="st0" d="M172.5,111.8v7.5h-21.4v8.7h19.7v6.9h-19.7v9.9H173v7.5h-30.8v-40.6H172.5z"/> <path class="st0" d="M203.1,111.8l15.2,40.6H209l-3.1-9h-15.2l-3.2,9h-9l15.3-40.6H203.1z M203.6,136.7l-5.1-14.9h-0.1l-5.3,14.9 H203.6z"/> <path class="st0" d="M232.8,111.8v33.1h19.8v7.5h-28.7v-40.6H232.8z"/> </g> <g> <circle cx="58.5" cy="132.1" r="18.7"/> </g> <path d="M72.6,226.2L72.6,226.2c-15.7,0-28.3-12.7-28.3-28.3v-22.1c0-7.8,6.3-14.2,14.2-14.2h0c7.8,0,14.2,6.3,14.2,14.2V226.2z"/> </g> </svg>
                    <label class="betaalmethode-label" for="betaalmethode">IDEAL betalen: *</label>
                </div>
            </div>
            <div class="row">
                <div class="col-100">
                    <select name="betaalmethode" id="betaalmethode">
                    <option value="">Selecteer uw bank</option>
                    <option>ABN Amro</option>
                    <option>ASN Bank</option>
                    <option>Bunq</option>
                    <option>ING</option>
                    <option>KNAB</option>
                    <option>RaboBank</option>
                    <option>Regiobank</option>
                    <option>SNS</option>
                    <option>Triodos Bank</option>
                    <option>Van Lanschot</option>
                    </select>
                </div>
            
            </div>
            <div class="close-line"></div>

            <div id="checkout-button-container">
                <input type="submit" name="submit" id="checkout-button" value="Verder naar betaling">
            </div>
        </form>
    </div>
</body>
</html>


