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
            /* PREPARE */
            /*
            $updateStmt = $conn->prepare("UPDATE modulos SET nombre_completo = :nombre_completo, descripcion = :descripcion WHERE iniciales = :iniciales");
            $updateStmt->bindParam(':nombre_completo', $nombreCompleto);
            $updateStmt->bindParam(':descripcion', $descripcion);
            $updateStmt->bindParam(':iniciales', $iniciales);
            $updateStmt->execute();
            */
    
            /* QUERY */
            $updateStmt = $conn->query("UPDATE modulos SET nombre_completo = '$nombreCompleto', descripcion = '$descripcion' WHERE iniciales = '$iniciales'");
    
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
            <label for="id">Id: </label>
            <input type="text" name="id">
        </form>
        <form action="procesar_formulario.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre">
            <label for="precio">Precio: </label>
            <input type="text" name="precio">
            <fieldset>
                <legend>Subida de archivos</legend>
                <label for="file1">Imagen: </label>
                <input type="file" name="file1" id="file1">
            </fieldset>
            <label for="categoria">Categoría:</label>
            <input type="text" name="categoria">

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Modificar datos</button>
        </form>
    </body>
</html>