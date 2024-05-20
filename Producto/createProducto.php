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
//     http_response_code(500);
//     die();
// }

// // Comprobar si el usuario tiene permisos de admin
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

$nomP = $_POST['nomP'];
$descP = $_POST['descP'];
$precioP = $_POST['precioP'];
$id_categoria = $_POST['id_categoria'];
$img_path = $_POST['img_path'];
// $jwt = $_POST['jwt'];

$query = "INSERT INTO producto (nombreP, descripcionP, id_categoria, precioP, img_path) VALUES ('$nomP', '$descP', '$id_categoria', '$precioP', '$img_path')";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Producto creado correctamente";

    // actualizar cantidad de productos
    $querytwo = "UPDATE categorias SET cantidadP = cantidadP + 1 WHERE id = $id_categoria";
    $connection->query($querytwo);
} else {
    $response['success'] = false;
    $response['message'] = "Error al crear el producto";

    // Si hay un error, se eliminará el producto
    $query = "DELETE FROM producto WHERE nombreP = '$nomP'";
    $connection->query($query);
}

echo json_encode($response);

$connection->close();
?>