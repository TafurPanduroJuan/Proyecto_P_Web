<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location:/Proyecto_P_Web/Proyecto/vista/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Ventas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (v5.3+) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Estilos del Dashboard para mantener la estética del sidebar y botones -->
    <link rel="stylesheet" href="../public/css/dashboard.css">
    <style>
        /* Estilos específicos para la tabla de ventas si es necesario */
        .table-sales th,
        .table-sales td {
            vertical-align: middle;
        }
    </style>
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
        <h3>Ventas</h3>


        <table class="table table-bordered table-striped table-hover table-primary rounded table-sales">
            <thead>
                <tr class="text-center">
                    <th>ID Orden</th>
                    <th>Fecha</th>
                    <th>Nombre Cliente</th>
                    <th>Monto Total</th>

                </tr>
            </thead>
            <tbody id="tabla-ventas">
                <!-- Las ventas se cargarán aquí dinámicamente con JavaScript -->
            </tbody>
        </table>
    </div>


    <!-- Bootstrap + JS personalizado -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/ventas.js"></script>
</body>

</html>