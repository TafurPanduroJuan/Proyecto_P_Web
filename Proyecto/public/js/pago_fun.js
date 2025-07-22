document.addEventListener("DOMContentLoaded", function () {
  const checkoutBtn = document.querySelector(".checkout-btn");
  const paymentModal = document.getElementById("paymentModal");
  const closeButton = document.querySelector(".close-button");
  const totalAmountInput = document.getElementById("total-amount");
  const paymentForm = document.getElementById("payment-form");

  const cardNumberInput = document.getElementById("card-number");
  const cardNameInput = document.getElementById("card-name"); // Obtener el campo del nombre del cliente

  cardNumberInput.addEventListener("input", function (e) {
    let value = e.target.value.replace(/\D/g, ""); // Solo números
    value = value.substring(0, 16); // Max 16 dígitos
    const formatted = value.replace(/(\d{4})(?=\d)/g, "$1 ").trim();
    e.target.value = formatted;
  });

  cardNumberInput.addEventListener("paste", function (e) {
    e.preventDefault();
    let pasted = (e.clipboardData || window.clipboardData).getData("text");
    pasted = pasted.replace(/\D/g, "").substring(0, 16);
    const formatted = pasted.replace(/(\d{4})(?=\d)/g, "$1 ").trim();
    cardNumberInput.value = formatted;
  });

  const expiryInput = document.getElementById("expiry-date");
  expiryInput.addEventListener("input", function (e) {
    let value = e.target.value.replace(/\D/g, "").slice(0, 4);
    if (value.length >= 3) {
      value = value.replace(/(\d{2})(\d{1,2})/, "$1/$2");
    }
    e.target.value = value;
  });

  // Abrir el modal de pago al hacer clic en "PROCESAR COMPRA"
  checkoutBtn.addEventListener("click", function () {
    const totalPrice = document.querySelector(".total-price").textContent;
    totalAmountInput.value = totalPrice; // Asignar el total del carrito al campo del modal
    paymentModal.style.display = "flex"; // Mostrar el modal
  });

  // Cerrar el modal al hacer clic en la "x"
  closeButton.addEventListener("click", function () {
    paymentModal.style.display = "none";
  });

  // Cerrar el modal al hacer clic fuera del contenido del modal
  window.addEventListener("click", function (event) {
    if (event.target === paymentModal) {
      paymentModal.style.display = "none";
    }
  });

  // Manejar el envío del formulario de pago
  paymentForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    const totalAmount = parseFloat(totalAmountInput.value.replace("S/ ", ""));
    const customerName = cardNameInput.value.trim(); // Obtener el nombre del cliente

    // Preparar los datos para enviar al controlador (solo nombre y monto)
    const purchaseData = {
      nombre_completo: customerName,
      monto_total: totalAmount,
    };

    try {
      const response = await fetch(
        "../controlador/VentasController.php?action=process_purchase",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(purchaseData),
        }
      );

      const result = await response.json();

      if (result.success) {
        alert("Pago procesado con éxito por " + totalAmountInput.value + "!");
        // Limpiar el carrito (esto sigue siendo importante para el frontend)
        if (typeof window.setCartItems === "function") {
          window.setCartItems([]);
        }
        // Ocultar el modal de pago
        paymentModal.style.display = "none";
      } else {
        alert("Error al procesar el pago: " + result.message);
      }
    } catch (error) {
      console.error("Error en la solicitud de pago:", error);
      alert("Ocurrió un error de conexión al procesar el pago.");
    }
  });
});
