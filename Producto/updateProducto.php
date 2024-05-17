<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// require_once '../vendor/php-jwt-main/src/JWT.php';
// require_once '../vendor/php-jwt-main/src/Key.php';
// use \Firebase\JWT\JWT;
// use Firebase\JWT\Key;

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Verificar el JWT
// $secret_key = SECRET_KEY;
// $jwt = $_POST['jwt'];

// try {
//     $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
// } catch (Exception $e) {
//     http_response_code(401);
//     die();
// }

// Comprobar si el usuario tiene permisos de admin
// $email = $decoded->email;
// $query = "SELECT tipo FROM usuario WHERE email = '$email'";

// $result = $connection->query($query);

// if ($result->num_rows > 0) {
//     $fila = $result->fetch_assoc();
//     if ($fila['tipo'] != 1) {
//         http_response_code(401);
//         die();
//     }
// } else {
//     http_response_code(401);
//     die();
// }

$idP= $_POST['idP'];
$nomP = $_POST['nomP'];
$descP = $_POST['descP'];
$precioP = $_POST['precioP'];
$id_categoria = $_POST['id_categoria'];

// Editar producto por id
$query = "UPDATE producto SET nombreP = '$nomP',  descripcionP = '$descP', precioP = '$precioP', id_categoria = $id_categoria WHERE idP = '$idP'";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Producto actualizado correctamente";
} else {
    $response['success'] = false;
    $response['message'] = "Error al actualizar el producto";
}

echo json_encode($response);

$connection->close();
?>