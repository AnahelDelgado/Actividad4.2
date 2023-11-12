<?php
// Establecer la conexión a la base de datos
    $servername = "localhost";
    $username = "actividad3.1";
    $password = "actividad3.1";
    $database = "actividad3.1";
    
    //Crear conección con "mysqli"
    //$conn = new mysqli($servername, $username, $password, $database);
    //Check connection
    //if ($conn -> connect_error){
    //    die("Connection failed:" . $conn -> connection_error);
    //}
    //echo "Connected successfully";

    //Crear conección con PDO
    //$mbd = new PDO('mysql:host=localhost;dbname=actividad3.1', $username, $password);

    try {
        $conn = new PDO('mysql:host=localhost;dbname=actividad3.1', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }

    $stmt = $conn->query("SELECT Id, Nombre FROM categoria");
    while ($row = $stmt->fetch()) {
        $categoria[$row['Id']] = $row['Nombre'];
    }
    $categoria = $conn->query("SELECT Id, Nombre FROM categoria")->fetchAll(PDO::FETCH_COLUMN);

    echo "<pre>";
        print_r($categoria);
    echo "</pre>";

// Inicializar variables para los campos del formulario
$id = $nombre = $precio = $categoria = "";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de campos
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    // Validación de campos

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

    //print_r($_FILES);
    // Validación de imagen
    if ($_FILES['file1']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Error al subir la imagen.";
    } else {
        $nombre_archivo = $_FILES['file1']['name'];
        $tipo_archivo = $_FILES['file1']['type'];
        $tamano_archivo = $_FILES['file1']['size'];

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
        $carpeta_destino = "C:/xampp/htdocs/xampp/Actividad3.1/Actividad3.1/Archivos/";
        move_uploaded_file($_FILES['file1']['tmp_name'], $carpeta_destino . $nombre_archivo);

        // Insertar datos en la tabla de productos
        $sql = "INSERT INTO productos (nombre, precio, categoria ,imagen) VALUES ('$nombre', '$precio','$categoria', '$nombre_archivo')";
        if ($conn->query($sql) === TRUE) {
            echo "Producto creado con éxito.";
        } else {
            echo "Error al insertar el producto: " . $conn->error;
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    }
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

        <form action="crear_producto_prueba.php" method="post" enctype="multipart/form-data">

            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>

            <label for="precio">Precio: </label>
            <input type="text" name="precio" value="<?php echo $precio; ?>"><br>

            <label for="file1">Imagen: </label>
            <input type="file" name="file1"><br>

            <label for="categoria">Categoría: </label>
            <form>
                <select name="categoria">
                    <?php
                        foreach($categoria as $clave => $valor) {
                            echo "<option value='".$clave."'>".$valor."</option>";
                        }
                    ?>
                </select>
            </form><br> 

            <button type="submit">Subir producto</button>
        </form>
    </body>
</html>