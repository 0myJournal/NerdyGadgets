<?php
include __DIR__ . "/header.php";
include "CartFuncties.php";
setlocale(LC_MONETARY,"'nl_NL'");

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<?php
$error = "";
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];
    $error = login($email, $wachtwoord, $databaseConnection);
}

?>
<div id="CenteredContent">
<h1>Login</h1>
    <?php
    if(!isset($_SESSION['klant'])){

    ?>
    <form method="POST">
        <label for="email">Emailadres:</label>
        <input type="text" placeholder="example@email.com" name="email" id="email" required>
        <br>
        <label for="wachtwoord">Wachtwoord:</label>

        <input type="password" name="wachtwoord" id="wachtwoord" required>

        <button type="submit" name="submit"class="btn  mt-2 btn-primary">Log In</button>
        <br>
        <a href="/register" class="HrefDecoration">Ik heb nog geen account</a>
    </form>
    <h5 style="<?php if($error=="Je wachtwoord of emailadres is foutief"){ echo'color:red;';}else{ echo'color:green;';}?> " ><?php echo $error;?></h5>
    <?php
    }
    else{
        ?>
        <h5 style="color:green;" >Welkom <?php echo getKlantNaam($_SESSION['klant']);?>!</h5>
        <?php
    }
    ?>
</div>
</body>
</html>