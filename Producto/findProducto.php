<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$idP= $_GET['idP'];

$query="SELECT * FROM producto WHERE idP = '$idP'";

$result = $connection->query($query);

// Verificar la conexión
if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}else{
    if($result->num_rows > 0) {
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
}

$connection->close();
?>