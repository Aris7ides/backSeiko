<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";


//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$comentario = $_POST['comentario'];
$calific = $_POST['calific'];
$id_producto = $_POST['id_producto'];

$query = "INSERT INTO resenyas (nombre, email, comentario, calific, id_producto) VALUES ('$nombre', '$email', '$comentario', '$calific', '$id_producto')";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Contacto creado correctamente";
} else {
    $response['success'] = false;
    $response['message'] = "Error al crear el contacto";
}

echo json_encode($response);

$connection->close();
?>