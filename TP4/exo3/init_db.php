<?php
require_once('../exo2/config.php'); //chemin modifié
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

//on récupère le contenu
$content=file_get_contents("sql/create_db.sql");

//on l'exécute
$pdo->exec($content);

//on redirige vers la page qui donne le tableau en html
header("Location: ../exo2/users.php");


