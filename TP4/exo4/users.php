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
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if ($id) {
        // Si l'utilisateur existe, on peut modifier
        $request = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $request->execute([$name, $email, $id]);
    } else {
        // Sinon il faut le créer
        $request = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $request->execute([$name, $email]);
    }

    header('Location:' . $_SERVER['PHP_SELF']);
    exit;
}




// Récupération des infos de l'utilisateur à modifier
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $request = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $request->execute([$id]);
    $userToEdit = $request->fetch(PDO::FETCH_OBJ);
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



<h1><?php echo isset($userToEdit) ? 'Modifier' : 'Ajouter'; ?> un utilisateur</h1>




<!-- Form pour ajouter/modifier des champs -->



<form action="" method="POST">
    <!-- <label for="id">ID :</label> -->
    <input type="hidden" name="id" value="<?php echo isset($userToEdit->id) ? $userToEdit->id : ''; ?>">
    <br>
    <label for="name">Nom :</label>
    <input type="text" name="name" value="<?php echo isset($userToEdit->name) ? $userToEdit->name : ''; ?>" required>
    <br>
    <label for="email">Email :</label>
    <input type="email" name="email" value="<?php echo isset($userToEdit->email) ? $userToEdit->email : ''; ?>" required>
    <br>
    <button type="submit" name="submit"><?php echo isset($userToEdit) ? 'Modifier' : 'Ajouter'; ?></button>
</form>




</body>
</html>