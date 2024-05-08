<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$id = $_POST['id']
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$comentario = $_POST['comentario'];
$calific = $_POST['calific'];
$id_producto = $_POST['id_producto'];

// Editar cliente por email
$query = "UPDATE resenyas SET nombre = '$nombre',  email = '$email', comentario = '$comentario', calific = '$calific' WHERE id = '$id' AND id_producto = '$id_producto";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Resenya actualizado correctamente";
} else {
    $response['success'] = false;
    $response['message'] = "Error al actualizar el Resenya";
}

echo json_encode($response);

$connection->close();
?>