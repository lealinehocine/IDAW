<?php
if (isset($_GET["css"])){
    $selectedstyle = $_GET["css"];
    setcookie("style", $selectedstyle, time()+3600);
    $currentStyle = $selectedstyle;
}
else{
        if (isset($_COOKIE["style"])) {
        $currentStyle = $_COOKIE["style"];
    } else {
        //par défaut
        $currentStyle = "style1";
    }
}


session_start(); 


if (!isset($_SESSION['user'])) {
    header("Location: login.php"); 
    exit();
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo $currentStyle; ?>.css">
</head>
<body>

<h1>Profil de l'utilisateur</h1>
<p><?php echo "Nom d'utilisateur : " . htmlspecialchars($_SESSION['user']); ?></p>

<form id="style_form" action="index.php" method="GET">
<select name="css">
<option value="style1" <?php if($currentStyle == "style1") echo "selected";?> >style1</option>
<option value="style2" <?php if($currentStyle == "style2") echo "selected";?>>style2</option>
</select>
<input type="submit" value="Appliquer" /> 
<!-- submit construit une requête GET -->


</form>

<?php echo "<a href=\"logout.php\">Se déconnecter</a>"; ?>

</body>
</html>


