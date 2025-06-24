document.addEventListener('DOMContentLoaded', function() {
    const cart = document.getElementById('cart');
    const cartTrigger = document.getElementById('cart-trigger');
    const closeCart = document.querySelector('.close-cart');
    const cartItemsContainer = document.getElementById('cart-items');
    const checkoutBtn = document.querySelector('.checkout-btn');
    
    // Carrito en memoria
    let cartItems = JSON.parse(localStorage.getItem('terosCart')) || [];
    
    // --- Funciones del Carrito ---
    
    function renderCartItems() {
        cartItemsContainer.innerHTML = '';
        
        if (cartItems.length === 0) {
            cartItemsContainer.innerHTML = '<div class="empty-cart">Tu carrito está vacío</div>';
            return;
        }
        
        cartItems.forEach((item, index) => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.dataset.id = item.id;
            cartItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}">
                <div class="item-details">
                    <h3 class="item-name">${item.name}</h3>
                    <p class="item-price">S/ ${item.price.toFixed(2)}</p>
                    <div class="item-quantity">
                        <button class="quantity-btn minus">-</button>
                        <span class="quantity">${item.quantity}</span>
                        <button class="quantity-btn plus">+</button>
                        <button class="remove-item">Eliminar</button>
                    </div>
                </div>
            `;
            cartItemsContainer.appendChild(cartItem);
        });
        
        setupCartItemEvents();
        updateTotal();
    }
    
    function updateTotal() {
        const total = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        document.querySelector('.total-price').textContent = `S/ ${total.toFixed(2)}`;
        localStorage.setItem('terosCart', JSON.stringify(cartItems));
    }
    
    function setupCartItemEvents() {
        document.querySelectorAll('.quantity-btn.minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.closest('.cart-item').dataset.id;
                const itemIndex = cartItems.findIndex(item => item.id === itemId);
                
                if (cartItems[itemIndex].quantity > 1) {
                    cartItems[itemIndex].quantity--;
                } else {
                    cartItems.splice(itemIndex, 1);
                }
                
                renderCartItems();
            });
        });
        
        document.querySelectorAll('.quantity-btn.plus').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.closest('.cart-item').dataset.id;
                const itemIndex = cartItems.findIndex(item => item.id === itemId);
                cartItems[itemIndex].quantity++;
                renderCartItems();
            });
        });
        
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.closest('.cart-item').dataset.id;
                cartItems = cartItems.filter(item => item.id !== itemId);
                renderCartItems();
            });
        });
    }
    
    function addToCart(product) {
        const existingItem = cartItems.find(item => item.id === product.id);
        
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cartItems.push({
                ...product,
                quantity: 1
            });
        }
        
        renderCartItems();
        cart.style.right = '0'; // Mostrar carrito al agregar
    }
    
    // --- Event Listeners ---
    
    cartTrigger.addEventListener('mouseenter', () => cart.style.right = '0');
    cart.addEventListener('mouseleave', () => cart.style.right = '-400px');
    closeCart.addEventListener('click', () => cart.style.right = '-400px');
    
    // Delegación de eventos para botones "Agregar al carrito"
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart-btn')) {
            const productElement = e.target.closest('.id-producto');
            const productId = productElement.dataset.id;
            const productName = productElement.querySelector('h4').textContent;
            const productPrice = parseFloat(productElement.querySelector('p').textContent.replace('S/ ', ''));
            const productImage = productElement.querySelector('img').src;
            
            addToCart({
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage
            });
        }
    });
    
    checkoutBtn.addEventListener('click', function() {
        alert('¡Gracias por tu compra! Total: ' + document.querySelector('.total-price').textContent);
        cartItems = [];
        renderCartItems();
    });
    
    // Inicializar
    renderCartItems();
});
