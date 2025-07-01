<?php
session_start();
require_once '../config/conexion.php';


    if(!empty($_POST["btnIngresar"])){
        if(!empty($_POST["username"]) and !empty($_POST["password"])){
            $user=$_POST["username"];
            $password=$_POST["password"];



            $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($resultado->num_rows === 1){

                $datos=$resultado->fetch_object();

                if(password_verify($password,$datos->clave)){
                    $_SESSION["id"]=$datos->id;
                    $_SESSION["usuario"]=$datos->usuario;
                    header("location:/Proyecto_P_Web/Proyecto/vista/dashboard.php");
                    exit;
                } else {
                    echo "Contrasena incorrecta";
                }
            } else {

                echo "El usuario no existe";
            }

        } else {
            echo "Por favor complete todos los campos";
        }

    }

?>