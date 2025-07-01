<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <link rel="stylesheet" href="../public/css/nosotros.css">
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

    <main>
        <div class="card1">
            <div class="vision">
                <h1>NUESTRA VISION</h1>
                <p class="t1">
                    Ser la empresa líder en soluciones tecnológicas innovadoras en Latinoamérica,</br>
                    reconocida por transformar digitalmente a las organizaciones mediante productos de alta calidad,</br>
                    atención personalizada y un compromiso constante con la excelencia y la sostenibilidad.</br>
                    Impulsar el futuro digital conectando personas, empresas y tecnología a través de soluciones
                    inteligentes</br>
                    que mejoran la vida y potencian el crecimiento sostenible en todo el mundo.
                </p>
            </div>
            <img src="https://img.freepik.com/vector-gratis/ilustracion-concepto-declaracion-vision_114360-7576.jpg?w=360"
                alt="vision">
        </div>
        <div class="card2">
            <img src="https://shresthalimited.com/wp-content/uploads/2023/10/flat-design-illustration-with-businessman-character-standing-with-big-target-and-arrow-flat-design-banner-isolated-on-white-background-mission-accomplished-for-sure-free-vector.jpg"
                alt="mision">
            <div class="mision">
                <h1>NUESTRA MISION</h1>
                <p class="t2">
                    En nuestra empresa Teros, es ofrecer soluciones digitales que innoven mediante el diseño</br>
                    y desarrollo de páginas web funcionales, que sean llamativas y personalizadas.</br>
                    Nuestra empresa va dirigida hacia pequeños emprendimientos y a usuarios que buscan potenciar</br>
                    su presencia en línea. Nuestro objetivo a lograr es brindar componentes digitales de calidad</br>
                    que impulsen el crecimiento de nuestros clientes. Aplicando conocimientos adquiridos</br>
                    con el pasar de los tiempos y mejorando continuamente la funcionalidad de la web.
                </p>
            </div>
        </div>
        <div class="card3">
            <div class="historia">
                <h1>NUESTRA HISTORIA</h1>
                <p class="t3">
                    Somos Teros, una marca peruana con presencia en Latinoamérica, dedicada a ofrecer soluciones</br>
                    tecnológicas modernas y accesibles. Nos especializamos en el desarrollo y comercialización</br>
                    de productos innovadores que se adaptan a las necesidades de un mundo en constante cambio.</br>
                    Nuestra prioridad es brindar calidad, confianza y una experiencia tecnológica cercana al usuario,</br>
                    combinando diseño, funcionalidad y garantía en cada uno de nuestros productos.
                </p>
            </div>
            <img src="https://static.tildacdn.net/tild3666-3336-4434-b262-343430356231/pexels-photo-3183150.jpeg" 
                alt="historia">
        </div>
    </main>

    <!--FOOTER SECTION-->
    <footer>
        <?php
            require_once('templates/footer.php');
        ?>
    </footer>
    
</body>
</html>