<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEROS</title>
    <link rel="stylesheet" href="../public/css/index.css">
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


    <!--HEADER SECTION-->
    <header>
        <div class="carrusel__container">
            <ul class="carrusel__list">

                <li class="slider">
                    <img src="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/FONDO1.png" alt="">
                    <div class="text__container">
                       <h2>INNOVACION TECNOLOGICA</h2>
                       <P>Pantallas de alta definición y accesorios</P>
                    </div>
                </li>

                <li class="slider">
                    <img src="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/FONDO2.png" alt="">
                    <div class="text__container">
                       <h2>OFERTAS IMPERDIBLE</h2>
                       <P>Aprovecha descuentos exclusivos en nuestros productos.</P>
                    </div>
                </li>

                <li class="slider">
                    <img src="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/FONDO3.webp" alt="">
                    <div class="text__container">
                       <h2>TU SETUP PERFECTO</h2>
                       <P>Equipos confiables y duraderos que elevan tu experiencia.</P>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <section class="infobar">
        <div class="info__container">
            <h2>20 AÑOS EN EL MERCADO</h2>
            <p>Todo lo que necesitas en perifericos con calidad y variedad garantizada. Consulta nuestro catalogo y descubre todo lo que tenemos para ofrecerte</p>
        </div>

    </section>

    <!--ABOUT SECTION-->
    <section class="section__about">
        <div class="about__text">
            <h2>NOSOTROS</h2>
            <p>Teros, es una marca de origen peruano con expansio a Latinoamerica, dedicada a la comercializacion en China y personal peruano que tiene como mision garantizar la calidad de los productos</p>
            <button class="about__link"><a href="/Proyecto_P_Web/Proyecto/vista/nosotros.php">Saber mas</a></button>
        </div>
        <img class="abouts__img" src="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/iconoTeros.jpg" alt="">
    </section>
 


    <!--FOOTER SECTION-->
    <footer>
        <?php
            require_once('templates/footer.php');
        ?>
    </footer>
</body>
</html>