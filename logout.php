<?php

session_start();

echo "<br>Salimos...";

session_unset();

session_destroy();

?>
<nav class="menu">
    <ul>
        <li><a href="inicio.php">Inicio</a></li>
        <li><a href="logout.php">Salir</a></li>
    </ul>
</nav>