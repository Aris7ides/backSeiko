<?php
//permite el accesio desde diferentes origenes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$targetDirectory = "C:/Users/jose_/src/projectDawSeiko/public/img/";
$targetFile = $targetDirectory . $_POST['nomP'] . "-" . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

// Verificar si el archivo es una imagen real o un archivo falso
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}

// Verificar si el archivo ya existe
if (file_exists($targetFile)) {
    $uploadOk = 0;
}

// Permitir solo ciertos formatos de archivo
// && $imageFileType != "gif"
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {  
    $uploadOk = 0;
}

// Si todo está bien, intenta subir el archivo
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo json_encode(array("imageName" => basename($_FILES["image"]["name"])));
    } else {
        echo json_encode(array("error" => "Error al subir la imagen"));
    }
} else {
    echo json_encode(array("error" => "Error al subir la imagen 2"));
}
?>
