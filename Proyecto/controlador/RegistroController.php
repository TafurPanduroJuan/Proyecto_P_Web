<?php
    session_start();
    require_once '../config/conexion.php';


    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["btnRegistrar"])) {
        $usuario = trim($_POST["usuario"]);
        $email = trim($_POST["email"]);
        $clave = trim($_POST["clave"]);



        if (empty($usuario) || empty($email) || empty($clave)) {
            $_SESSION["registro_error"] = "Todos los campos son obligatorios.";
            header("Location: /Proyecto_P_Web/Proyecto/vista/registro.php");
            exit;
        }


        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ? OR email = ?");
        $stmt->bind_param("ss",$usuario,$email);
        $stmt->execute();

        $resultado=$stmt->get_result();


        $claveHash=password_hash($clave,PASSWORD_DEFAULT);

        $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, email, clave) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $usuario, $email, $claveHash);



        if ($stmt->execute()) {
            $_SESSION["registro_exito"] = "Registro exitoso. Ahora puedes iniciar sesión.";
            header("location: /Proyecto_P_Web/Proyecto/vista/registro.php");
            exit;
        } else {
            $_SESSION["registro_error"] = "Error al registrar. Inténtalo de nuevo.";
            header("location: /Proyecto_P_Web/Proyecto/vista/registro.php");
            exit;
        }

    }

?>