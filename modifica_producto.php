<?php

    $servername = "localhost";
    $username = "actividad3.1";
    $password = "actividad3.1";
    $database = "actividad3.1";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=actividad3.1', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }

    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['boton'])) {
        $nombre = $_GET['nombre'];
        $precio = $_GET['precio'];
        $imagen = $_GET['imagen'];
        $categoria = $_GET['categoria'];
    
        if (!empty($nombreCompleto)) {
            
            $updateStmt = $conn->query("UPDATE productos SET nombre = '$nombre', precio = '$precio', imagen='$imagen' WHERE id = '$id'");
    
            echo "Módulo actualizado correctamente.";
        } else {
            echo "El nombre completo es obligatorio.";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar producto</title>
    </head>
    <body>
        <form action="get">
            <label for="id">id: </label>
            <input type="text" name="id">
        </form>
        <form action="modifica_producto.php" method="get">
            Id: <?php echo $id['id']; ?><br><br>
            Nombre: <input type="text" size='50' name="Nombre" value="<?php echo $Nombre['Nombre']; ?>" required><br><br>
            Precio: <input type="text" size='50' name="Precio" value="<?php echo $Precio['Precio']; ?>" required><br><br>
            <fieldset>
                <legend>Subida de archivos</legend>
                <label for="file1">Imagen: </label>
                <input type="file" name="file1" id="file1">
            </fieldset>
            <input type="hidden" name="id" value="<?php echo $Id; ?>">
            <input type="submit" name="boton" value="Actualizar">   
        </form>
    </body>
</html>