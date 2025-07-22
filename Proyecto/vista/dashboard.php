<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location:/Proyecto_P_Web/Proyecto/vista/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/dashboard.css">

</head>

<body>
    <section id="sidebar">

        <span class="brand">Panel Administrador</span>

        <ul class="sidebar sidebar__top">
            <li>
                <a href="#">
                    <i class='bxr bx-home'></i>
                    <span class="text">Home</span>
                </a>
            </li>
            <li>
                <a href="../vista/productos.php">
                    <i class='bxr  bx-chart-bar-big-columns'></i>
                    <span class="text">Productos</span>
                </a>
            </li>
            <li>
                <a href="../vista/Ventas.php">
                    <i class='bxr  bx-envelope'></i>
                    <span class="text">Ventas</span>
                </a>
            </li>
            <li>
                <a href="../vista/team.php">
                    <i class='bxr  bx-user-id-card'></i>
                    <span class="text">Equipo</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar sidebar__bottom">
            <li>
                <a href="../controlador/LogoutController.php">
                    <i class='bxr  bx-circle'></i>
                    <span class="text">Cerrar Sesion</span>
                </a>
            </li>
        </ul>
    </section>

    <section id="content">
        <nav>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <div></div>
            <a href="#" class="user">
                <i class='bx bx-user'></i>
                <span class="text">Admin</span>
            </a>
        </nav>

        <main>
            <ul class="box-info">
                <li>
                    <i class='bx bxs-calendar-check'></i>
                    <div class="text">
                        <h3>1020</h3>
                        <p>Nuevas ordenes</p>
                    </div>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <div class="text">
                        <h3>2834</h3>
                        <p>Visitantes</p>
                    </div>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <div class="text">
                        <h3>$2543</h3>
                        <p>Ventas Totales</p>
                    </div>
                </li>
            </ul>

            <div class="main__dashboard">
                <div class="customers">
                    <h3>Ultimas Ventas</h3>
                    <div class="table__customer">
                        <table>
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <p>Fabrizio Medina</p>
                                    </td>
                                    <td>12-07-2025</td>
                                    <td><span class="status completed">Completado</span></td>

                                </tr>
                                <tr>
                                    <td>
                                        <p>Juan Miguel</p>
                                    </td>
                                    <td>12-07-2025</td>
                                    <td><span class="status pending">Pendiente</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Juan Ocsa</p>
                                    </td>
                                    <td>12-07-2025</td>
                                    <td><span class="status process">En Proceso</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Hilario Ccucho</p>
                                    </td>
                                    <td>12-07-2025</td>
                                    <td><span class="status pending">Pendiente</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Jeshua Yola</p>
                                    </td>
                                    <td>12-07-2025</td>
                                    <td><span class="status completed">Completado</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="task__module">
                    <form id="formulario">
                        <H3>Tareas</H3>
                        <input type="text" id="task" name="task" placeholder="Nombre de tarea..." required
                            autocomplete="off">
                        <button type="submit">Agregar</button>
                    </form>
                    <div class="task_container"></div>
                </div>
            </div>
        </main>
    </section>
    <script src="../public/js/DashboarTask.js"></script>
</body>

</html>