<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="../public/css/inicioSesion.css">
    <link rel="shortcut icon" type="image/x-icon" href="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=call" />
</head>
<body>
    <!--NAV SECTION-->
    <nav class="navbar">
        <img class="nav__img" src="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/iconoTeros.jpg" alt="Error al cargar imagen">
        <ul class="nav__list">
            <li class="list__item"><a class="link__item" href="/Proyecto_P_Web/Proyecto/vista/index.php">Volver</a></li>
        </ul>
    </nav>

    <header>
        <div class="form__container">
            <h1>Iniciar Sesion</h1>
            <form method="post" action="../controlador/LoginController.php" class="form" >
                <div class="form__username">
                <input class="form__input" type="text" placeholder="Username" name="username" >    
                </div>
                <div class="form__password">
                <input class="form__input" type="password" placeholder="Password" name="password">    
                </div>
                <input class="form__button" type="submit" value="Ingresar" name="btnIngresar">
                <div class="form__register">
                    <p>¿No tienes cuenta? <a href="/Proyecto_P_Web/Proyecto/vista/registro.php">Crear Cuenta</a></p>
                </div>

            </form>
        </div>
    </header>

    <!--FOOTER SECTION-->
    <footer>
        <?php
            require_once('templates/footer.php');
        ?>
    </footer>

    <script src="../public/js/loginAJAX.js"></script>
</body>
</html>
