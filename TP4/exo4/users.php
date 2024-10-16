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



// Suppression d'un utilisateur
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $request = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $request->execute([$id]);
}


//ETAPE1 : créer/préparer la requête
$request = $pdo->prepare("SELECT * FROM users");
//ETAPE2 : l'exécuter
$request->execute();
//ETAPE3 : fetch les lignes comme des objets
$users = $request->fetchAll(PDO::FETCH_OBJ);




if (isset($_POST['name']) && $_POST['email']) {
    // $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // if ($id) {
        // Si l'utilisateur existe, on peut modifier
        // $request = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        // $request->execute([$name, $email, $id]);
    // } else {
        // Sinon il faut le créer
        $request = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $request->execute([$name, $email]);
    // }

    header('Location:' . $_SERVER['PHP_SELF']);
    exit;
}



/*** close the database connection ***/
$pdo = null;
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP4 Exo4 - CRUD (côté serveur)</title>
</head>
<body>

<h1>Liste des utilisateurs</h1>



<!-- ETAPE4 : agencer la table dans HTML -->
<table>
<?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td>
                <!-- Bouton pour modifier -->
                <a href="?edit=<?php echo $user->id; ?>">Modifier</a>
                <!-- Bouton pour supprimer -->
                <a href="?delete=<?php echo $user->id; ?>">Supprimer</a>
            </td>
        </tr>    
<?php endforeach; ?>
</table>



<h1>Ajout d'utilisateur</h1>




<?php
// Si l'utilisateur est en mode édition, on récupère ses infos
// if (isset($_POST['id'])) {
//     $id = $_POST['id'];
//     $request = $pdo->prepare("SELECT * FROM users WHERE id = ?");
//     $request->execute([$id]);
//     $user = $request->fetch(PDO::FETCH_OBJ);
// }
?>

<!-- Form pour ajouter des champs -->



<form action="" method="POST">
    <!-- <label for="id">ID :</label> -->
    <input type="hidden" name="id" value="<?php echo isset($user->id) ? $user->id : ''; ?>">
    <br>
    <label for="name">Nom :</label>
    <input type="text" name="name" value="<?php echo isset($user->name) ? $user->name : ''; ?>" required>
    <br>
    <label for="email">Email :</label>
    <input type="email" name="email" value="<?php echo isset($user->email) ? $user->email : ''; ?>" required>
    <br>
    <button type="submit" name="submit">Ajouter</button>
</form>




</body>
</html>