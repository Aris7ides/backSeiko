<?php 
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$name = $_POST['user'];
$email = $_POST['email'];
$passwd = $_POST['psswd'];

$hashContraseña = password_hash($passwd, PASSWORD_DEFAULT);

$query = "INSERT INTO usuario (user, email, psswd) VALUES ('$name', '$email', '$hashContraseña')";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Producto creado correctamente";
} else {
    $response['success'] = false;
    $response['message'] = "Error al crear el producto";

    // Si hay un error, se eliminará el producto
    $query = "DELETE FROM usuario WHERE user = '$name'";
    $connection->query($query);
}

echo json_encode($response);

$connection->close();
?>