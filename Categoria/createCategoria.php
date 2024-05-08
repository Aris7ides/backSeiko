<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";


//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$categoria = $_POST['categoria'];

$query = "INSERT INTO categorias (categoria) VALUES ('$categoria')";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "categorias creado correctamente";
} else {
    $response['success'] = false;
    $response['message'] = "Error al crear el categorias";

    // Si hay un error, se eliminará el categorias
    $query = "DELETE FROM categorias WHERE categoria = '$categoria'";
    $connection->query($query);
}

echo json_encode($response);

$connection->close();
?>