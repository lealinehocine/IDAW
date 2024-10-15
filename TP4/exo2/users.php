<?php
require_once('config.php');
$connectionString = "mysql:host=". _MYSQL_HOST;
if(defined('_MYSQL_PORT'))
$connectionString .= ";port=". _MYSQL_PORT;
$connectionString .= ";dbname=" . _MYSQL_DBNAME;
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );
$pdo = NULL;
try {
$pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $erreur) {
echo 'Erreur : '.$erreur->getMessage();
}

//ETAPE1 : créer/préparer la requête
$request = $pdo->prepare("SELECT * FROM users");

//ETAPE2 : l'exécuter
$request->execute();

//ETAPE3 : fetch les lignes comme des objets
$users = $request->fetchAll(PDO::FETCH_OBJ);


//ETAPE4 : agencer la table dans HTML
echo "<table>";
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>" . $user->id . "</td>";
    echo "<td>" . $user->name . "</td>";
    echo "<td>" . $user->email . "</td>";
    echo "</tr>";
}


echo "</table>";

/*** close the database connection ***/
$pdo = null;