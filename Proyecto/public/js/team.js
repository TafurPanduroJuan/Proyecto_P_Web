document.addEventListener("DOMContentLoaded", function () {
  const botonesEditar = document.querySelectorAll(".btn-editar");

  botonesEditar.forEach((btn) => {
    btn.addEventListener("click", function () {
      //Se llenan los campos
      document.getElementById("inputId").value = this.dataset.id;
      document.querySelector("[name='nombre']").value = this.dataset.nombre;
      document.querySelector("[name='apellido']").value = this.dataset.apellido;
      document.querySelector("[name='cargo']").value = this.dataset.cargo;
      document.querySelector("[name='email']").value = this.dataset.email;

      //Cambio del titulo
      document.getElementById("modalTitle").textContent = "Editar Empleado";
    });
  });
});
