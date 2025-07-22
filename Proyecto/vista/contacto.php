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
        <form class="formulario" id="formulario-contacto">
            <div class="form-row">
                <input type="text" placeholder="NOMBRE" id="nombre">
                <input type="text" placeholder="APELLIDO" id="apellido">
            </div>
            <input type="email" placeholder="EXAMPLE@GMAIL.COM" id="email">
            <textarea placeholder="Escribe tu mensaje..." id="mensaje"></textarea>
            <br>
            <button type="submit">Enviar</button>
            <p id="error-msg" style="color: red; display: none; text-align: center; margin-top: 10px;">
                Por favor, completa todos los campos.
            </p>
        </form>
    </div>

    <!--FOOTER SECTION-->
    <footer>
        <?php
            require_once('templates/footer.php');
        ?>
    </footer>

    <!--VALIDACIÓN DE FORMULARIO-->
    <script>
        document.getElementById('formulario-contacto').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            const email = document.getElementById('email').value.trim();
            const mensaje = document.getElementById('mensaje').value.trim();
            const errorMsg = document.getElementById('error-msg');

            if (!nombre || !apellido || !email || !mensaje) {
                e.preventDefault(); // Detiene el envío del formulario
                errorMsg.style.display = 'block';
            } else {
                errorMsg.style.display = 'none';
            }
        });
    </script>
</body>
</html>

