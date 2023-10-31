<?php



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear producto</title>
    </head>
    <body>
        <label id="identificador" >Id: </label>
        <input type="text">
        <label id="nombre" >Nombre: </label>
        <input type="text">
        <label id="precio" >Precio: </label>
        <input type="text">
        <fieldset>
          <legend>Subida de archivos</legend>
          <label for="file1">Imagen: </label>
          <input type="file" name="file1" id="file1">
        </fieldest>
        <label id="categoria" >Categoría: </label>
        <input type="text">
          <button type="submit">Subir datos</button>
    </body>
</html>