<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
<!-- contraseñas: LuisMendoza y MartaSuarez  -->
    <h1>Iniciar Sesión</h1>
    <form action="form.php" method="post">
        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>