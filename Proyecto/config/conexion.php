<?php
if (!defined('DB_SERVER'))
    define('DB_SERVER', 'localhost');
if (!defined('DB_USERNAME'))
    define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD'))
    define('DB_PASSWORD', '');
if (!defined('DB_NAME'))
    define('DB_NAME', 'terosempresa');

$conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$conexion->set_charset("utf8");
?>