document.addEventListener("DOMContentLoaded", function () {
  const tablaVentas = document.getElementById("tabla-ventas");

  // Función para cargar y mostrar las órdenes en la tabla
  async function loadOrders() {
    try {
      const response = await fetch(
        "../controlador/VentasController.php?action=list"
      );
      const orders = await response.json();
      console.log("Órdenes recibidas:", orders); // Verifica que se reciban las órdenes
      tablaVentas.innerHTML = ""; // Limpiar tabla

      if (orders.length === 0) {
        tablaVentas.innerHTML =
          '<tr><td colspan="4" class="text-center">No hay ventas registradas.</td></tr>'; // Colspan ajustado
        return;
      }

      orders.forEach((order) => {
        const row = tablaVentas.insertRow();
        row.innerHTML = `
                    <td class="text-center">${order.id}</td>
                    <td class="text-center">${order.fecha_orden}</td>
                    <td class="text-center">${
                      order.nombre_completo_cliente
                    }</td>
                    <td class="text-center">S/ ${parseFloat(
                      order.monto_total
                    ).toFixed(2)}</td>
                `;
      });
    } catch (error) {
      console.error("Error al cargar órdenes:", error);
      tablaVentas.innerHTML =
        '<tr><td colspan="4" class="text-center text-danger">Error al cargar las ventas.</td></tr>'; // Colspan ajustado
    }
  }

  // Cargar las órdenes al iniciar la página
  loadOrders();
});
