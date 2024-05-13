<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

//Variable recibida desde el js
$idProducto = $_POST['idToDelete'];
$id_categoria = $_POST['id_categoria'];

//Query para eliminar al cliente
$query = "DELETE FROM producto WHERE idP = '$idProducto'";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Producto eliminado correctamente (back)";

    // actualizar cantidad de productos
    $querytwo = "UPDATE categorias SET cantidadP = cantidadP - 1 WHERE id = $id_categoria";
    $connection->query($querytwo);
} else {
    $response['success'] = false;
    $response['message'] = "Error al eliminar el producto (back)";
}

echo json_encode($response);

$connection->close();
?>