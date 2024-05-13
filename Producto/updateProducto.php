<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$idP= $_POST['idP'];
$nomP = $_POST['nomP'];
$descP = $_POST['descP'];
$precioP = $_POST['precioP'];
$id_categoria = $_POST['id_categoria'];
$img_path = $_POST['img_path'];

// Editar cliente por email
$query = "UPDATE producto SET nombreP = '$nomP',  descripcionP = '$descP', precioP = '$precioP', id_categoria = '$id_categoria', img_path = '$img_path' WHERE idP = '$idP'";

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