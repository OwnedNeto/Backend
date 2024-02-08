
<?php
require_once realpath('./vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable('./');
    $dotenv->load();

    echo $_ENV['MI_VARIABLE_ENTORNO'];
    
    $puerto = $_ENV['PUERTO'];
    $usuario = $_ENV['USUARIO'];
    $password = $_ENV['PASSWORD'];
    $bd = $_ENV['DATABASE'];
    $host = $_ENV['HOST'];

   
    $conn = new PDO("mysql:host=$host;port=$puerto;dbname=$bd",$usuario,$password);

    
    if ($conn != true) {
        echo("Conexión fallida");
    }

    echo "Conexión exitosa";

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
</head>
<body>
    <center><h1>AÑADIR</h1></center>
    <center>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="linea1" placeholder="linea 1">
        <input type="text" name="linea1" placeholder="linea 2">
        <button type="submit">Añadir</button>
    </form>
    <h1>Editar</h1>
    <br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="id_edit" placeholder="EditarID">
        <input type="text" name="e_linea1" placeholder="nuevo valor 1">
        <input type="text" name="e_linea2" placeholder="nuevo valor 2">
        <button type="submit">Añadir_Edicion</button>
    </form>
    <br>
    <h1>Eliminar</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="delete_id" placeholder="Eliminar_ID">
        
        <button type="submit">Eliminar</button>
    </form>
    </center>

    
</body>
</html>