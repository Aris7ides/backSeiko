<?php

require_once '../vendor/php-jwt-main/src/JWT.php';
use \Firebase\JWT\JWT; // Add this line to import the JWT class

//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
include "../inc/dbinfo.inc";

$email = $_POST['email'];
$pin = $_POST['pin'];

//Conectar con la base de datos
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$query='SELECT psswd FROM usuario WHERE email = "'.$email.'"';

$result = $connection->query($query);

// Leer la contraseña de la base de datos
$fila = $result->fetch_assoc();
$hashContraseña = $fila['psswd'];

// Verificar la contraseña
if(password_verify($pin, $hashContraseña)){
    $response['success'] = true;
    $response['message'] = "Usuario logueado correctamente";
   
    // Generar un JWT que incluya el email del usuario y la fecha de expiración
    $token = array(
        "email" => $email,
        "exp" => time() + 3600
    );
    $jwt = JWT::encode($token, SECRET_KEY, "HS256");
    $response['jwt'] = $jwt;
} else {
    $response['success'] = false;
    $response['message'] = "Error al loguear el usuario";
};

echo json_encode($response);

$connection->close();
