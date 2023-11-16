<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer la conexión a la base de datos (ajusta los detalles de conexión según tu configuración)
    $servername = "localhost";
    $username = "actividad3.1";
    $password = "actividad3.1";
    $database = "actividad3.1";

    // Verificar la conexión
    try {
        $conn = new PDO('mysql:host=localhost;dbname=actividad3.1', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }

    // Obtener datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consultar la base de datos para obtener la contraseña almacenada
    $sql = "SELECT id, nombre, correo_electronico, contrasena_hash FROM usuarios2 WHERE correo_electronico = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $contrasena_hash = $result['contrasena_hash'];

        // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
        if (password_verify($contrasena, $contrasena_hash)) {
            echo "Inicio de sesión exitoso. ¡Bienvenido, " . $result['nombre'] . "!";
        } else {
            echo "Contraseña incorrecta. Inténtalo de nuevo.";
        }
    } else {
        echo "Usuario no encontrado. Verifica el correo electrónico.";
    }

    // Cerrar la conexión a la base de datos
    $conn = null;
}
?>