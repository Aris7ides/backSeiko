<?php 
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$id= $_POST['id'];
$name = $_POST['user'];
$email = $_POST['email'];
$passwd = $_POST['psswd'];

// $hashContraseña = password_hash($passwd, PASSWORD_DEFAULT);

// Editar cliente por email
$query = "UPDATE usuario SET user = '$name', email = '$email', psswd = '$passwd' WHERE id = '$id'";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "usuario actualizado correctamente";
} else {
    $response['success'] = false;
    $response['message'] = "Error al actualizar el usuario";
}

echo json_encode($response);

$connection->close();
?>