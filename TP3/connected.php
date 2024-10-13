<!--Q1.4 :  Le login et le mot de passe sont affichés dans l'URL -->

<?php
// if(isset($_GET["login"])) {
// echo "Le login est : ".$_GET["login"];
// }

// if(isset($_GET["password"])) {
//     echo "  et le password est : s".$_GET["password"];
//     }
?> 




<!--Q1.5:  autre version -->


<?php
// on simule une base de données
$users = array(
// login => password
'riri' => 'fifi',
'yoda' => 'maitrejedi' );
$login = "anonymous";
$errorText = "";
$successfullyLogged = false;
if(isset($_GET['login']) && isset($_GET['password'])) {
    $tryLogin=$_GET['login'];
$tryPwd=$_GET['password'];
// si login existe et password correspond
if( array_key_exists($tryLogin,$users) && $users[$tryLogin]==$tryPwd ) {
$successfullyLogged = true;
$login = $tryLogin;
} else
$errorText = "Erreur de login/password";
} else
$errorText = "Merci d'utiliser le formulaire de login";
if(!$successfullyLogged) {
echo $errorText;
} else {
echo "<h1>Bienvenu ".$login."</h1>";
}
?>