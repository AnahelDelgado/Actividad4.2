<?php



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
            <label for="categoria">Categoría: </label>
            <input type="text" name="categoria">
            <button type="submit">Modificar datos</button>
        </form>
    </body>
</html>