<?php
require_once("init_pdo.php");

function get_users($db){
    $sql = "SELECT * FROM USERS";
    $exe = $db->query($sql);
    $res = $exe->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function setHeaders() {
// https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
}



// ==============
// Responses
// ==============


function create_user($name, $email, $db){
    $request = "INSERT INTO users (`name`, `email`) VALUES ('$name', '$email')";
    $db->query($request);
    $sql = "SELECT id FROM users WHERE name='$name' AND email='$email'";
    $exe = $db->query($sql);
    $res = $exe->fetch(PDO::FETCH_OBJ);
    return $res;
}


function modify_user($name, $email, $db, $id){
    $request = "UPDATE users SET `name` = '$name', `email` ='$email' WHERE id = '$id' " ;
    $db->query($request);
    $sql = "SELECT * FROM users WHERE id = '$id' ";
    $exe = $db->query($sql);
    $res = $exe->fetch(PDO::FETCH_OBJ);
    return $res;
}


function getInfoById($db,$id){
    $req = "SELECT * FROM users WHERE id=".$id;
    $requete = $db->query($req);
    $res = $requete->fetch(PDO::FETCH_OBJ);
    return $res;
}


function delete_user($db, $id){
    $user = getInfoById($db, $id);
    //print_r($user); // cette ligne pose problème dans le retour de la requête car elle envoie du HTML qui ne sera pas encodé dans le corps de la requête HTTP
    $requete = $db->query("DELETE FROM users WHERE id='$id'");
    return "The user : ".$user->name." with email : ".$user->email." has been deleted";
    }



switch($_SERVER["REQUEST_METHOD"]) {
case 'GET':
    $result = get_users($pdo);
    setHeaders();
    exit(json_encode($result));

case 'POST':

    if(isset($_POST["name"]) && isset($_POST["email"])){

    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    $name = $_POST["name"];
    $email = $_POST["email"];
    $result = create_user($name, $email, $pdo);
    setHeaders();
    http_response_code(201);
    exit(json_encode($result));
    }
    else{
        http_response_code(400);
        exit(-1);
    };


case 'PUT':
    setHeaders();
    $parameters = json_decode(file_get_contents('php://input'), true);

    if(!isset($parameters["id"]) || !isset($parameters["email"])|| !isset($parameters["name"])  ){
        http_response_code(400);
        exit(-1);
    }else{
        $id = $parameters["id"];
        $email = $parameters["email"];
        $name = $parameters["name"];
        $result = modify_user($name, $email, $pdo, $id);
        http_response_code(200);
        exit(json_encode($result));
    };

    case 'DELETE':
        $parameters = json_decode(file_get_contents('php://input'),true);
        if(!isset($parameters['id'])){
            http_response_code(400);
            setHeaders();
            exit(json_encode("Tried to delete without giving an ID."));
        }
        else{
            $result = delete_user($pdo, $parameters['id']);
            setHeaders();
            exit(json_encode($result));
        }

    default:
        http_response_code(501);
        exit(-1);

}