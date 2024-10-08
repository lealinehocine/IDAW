<!doctype html>

<html>
<head>
<meta charset="utf-8">
<title> Exemple Dynamique </title>
</head>
<body>
L'heure courante est :
<?php
// Affichage de la date et de l'heure  
date_default_timezone_set("Europe/Paris");
echo date('Y-m-d H:i:s');
?>
</body>
</html>

