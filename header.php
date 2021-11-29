<!-- de inhoud van dit bestand wordt bovenaan elke pagina geplaatst -->
<?php
session_start();
include "database.php";
$databaseConnection = connectToDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NerdyGadgets</title>

    <!-- Javascript -->
    <script src="Public/JS/fontawesome.js"></script>
    <script src="Public/JS/jquery.min.js"></script>
    <!-- <script src="Public/JS/bootstrap.min.js"></script> -->
    <script src="Public/JS/popper.min.js"></script>
    <script src="Public/JS/resizer.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <!-- Style sheets-->
    <link rel="stylesheet" href="Public/CSS/style.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/typekit.css">
</head>
<body>
    
<div class="Background">
    
    <div class="row" id="Header">
        <div class="col-2"><a href="./" id="LogoA">
                <div id="LogoImage"></div>
            </a></div>
            <div class="dropdown my-auto ml-auto">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categorieën
                </button>
                <div class="primary dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php
                    $HeaderStockGroups = getHeaderStockGroups($databaseConnection);

                    foreach ($HeaderStockGroups as $HeaderStockGroup) {
                    ?>
                        <a href="browse.php?category_id=<?php print $HeaderStockGroup['StockGroupID']; ?>"
                        class="dropdown-item"><?php print $HeaderStockGroup['StockGroupName']; ?></a>
                    <?php
                    }
                    ?>
                    <a href="categories.php" class="dropdown-item">Alle categorieën</a>
                </div>
            </div>
            <div class="dropdown my-auto ml-4">
                <button style="color:white; font-size:17px; background: transparent; border: none !important;"class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg 
                
                style="width:42px; color: rgb(0, 132, 255); fill:currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
                
                <?php
                
                if(!isset($_SESSION['klant'])){
                    echo "Profiel";
                }
                else{
                    echo ($_SESSION['klant']['voornaam']);
                }
                ?>
                </button>
                <div class="primary dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    if(!isset($_SESSION['klant'])){

                    ?>
                    <a href="login.php" class="dropdown-item">Login</a>
                    <a href="register.php" class="dropdown-item">Registreren</a>
                    <?php
                    }
                    else{
                        ?>
                    <a href="facturen.php" class="dropdown-item">Facturen</a>
                    <form method="post">
                    <button name="logout" class="dropdown-item">Log uit</button>
                    </form>

                        <?php
                    }
                    if(isset($_POST['logout'])){
                        session_destroy();
                    }
                    ?>

                </div>
            </div>
                <div class="my-auto ">
                <ul id="ul-class">
                
                <li>
                    <svg style="width:25px; color: #676EFF; fill:currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 2h16l-3 9H4a1 1 0 1 0 0 2h13v2H4a3 3 0 0 1 0-6h.33L3 5 2 2H0V0h3a1 1 0 0 1 1 1v1zm1 18a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                    
                    <a href="cart.php" class="HrefDecoration">Winkelmand</a>
                </li>
                
                
                 <li>
                <a href="browse.php" class="HrefDecoration"><i class="fas fa-search search"></i> Zoeken</a>
                 </li>
            </ul>
            </div>
        </div>
        <div class="col-11 d-flex" id="CategoriesBar">
        
<!-- code voor US3: zoeken -->

<ul id="ul-class-navigation">
           
        </ul>

<!-- einde code voor US3 zoeken -->
    </div>
    <div class="row" id="Content">
        <div class="col-12">
            <div id="SubContent">


