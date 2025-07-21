document.addEventListener('DOMContentLoaded', function () {
    const checkoutBtn = document.querySelector('.checkout-btn');
    const paymentModal = document.getElementById('paymentModal');
    const closeButton = document.querySelector('.close-button');
    const totalAmountInput = document.getElementById('total-amount');
    const paymentForm = document.getElementById('payment-form');

    const cardNumberInput = document.getElementById('card-number');

    cardNumberInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Solo números
        value = value.substring(0, 16); // Max 16 dígitos

        // Agrupar cada 4 dígitos
        const formatted = value.replace(/(\d{4})(?=\d)/g, '$1 ').trim();

        e.target.value = formatted;
    });

    // Validar solo números al pegar
    cardNumberInput.addEventListener('paste', function (e) {
        e.preventDefault();
        let pasted = (e.clipboardData || window.clipboardData).getData('text');
        pasted = pasted.replace(/\D/g, '').substring(0, 16);
        const formatted = pasted.replace(/(\d{4})(?=\d)/g, '$1 ').trim();
        cardNumberInput.value = formatted;
    });

    const expiryInput = document.getElementById('expiry-date');

    expiryInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '').slice(0, 4);
        if (value.length >= 3) {
            value = value.replace(/(\d{2})(\d{1,2})/, '$1/$2');
        }
        e.target.value = value;
    });


    // Abrir el modal de pago al hacer clic en "PROCESAR COMPRA"
    checkoutBtn.addEventListener('click', function () {
        const totalPrice = document.querySelector('.total-price').textContent;
        totalAmountInput.value = totalPrice; // Asignar el total del carrito al campo del modal
        paymentModal.style.display = 'flex'; // Mostrar el modal
    });

    // Cerrar el modal al hacer clic en la "x"
    closeButton.addEventListener('click', function () {
        paymentModal.style.display = 'none';
    });

    // Cerrar el modal al hacer clic fuera del contenido del modal
    window.addEventListener('click', function (event) {
        if (event.target === paymentModal) {
            paymentModal.style.display = 'none';
        }
    });

    // Manejar el envío del formulario de pago
    paymentForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevenir el envío por defecto del formulario

        alert('Pago procesado con éxito por ' + totalAmountInput.value + '!');

        // Limpiar el carrito
        if (typeof window.setCartItems === 'function') {
            window.setCartItems([]); // Esta función actualiza cartItems, el DOM y el localStorage
        } else {
            console.warn("setCartItems no está disponible para limpiar el carrito.");
        }

        // Ocultar el modal de pago
        paymentModal.style.display = 'none';
    });

});
