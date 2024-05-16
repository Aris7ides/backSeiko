<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Verificar el JWT
$secret_key = SECRET_KEY;
$jwt = $_POST['jwt'];

try {
    $decoded = JWT::decode($jwt, $secret_key, array('HS256'));
} catch (Exception $e) {
    http_response_code(401);
    die();
}

// Comprobar si el usuario tiene permisos de admin
$email = $decoded->email;
$query = "SELECT tipo FROM usuario WHERE email = '$email'";

$result = $connection->query($query);

if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    if ($fila['tipo'] != 1) {
        http_response_code(401);
        die();
    }
} else {
    http_response_code(401);
    die();
}

//Variable recibida desde el js
$idProducto = $_POST['idToDelete'];
$id_categoria = $_POST['id_categoria'];

//Query para eliminar al cliente
$query = "DELETE FROM producto WHERE idP = '$idProducto'";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Producto eliminado correctamente";

    // actualizar cantidad de productos
    $querytwo = "UPDATE categorias SET cantidadP = cantidadP - 1 WHERE id = $id_categoria";
    $connection->query($querytwo);
} else {
    $response['success'] = false;
    $response['message'] = "Error al eliminar el producto";
}

echo json_encode($response);

$connection->close();
?>