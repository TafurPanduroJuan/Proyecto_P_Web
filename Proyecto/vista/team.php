<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Gestión de Empleados</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS (v5.3+) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>

  <!-- Tu contenido -->
  <div class="container mt-4">
    <h3>Empleados</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm">+ Agregar</button>

    <table class="table table-bordered table-striped, table-hover table-primary rounded">
      <thead>
        <tr class="text-center">
          <th>Código</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Cargo</th>
          <th>Email</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody id="tabla-empleados">
        <?php
        include "../config/conexion.php";
        $sql = $conexion->query("SELECT * FROM empleados");
        while ($datos = $sql->fetch_object()) {
          ?>
          <tr class="text-center">
            <td><?= $datos->id ?></td>
            <td><?= $datos->nombre ?></td>
            <td><?= $datos->apellido ?></td>
            <td><?= $datos->cargo ?></td>
            <td><?= $datos->email ?></td>
            <td class="text-center">
              <button class="btn btn-small btn-warning btn-editar" data-id="<?= $datos->id ?>"
                data-nombre="<?= $datos->nombre ?>" data-apellido="<?= $datos->apellido ?>"
                data-cargo="<?= $datos->cargo ?>" data-email="<?= $datos->email ?>" data-bs-toggle="modal"
                data-bs-target="#modalForm">

                <span class="material-symbols-outlined ">edit</span>
              </button>
            </td>
            <?php
            include "../config/conexion.php";
            ?>
            <td class="text-center">
              <form method="POST" action="../controlador/TeamController.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= $datos->id ?>">
                <button type="submit" name="btnEliminar" class="btn btn-small btn-danger">
                  <span class="material-symbols-outlined">delete</span>
                </button>
              </form>
            </td>
          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>
  <?php
  include "../config/conexion.php";
  ?>
  <!-- Modal -->
  <div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog">
      <form method="POST" id="form-empleado" class="modal-content" action="../controlador/TeamController.php">
        <input type="hidden" name="id" id="inputId">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Nuevo Empleado</h5>
        </div>
        <div class="modal-body">
          <input class="form-control mb-2" name="nombre" placeholder="Nombre" required>
          <input class="form-control mb-2" name="apellido" placeholder="Apellido" required>
          <input class="form-control mb-2" name="cargo" placeholder="Cargo" required>
          <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal" name="btnCancelar">Cancelar</button>
          <button type="submit" class="btn btn-success" name="btnGuardar" value="ok">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap + JS personalizado -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../public/js/team.js"></script>
</body>

</html>