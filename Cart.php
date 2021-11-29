<?php
include __DIR__ . "/header.php";
include "CartFuncties.php";
setlocale(LC_MONETARY,"'nl_NL'");

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
</head>
<body>

<?php

$cart = getCart();

//gegevens per artikelen in $cart (naam, prijs, etc.) uit database halen
?>
<div id="CenteredContent">
<h1>Winkelmand</h1>
<a href="javascript:history.go(-1)">< Terug </a>
<?php
if(isset($_SESSION['username'])){
    if($_SESSION['username']=='inkoper'){
        print("U krijgt 1 euro korting op alle artikelen, omdat u inkoper bent");
    }    
}

if(isset($_POST["up"])){
    $stockItemID = $_POST["stockItemID"];
    addProductToCart($stockItemID);
   // header("location: cart.php");
}

if(isset($_POST["down"])){
    $stockItemID = $_POST["stockItemID"];
    removeProductFromCart($stockItemID);
   // header("location: cart.php");
}

if(isset($_POST["verwijder"])){
    $stockItemID = $_POST["stockItemID"];
    deleteProductFromCart($stockItemID);
   // header("location: cart.php");
}

$cart = getCart();

foreach($cart as $key => $cartItem){
    $row = getStockItem($key,  $databaseConnection);
    $StockItemImage = getStockItemImage($key, $databaseConnection);
    if ($row != null && $cartItem > 0) {
    ?>

<!-- einde coderegel 1 van User story: bekijken producten   -->
    <div id="ProductFrame">
        <?php
        if (isset($row['ImagePath'])) { ?>
            <div class="ImgFrame"
                 style="background-image: url('<?php print "Public/StockItemIMG/" . $row['ImagePath']; ?>'); background-size: 230px; background-repeat: no-repeat; background-position: center;"></div>
        <?php } else if (isset($row['BackupImagePath'])) { ?>
            <div class="ImgFrame"
                 style="background-image: url('<?php print "Public/StockGroupIMG/" . $row['BackupImagePath'] ?>'); background-size: cover;"></div>
        <?php }
        ?>

        <div id="StockItemFrameRight">
            <?php
            if(isset($_SESSION['username'])){

                if($_SESSION['username'] == 'inkoper'){
                    ?>
                    <div class="CenterPriceLeftChild">
                            <p class="StockItemPriceText"> Prijs: <br> <b><?php print("€ ". number_format($row['SellPrice']*$cartItem-1, 2, ',', '.')); ?></b></p>
                            <h6> (Aantal * prijs per stuk) </h6>
                    </div>
                <?php
                }
                else{
                    ?>
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"> Prijs: <br> <b><?php print("€ ". number_format($row['SellPrice']*$cartItem, 2, ',', '.')); ?></b></p>
                        <h6> (Aantal * prijs per stuk) </h6>
                    </div>
                    <?php
                }
            }
            else{
                ?>
                <div class="CenterPriceLeftChild">
                        <form method="post">
                            <input type="number" name="stockItemID" value="<?php print($row["StockItemID"]); ?>" hidden>
                            <button 
                            type="submit"
                            name="verwijder"
                            title="Verwijderen uit winkelmand"
                            class="removeBtn">
                            <svg style="fill:currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg>
                            </button>
                        </form>
                        <p class="StockItemPriceText"> Prijs: <br> <b><?php print("€ ". number_format($row['SellPrice']*$cartItem, 2, ',', '.')); ?></b></p>
                        <h6> (Aantal * prijs per stuk) </h6>
                </div>
                <?php
            }
            ?>
            
        </div>
        
        <p class="StockItemName"><?php print $row["StockItemName"]; ?></p>
        <form method="post">
        <input type="number" name="stockItemID" value="<?php print($row["StockItemID"]); ?>" hidden>
            <div class="aantalDiv">
            <h3> Aantal: <input readOnly name="aantal" type="text" value="<?php echo($cartItem);?>" class="aantal"></h3> 
            <div style="display:grid;">
                <input class="upDown" type="submit" name="up" value="🔼">
                <input class="upDown" type="submit" name="down" value="🔽">
            </div>
            </div>
        </form>


    </div>
    <?php
    }
}
   
//totaal prijs berekenen

$totaalprijs = 0;

foreach($cart as $item => $aantal){
    $StockItem = getStockItem($item,  $databaseConnection);
    if($StockItem!=null && $aantal >0){
        if(isset($_SESSION['username'])){
            if($_SESSION['username'] == 'inkoper'){
                $prijsPerStuk = $StockItem['SellPrice']-1;
                $prijs = $prijsPerStuk*$aantal;
                $totaalprijs+=$prijs;
            }
            else{
                $prijsPerStuk = $StockItem['SellPrice'];
                $prijs = $prijsPerStuk*$aantal;
                $totaalprijs+=$prijs;
            }
        }
        else{
            $prijsPerStuk = $StockItem['SellPrice'];
            $prijs = $prijsPerStuk*$aantal;
            $totaalprijs+=$prijs;
        }
        
    }
    
}

//mooi weergeven in html
?>
<div class="d-flex justify-content-between">
    <h2>Totaalprijs: <?php print("€ ". number_format($totaalprijs, 2, ',', '.')); ?> </h2> 
    <a href="bestellen.php" class="buyBtn rounded" style="width:150px; margin-top:10px; font-size:20px; text-align:center;">Bestellen</a>

</div>

</div>

