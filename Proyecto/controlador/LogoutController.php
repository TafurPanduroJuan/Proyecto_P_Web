<?php
    session_start();
    session_destroy();
    header("location:/Proyecto_P_Web/Proyecto/vista/login.php");

?>