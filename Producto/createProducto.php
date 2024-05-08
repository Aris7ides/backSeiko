<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";


//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$nomP = $_POST['nomP'];
$descP = $_POST['descP'];
$precioP = $_POST['precioP'];
$id_categoria = $_POST['id_categoria'];

$query = "INSERT INTO producto (nombreP, descripcionP, id_categoria, precioP) VALUES ('$nomP', '$descP', '$precioP', '$id_categoria')";

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