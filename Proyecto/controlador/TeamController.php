<?php
require_once '../config/conexion.php';

//Elimina empleado
if (isset($_POST["btnEliminar"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $conexion->query("DELETE FROM empleados WHERE id = $id");
    header("Location: ../vista/team.php");
    exit;
}


//Guarda o edita empleado
if (!empty($_POST["btnGuardar"])) {
    if (
        !empty($_POST["nombre"]) &&
        !empty($_POST["apellido"]) &&
        !empty($_POST["cargo"]) &&
        !empty($_POST["email"])
    ) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $cargo = $_POST["cargo"];
        $email = $_POST["email"];

        if (!empty($id)) {
            // Actualiza
            $conexion->query("UPDATE empleados SET nombre='$nombre', apellido='$apellido', cargo='$cargo', email='$email' WHERE id=$id");
        } else {
            // Registra
            $conexion->query("INSERT INTO empleados(nombre, apellido, cargo, email) VALUES('$nombre','$apellido','$cargo','$email')");
        }
    }

    header("Location: ../vista/team.php");
    exit;
}
?>