<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Gestión de Productos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS (v5.3+) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
  <div class="d-flex justify-content-end mb-3">
    <a href="../vista/dashboard.php"
      class="btn btn-danger d-flex align-items-center justify-content-center gap-2 px-3 py-2 rounded shadow-sm mx-5 mt-4">
      <span class="material-symbols-outlined">arrow_back</span>
      <span>Volver</span>
    </a>
  </div>

  <div class="container mt-4">
    <h3>Productos</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" id="btn-add-product">+ Agregar Producto</button>

    <table class="table table-bordered table-striped table-hover table-primary rounded">
      <thead>
        <tr class="text-center">
          <th>ID</th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Categoría</th>
          <th>Imagen</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody id="tabla-productos">
        <!-- Los productos se cargarán aquí dinámicamente con JavaScript -->
      </tbody>
    </table>
  </div>

  <!-- Modal para Agregar/Editar Producto -->
  <div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog">
      <form method="POST" id="form-producto" class="modal-content" enctype="multipart/form-data">
        <input type="hidden" name="id" id="inputId">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Nuevo Producto</h5>
        </div>
        <div class="modal-body">
          <input class="form-control mb-2" name="nombre" id="product-name" placeholder="Nombre del Producto" required>
          <input class="form-control mb-2" name="precio" id="product-price" placeholder="Precio del producto" type="number" step="0.01" required>
          
          <select class="form-select mb-2" name="categoria" id="product-category" required>
            <option value="">Seleccione la categoria del producto</option>
            <!-- Las categorías se cargarán aquí dinámicamente -->
          </select>

          <!-- Contenedor para las especificaciones dinámicas -->
          <div id="dynamic-specs-container">
            <!-- Aquí se cargarán los campos de especificaciones según la categoría -->
          </div>

          <label for="product-image" class="form-label mt-2">Imagen del Producto:</label>
          <input type="file" class="form-control mb-2" name="imagen" id="product-image" accept="image/*">
          <input type="hidden" name="current_image" id="current-image-path"> <!-- Para guardar la ruta actual de la imagen en edición -->
          <img id="image-preview" src="" alt="Previsualización" style="max-width: 100px; max-height: 100px; margin-top: 10px; display: none;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success" name="btnGuardar" value="ok">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap + JS personalizado -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../public/js/productos_admin.js"></script>
</body>

</html>
