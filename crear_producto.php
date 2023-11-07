<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación del campo Id
    $id = $_POST['id'];
    if (empty($id)) {
        echo "El campo Id es obligatorio.";
    } else {
    }

    // Validación del campo Nombre
    $nombre = $_POST['nombre'];
    if (empty($nombre)) {
        echo "El campo Nombre es obligatorio.";
    } else {
    }

    // Validación del campo Precio
    $precio = $_POST['precio'];
    if (empty($precio)) {
        echo "El campo Precio es obligatorio.";
    } elseif (!is_numeric($precio)) {
        echo "El campo Precio debe ser un valor numérico.";
    } else {
    }

    // Validación de la imagen
    if ($_FILES['file1']['error'] !== UPLOAD_ERR_OK) {
        echo "Error al subir la imagen.";
    } else {
        $nombre_archivo = $_FILES['file1']['name'];
        $tipo_archivo = $_FILES['file1']['type'];
        $tamano_archivo = $_FILES['file1']['size'];

        $extensiones_permitidas = array('jpeg', 'jpg', 'png', 'gif');
        $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

        if (!in_array($extension, $extensiones_permitidas)) {
            echo "El tipo de archivo no es válido. Solo se permiten imágenes.";
        }

        $tamano_maximo = 2 * 1024 * 1024;
        if ($tamano_archivo > $tamano_maximo) {
            echo "El tamaño del archivo es demasiado grande. El tamaño máximo permitido es 2 MB.";
        }

        // Mover el archivo a una ubicación deseada
        $carpeta_destino = "C:/xampp/htdocs/Actividad3.1";
        move_uploaded_file($_FILES['file1']['tmp_name'], $carpeta_destino . $nombre_archivo);
    }

    // Validación del campo Categoría
    $categoria = $_POST['categoria'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear producto</title>
    </head>
    <body>
        <form action="procesar_formulario.php" method="post" enctype="multipart/form-data">
            <label for="id">Id: </label>
            <input type="text" name="id">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre">
            <label for="precio">Precio: </label>
            <input type="text" name="precio">
            <fieldset>
                <legend>Subida de archivos</legend>
                <label for="file1">Imagen: </label>
                <input type="file" name="file1" id="file1">
            </fieldset>
            <label for="categoria">Categoría: </label>
            <input type="text" name="categoria">
            <button type="submit">Subir datos</button>
        </form>
    </body>
</html>