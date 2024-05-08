<?php
session_start();
include "../inc/dbinfo.inc";

// Creación de la conexión
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
}

// Seleccion de la base de datos
$connection->select_db(DB_DATABASE);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Guardamos email y passwd
    $email = $_POST['emailU'];
    $passwd = $_POST['psswdU'];

    //HACER un check que verifique si es admin

    if ($connection->connect_error) {
        die("Error en la conexión: " . $connection->connect_error);
    }

    // Creamos una consulta
    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = $connection->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($passwd, $row['psswd'])) {
            $_SESSION['email'] = $email;
            $_SESSION['user'] = $row['user'];
            
            header('Location: ../index.php');
            exit();
        }else{
            $error = "email o contraseña incorrectos.";
            exit();
            //HACER validar que si pone contraseña incorrecta hago algo
        }
    } else {
        $error = "email o contraseña incorrectos.";
        header('Location: ../../index.html');
        exit();
    }
}
