<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación del campo Id
    $id = $_POST['id'];
    if (empty($id)) {
        echo "El campo Id es obligatorio.";
    } else {
        // Puedes realizar más validaciones específicas para el campo Id aquí si es necesario.
    }

    // Validación del campo Nombre
    $nombre = $_POST['nombre'];
    if (empty($nombre)) {
        echo "El campo Nombre es obligatorio.";
    } else {
        // Puedes realizar más validaciones específicas para el campo Nombre aquí si es necesario.
    }

    // Validación del campo Precio
    $precio = $_POST['precio'];
    if (empty($precio)) {
        echo "El campo Precio es obligatorio.";
    } elseif (!is_numeric($precio)) {
        echo "El campo Precio debe ser un valor numérico.";
    } else {
        // Puedes realizar más validaciones específicas para el campo Precio aquí si es necesario.
    }

    // Validación de la imagen
    if ($_FILES['file1']['error'] !== UPLOAD_ERR_OK) {
        echo "Error al subir la imagen.";
    } else {
        // Puedes realizar más validaciones específicas para el archivo aquí si es necesario.
        $nombre_archivo = $_FILES['file1']['name'];
        $tipo_archivo = $_FILES['file1']['type'];
        $tamano_archivo = $_FILES['file1']['size'];

        // Validar el tipo de archivo (por ejemplo, asegurarse de que sea una imagen)
        $extensiones_permitidas = array('jpeg', 'jpg', 'png', 'gif');
        $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

        if (!in_array($extension, $extensiones_permitidas)) {
            echo "El tipo de archivo no es válido. Solo se permiten imágenes.";
        }

        // Validar el tamaño del archivo (por ejemplo, no permitir archivos demasiado grandes)
        $tamano_maximo = 2 * 1024 * 1024; // 2 MB
        if ($tamano_archivo > $tamano_maximo) {
            echo "El tamaño del archivo es demasiado grande. El tamaño máximo permitido es 2 MB.";
        }

        // Mover el archivo a una ubicación deseada (por ejemplo, una carpeta de carga)
        $carpeta_destino = "uploads/";
        move_uploaded_file($_FILES['file1']['tmp_name'], $carpeta_destino . $nombre_archivo);

        // Puedes guardar la ruta del archivo en la base de datos si es necesario.
    }

    // Validación del campo Categoría (puedes aplicar tus propias reglas de validación)
    $categoria = $_POST['categoria'];
    // Realiza la validación de la categoría según tus reglas.

    // Si todos los campos pasan la validación, puedes realizar la inserción en la base de datos o cualquier otra acción necesaria.
    // Aquí puedes agregar la lógica para guardar los datos en la base de datos.

    // Si se cumplen todas las validaciones, redirige a una página de éxito o realiza alguna otra acción.
    // header("Location: exito.php");
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