<?php

$servername = "localhost";
$username = "actividad3.1";
$password = "actividad3.1";
$database = "actividad3.1";

try {
  $conn = new PDO('mysql:host=localhost;dbname=actividad3.1', $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();
}

//* Cargar categorías
try {
  $sql = "SELECT Id, Nombre FROM Categorías";
  $stmt = $conn->query($sql);
  $categorias = $stmt->fetchAll();
} catch (PDOException $e) {
  echo "Error al obtener las categorías: " . $e->getMessage();
}

// ? GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET) && isset($_GET["id"])) {
  $id = $_GET["id"];

  //* Carga el producto si tiene ID
  try {
    $sql = "SELECT Id, Nombre, Precio, Imagen, Categoría from Productos WHERE Id = " . $id;
    $stmt = $conn->query($sql);
    $producto = $stmt->fetch();
  } catch (PDOException $e) {
    echo "Error al obtener el producto recibido por ID: " . $e->getMessage();
  }
} else {
  //* Cargar productos
  try {
    $sql = "SELECT Id, Nombre, Precio, Imagen, Categoría from Productos";
    $stmt = $conn->query($sql);
    $productos = $stmt->fetchAll();
  } catch (PDOException $e) {
    echo "Error al obtener los productos: " . $e->getMessage();
  }
}

// ? POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
  $id = $_POST["id"];

  $sql = "DELETE FROM Productos WHERE Id = '$id'";
  $stmt = $conn->prepare($sql);

  // Ejecuta la consulta
  try {
    $stmt->execute();
    echo "Borrado exitoso";
  } catch (PDOException $e) {
    echo "Error al borrar: " . $e->getMessage();
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elimina producto</title>
</head>

<body>
  <header>
    <h1>Elimina producto</h1>
  </header>
  <main>
    <?php if (empty($_POST) && !empty($id)) : ?>
      <?php
      // Pone un formulario para confirmar que muestra los datos en campos desactivados
      echo '<form action="elimina_producto.php" method="post">';
      echo '  <input class="hidden" name="id" type="text" value="' . $producto['Id'] . '">';
      echo '  <label for="nombre">Nombre: </label>';
      echo '  <input disabled type="text" name="nombre" id="nombre" value="' . $producto['Nombre'] . '">';
      echo '  <label for="precio">Precio: </label>';
      echo '  <input disabled type="number" name="precio" id="precio" value="' . $producto['Precio'] . '">';
      echo '  <label for="categoria">Categoría: </label>';
      echo '  <input disabled type="text" name="categoria" id="categoria" value="' . $categorias[$producto['Categoría'] - 1]['Nombre'] . '">';
      echo '<button type="submit">Confirmar</button>';
      echo '</form>';
      ?>
      <!-- SI NO HAY ID, ABRIR DESPLEGABLE -->
    <?php elseif (empty($_GET) && empty($id)) : ?>
      <form action="elimina_producto.php" method="GET">
        <label for="id">Seleccione un producto: </label>
        <select name="id" id="id">
          <?php
          //? Cargar productos
          foreach ($productos as $producto) {
            echo "<option value='" . $producto['Id'] . "'>" . $producto['Nombre'] . "</option>";
          }
          ?>
        </select>
        <button type="submit">Enviar</button>
      </form>
    <?php else : ?>
      <h2>¡Se ha eliminado el producto correctamente!</h2>
      <a href="/index.php">Volver atrás</a>
    <?php endif; ?>
  </main>
</body>

</html>
