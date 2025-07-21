<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="../public/css/catalogo.css">
    <link rel="stylesheet" href="../public/css/modelo_pago.css">
    <link rel="shortcut icon" type="image/x-icon" href="/Proyecto_P_Web/Proyecto/public/imgs/inicio_imgs/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="../public/js/carrito_fun.js" defer></script>
    <script src="../public/js/catalogo_fun.js" defer></script>
    <script src="../public/js/pago_fun.js" defer></script>
</head>

<body>
    <!--NAV SECTION-->
    <nav class="navbar">
        <?php
        require_once('templates/navbar.php');
        ?>
    </nav>

    <main>
        <h2 class="titulo">CATEGORIAS</h2>
        <div class="categorias">
            <a href="#" class="categoria-link" data-categoria="monitores">MONITORES</a>
            <a href="#" class="categoria-link" data-categoria="mouse">MOUSE</a>
            <a href="#" class="categoria-link" data-categoria="teclados">TECLADOS</a>
            <a href="#" class="categoria-link" data-categoria="auriculares">AURICULARES</a>
        </div>
        <div class="contenido">
            <aside class="filtros">
                <!-- Los filtros se cargarán aquí dinámicamente -->
            </aside>
            <section class="productos" id="contenedor-productos">
                <!-- Los productos se cargarán aquí dinámicamente -->
            </section>
        </div>
    </main>

    <!-- Carrito de compras -->
    <div class="cart-container" id="cart">
        <div class="cart-header">
            <h2 class="cart-title">TU CARRITO</h2>
            <button class="close-cart">&times;</button>
        </div>
        <div class="cart-items" id="cart-items">
            <!-- Items del carrito se agregarán aquí dinámicamente -->
            <div class="empty-cart">Tu carrito está vacío</div>
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span class="total-label">Total:</span>
                <span class="total-price">S/ 0.00</span>
            </div>
            <button class="checkout-btn">PROCESAR COMPRA</button>
        </div>
    </div>

    <div class="cart-trigger" id="cart-trigger">
        <span class="cart-trigger-icon material-symbols-outlined">shopping_cart</span>
    </div>

    <!-- Modal de Pago -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Realizar Pago</h2>
            <form id="payment-form">
                <div class="form-group">
                    <label for="card-number">Número de Tarjeta</label>
                    <input type="text" id="card-number" placeholder="XXXX XXXX XXXX XXXX" 
                    maxlength="19" inputmode="numeric" required pattern="\d{4} \d{4} \d{4} \d{4}">
                </div>
                <div class="form-group">
                    <label for="card-name">Nombre en la Tarjeta</label>
                    <input type="text" id="card-name" placeholder="Nombre Completo" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry-date">Fecha de Vencimiento</label>
                        <input type="text" id="expiry-date" placeholder="MM/AA" maxlength="5"  pattern="(0[1-9]|1[0-2])\/\d{2}" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" placeholder="XXX" maxlength="3" pattern="\d{3}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total-amount">Monto Total</label>
                    <input type="text" id="total-amount" readonly>
                </div>
                <button type="submit" class="pay-button">Pagar Ahora</button>
            </form>
        </div>
    </div>

    <!--FOOTER SECTION-->
    <footer>
        <?php
        require_once('templates/footer.php');
        ?>
    </footer>
</body>

</html>