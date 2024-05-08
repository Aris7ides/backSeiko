<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$idC= $_POST['idC'];
$nomC = $_POST['nombre'];
$telf = $_POST['telf'];
$email = $_POST['email'];
$mensj = $_POST['mensj'];

// Editar cliente por email
$query = "UPDATE contactos SET nombre_contacto = '$nomC',  telefono = '$telf', email = '$email', mensaje = '$mensj' WHERE idP = '$idC'";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Contacto actualizado correctamente";
} else {
    $response['success'] = false;
    $response['message'] = "Error al actualizar el Contacto";
}

echo json_encode($response);

$connection->close();
?>