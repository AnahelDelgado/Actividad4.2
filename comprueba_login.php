<?php

    if(!isset($_SESSION["correo_electronico"]))
    {
        header("Location: form_login.php");
    }

?>