<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Empleados</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS (v5.3+) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Tu contenido -->
  <div class="container mt-4">
    <h3>Empleados</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm">+ Agregar</button>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Código</th><th>Nombre</th><th>Apellido</th><th>Cargo</th><th>Email</th><th>Editar</th><th>Eliminar</th>
        </tr>
      </thead>
      <tbody id="tabla-empleados"></tbody>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog">
      <form id="form-empleado" class="modal-content">
        <input type="hidden" name="id" id="inputId">
        <div class="modal-header"><h5 class="modal-title" id="modalTitle">Nuevo Empleado</h5></div>
        <div class="modal-body">
          <input class="form-control mb-2" name="nombre" placeholder="Nombre" required>
          <input class="form-control mb-2" name="apellido" placeholder="Apellido" required>
          <input class="form-control mb-2" name="cargo" placeholder="Cargo" required>
          <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap + JS personalizado -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../public/js/team.js"></script> 
</body>
</html>