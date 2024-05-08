<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend Index</title>
</head>
<body>
    <?php session_start();?>
    <h2>Es la pagina de back, Bienvenido <?php echo($_SESSION['user']);?></h2>
    <form action="./src/logOut.php">
        <button type="submit">Cerrar Sesion</button>
    </form>

    <!-- <?php print_r(var_dump($_SESSION));?> -->
</body>
</html>