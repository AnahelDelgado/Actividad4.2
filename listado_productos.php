<?php
    // Establecer la conexión a la base de datos (ajusta los detalles de conexión según tu configuración)
    $servername = "localhost";
    $username = "actividad3.1";
    $password = "actividad3.1";
    $database = "actividad3.1";
    
     //Crear conección con "mysqli"
     $conn = new mysqli($servername, $username, $password, $database);
     //Check connection
     if ($conn -> connect_error){
         die("Connection failed:" . $conn -> connection_error);
     }
     echo "Connected successfully";

    // Obtener todos los productos de la base de datos
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);

    // Obtener categorías de la base de datos
    $categorías = array();
    $resultCategorias = $conn->query("SELECT * FROM categorías");
    if ($resultCategorias->num_rows > 0) {
        while ($rowCat = $resultCategorias->fetch_assoc()) {
            $categorías[$rowCat['Id']] = $rowCat['Nombre'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado de productos</title>
    </head>
    <body>
        <h1>Listado de productos</h1>

        <table border="1">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['Nombre'] . "</td>";
                    echo "<td>" . $row['Precio'] . "</td>";
                    echo "<td><img src='Actividad3.1/" . $row['Imagen'] . "' alt='Imagen' width='50'></td>";
                    echo "<td>" . $categorías[$row['categorías']] . "</td>";
                    echo "<td><a href='edita_producto.php?id=" . $row['id'] . "'>Modificar</a> | <a href='eliminar_producto.php?id=" . $row['id'] . "'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay productos disponibles</td></tr>";
            }
            ?>
        </table>
    </body>
</html>