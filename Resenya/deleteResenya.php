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
$idResenya = $_POST['idToDelete'];

//Query para eliminar al cliente
$query = "DELETE FROM resenyas WHERE id = '$idResenya'";

$result = $connection->query($query);

$response = [];

if ($result === true) {
    $response['success'] = true;
    $response['message'] = "Resenya eliminado correctamente";
} else {
    $response['success'] = false;
    $response['message'] = "Error al eliminar el Resenya";
}

echo json_encode($response);

$connection->close();
?>