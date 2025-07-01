<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="../public/css/registro.css">
    <link rel="shortcut icon" type="image/x-icon" href="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=call" />
</head>
<body>
    <!--NAV SECTION-->
    <nav class="navbar">
        <img class="nav__img" src="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/iconoTeros.jpg" alt="Error al cargar imagen">
        <ul class="nav__list">
            <li class="list__item"><a class="link__item" href="/Proyecto_P_Web/Proyecto/vista/login.php">Volver</a></li>
        </ul>
    </nav>

    <header>
        <div class="form__container">
            <h1>Registrarse</h1>
            <form class="form" method="post" action="../controlador/RegistroController.php">
                <div class="form__username">
                    <input class="form__input" type="text" placeholder="Username" name="usuario" required>    
                </div>
                <div class="form__email">
                    <input class="form__input" type="email" placeholder="Email" name="email" required>    
                </div>
                <div class="form__password">
                    <input class="form__input" type="password" placeholder="Password" name="clave" required>    
                </div>
                    <input class="form__button" type="submit" name="btnRegistrar" value="Registrarse">
            </form>

            <?php                
                if (isset($_SESSION["registro_error"])) {
                        echo "<p style='color:red'>" . $_SESSION["registro_error"] . "</p>";
                        unset($_SESSION["registro_error"]);
                    }
                if (isset($_SESSION["registro_exito"])) {
                    echo "<p style='color:green'>" . $_SESSION["registro_exito"] . "</p>";
                    unset($_SESSION["registro_exito"]);
                }
            ?>

        </div>
    </header>

    <!--FOOTER SECTION-->
    <footer>
        <?php
            require_once('templates/footer.php');
        ?>
    </footer>

</body>
</html>
