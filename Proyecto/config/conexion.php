<?php
    define('DB_SERVER','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','terosempresa');


    $conexion =mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
    $conexion->set_charset("utf8");


?>