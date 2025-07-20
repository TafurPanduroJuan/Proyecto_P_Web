document.addEventListener("DOMContentLoaded", function () {
  const botonesEditar = document.querySelectorAll(".btn-editar");

  botonesEditar.forEach((btn) => {
    btn.addEventListener("click", function () {
      // Se llenan los campos con datos
      document.getElementById("inputId").value = this.dataset.id;
      document.querySelector("[name='nombre']").value = this.dataset.nombre;
      document.querySelector("[name='apellido']").value = this.dataset.apellido;
      document.querySelector("[name='cargo']").value = this.dataset.cargo;
      document.querySelector("[name='email']").value = this.dataset.email;

      // Se cambia el título 
      document.getElementById("modalTitle").textContent = "Editar Empleado";
    });
  });

  // Limpieza al cerrar el modal
  const modal = document.getElementById("modalForm");
  modal.addEventListener("hidden.bs.modal", function () {
    const form = document.getElementById("form-empleado");
    form.reset(); // Vacía los campos
    document.getElementById("inputId").value = ""; // Vacía el ID
    document.getElementById("modalTitle").textContent = "Nuevo Empleado"; // Restaura el título
  });

  // Limpieza al abrir el modal 
  const botonAgregar = document.querySelector("[data-bs-target='#modalForm']");
  botonAgregar.addEventListener("click", function () {
    const form = document.getElementById("form-empleado");
    form.reset(); 
    document.getElementById("inputId").value = ""; 
    document.getElementById("modalTitle").textContent = "Nuevo Empleado";
  });
});