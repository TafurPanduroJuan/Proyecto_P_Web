<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="../public/css/contacto.css">
    <link rel="shortcut icon" type="image/x-icon" href="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=call" />
</head>
<body>
    <!--NAV SECTION-->
    <nav class="navbar">
        <?php
            require_once('templates/navbar.php');
        ?>
    </nav>

    <div class="contacto-container">
        <h1>CONTACTO</h1>
        <p>¡No dudes en contactarnos! Si tienes alguna pregunta, comentario o una propuesta de colaboración, nos encantaría saber de ti.</p>
        <form class="formulario">
            <input type="text" placeholder="NOMBRE">
            <input type="text" placeholder="APELLIDO">
            <input type="email" placeholder="EXAMPLE@GMAIL.COM">
            <textarea placeholder="Escribe tu mensaje..."></textarea>
            <br>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <!--FOOTER SECTION-->
    <footer>
        <?php
            require_once('templates/footer.php');
        ?>
    </footer>
</body>
</html>
