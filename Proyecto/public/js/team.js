const tabla = document.getElementById("tabla-empleados");
const form = document.getElementById("form-empleado");
const modal = new bootstrap.Modal(document.getElementById("modalForm"));

function cargarEmpleados() {
  fetch("/controlador/TeamController.php?action=list")
    .then(r => r.json())
    .then(data => {
      tabla.innerHTML = "";
      data.forEach(emp => {
        tabla.innerHTML += `
          <tr>
            <td>${emp.id}</td>
            <td>${emp.nombre}</td>
            <td>${emp.apellido}</td>
            <td>${emp.cargo}</td>
            <td>${emp.email}</td>
            <td><button class="btn btn-warning btn-sm" onclick='editar(${JSON.stringify(emp)})'>Editar</button></td>
            <td><button class="btn btn-danger btn-sm" onclick='eliminar(${emp.id})'>Eliminar</button></td>
          </tr>
        `;
      });
    });
}

form.addEventListener("submit", function(e) {
  e.preventDefault();
  const datos = new FormData(form);
  const accion = datos.get("id") ? "update" : "insert";

  fetch(`../controlador/TeamController.php?action=${accion}`, {
    method: "POST",
    body: datos
  })
  .then(r => r.text())
  .then(() => {
    cargarEmpleados();
    form.reset();
    modal.hide();
  });
});

function editar(emp) {
  form.nombre.value = emp.nombre;
  form.apellido.value = emp.apellido;
  form.cargo.value = emp.cargo;
  form.email.value = emp.email;
  form.id.value = emp.id;
  document.getElementById("modalTitle").textContent = "Editar Empleado";
  modal.show();
}

function eliminar(id) {
  if (confirm("¿Estás seguro de eliminar este empleado?")) {
    const datos = new FormData();
    datos.append("id", id);

    fetch("/controlador/TeamController.php?action=delete", {
      method: "POST",
      body: datos
    })
    .then(() => cargarEmpleados());
  }
}

cargarEmpleados();