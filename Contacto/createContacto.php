<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";


//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$nomC = $_POST['nombre'];
$telf = $_POST['telf'];
$email = $_POST['email'];
$mensj = $_POST['mensj'];

$query = "INSERT INTO contactos (nombre_contacto, telefono, email, mensaje) VALUES ('$nomC', '$telf', '$email', '$mensj')";

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