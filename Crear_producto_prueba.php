<?php
// Establecer la conexión a la base de datos
    $servername = "localhost";
    $username = "actividad3.1";
    $password = "actividad3.1";

    //Create connection
    $conn = new mysqli($servername, $username, $password);

    //Check connection
    if ($conn -> connect_error){
        die("Connection failed:" . $conn -> connection_error);
    }
    echo "Connected successfully";

// Inicializar variables para los campos del formulario
$id = $nombre = $precio = $categoria = "";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de campos
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    // Validación de campos
    if (empty($id)) {
        echo "El campo Id es obligatorio.";
    } else {
    }

    if (empty($nombre)) {
        echo "El campo Nombre es obligatorio.";
    } else {
    }

    if (empty($precio)) {
        echo "El campo Precio es obligatorio.";
    } elseif (!is_numeric($precio)) {
        echo "El campo Precio debe ser un valor numérico.";
    } else {
    }

    // Validación de imagen
    if ($_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Error al subir la imagen.";
    } else {
        $nombre_archivo = $_FILES['imagen']['name'];
        $tipo_archivo = $_FILES['imagen']['type'];
        $tamano_archivo = $_FILES['imagen']['size'];

        // Validar el tipo de archivo
        $extensiones_permitidas = array('jpeg', 'jpg', 'png', 'gif');
        $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

        if (!in_array($extension, $extensiones_permitidas)) {
            $errors[] = "El tipo de archivo no es válido. Solo se permiten imágenes.";
        }

        // Validar el tamaño del archivo
        $tamano_maximo = 2 * 1024 * 1024; // 2 MB
        if ($tamano_archivo > $tamano_maximo) {
            $errors[] = "El tamaño del archivo es demasiado grande. El tamaño máximo permitido es 2 MB.";
        }
    }

    // Si no hay errores, insertar datos en la tabla de productos
    if (empty($errors)) {
        // Mover el archivo a la carpeta de destino
        $carpeta_destino = "C:/xampp/htdocs/xampp/Actividad3.1/Actividad3.1/";
        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_archivo);

        // Insertar datos en la tabla de productos
        $sql = "INSERT INTO productos (id, nombre, precio, categoria, imagen) VALUES ('$id', '$nombre', '$precio', '$categoria', '$nombre_archivo')";
        if ($conn->query($sql) === TRUE) {
            echo "Producto creado con éxito.";
        } else {
            echo "Error al insertar el producto: " . $conn->error;
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    }
}

// Obtener categorías de la base de datos
//$categorias = array();
//$result = $conn->query("SELECT * FROM categorias");
//if ($result->num_rows > 0) {
// while ($row = $result->fetch_assoc()) {
//      $categorias[] = $row['nombre_categoria'];
//   }
//}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear producto</title>
    </head>
    <body>
        <h1>Crear producto</h1>

        <?php
        if (!empty($errors)) {
            echo "<div style='color: red;'><ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul></div>";
        }
        ?>

        <form action="crear_producto.php" method="post" enctype="multipart/form-data">
            <label for="id">Id: </label>
            <input type="text" name="id" value="<?php echo $id; ?>"><br>

            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>

            <label for="precio">Precio: </label>
            <input type="text" name="precio" value="<?php echo $precio; ?>"><br>

            <label for="imagen">Imagen: </label>
            <input type="file" name="imagen"><br>

            <label for="categoria">Categoría: </label>
            <select name="categoria">
                <option value="">Seleccione una categoría</option>
                <?php
                foreach ($categorias as $cat) {
                    echo "<option value='$cat' " . ($categoria == $cat ? "selected" : "") . ">$cat</option>";
                }
                ?>
            </select><br>

            <button type="submit">Subir producto</button>
        </form>
    </body>
</html>