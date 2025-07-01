<?php
session_start();
if(empty($_SESSION["id"])){
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
<!-- SIDEBAR -->
	<section id="sidebar">

        <a href="#" class="brand">
			<span class="text">ADMIN PANEL</span>
        </a>
        
        <ul class="side-menu top">
            <li>
                <a href="#">
                    <i class='bxr bx-home'></i>
				    <span class="text">Home</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bxr  bx-chart-bar-big-columns'></i> 
                    <span class="text">Productos</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bxr  bx-envelope'></i> 
                    <span class="text">Ventas</span>
                </a>
            </li>
            <li>
                <a href="../vista/team.php">
                    <i class='bxr  bx-user-id-card'></i> 
				    <span class="text">Team</span>
                </a>
            </li>
        </ul>

        <ul class="side-menu">
            <li>
                <a href="../controlador/LogoutController.php">
                    <i class='bxr  bx-circle'></i> 
				    <span class="text">Logout</span>
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
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>Nuevas ordenes</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Visitantes</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>$2543</h3>
						<p>Ventas Totales</p>
					</span>
				</li>
			</ul>
         </main>
    </section>

    
    <script src="../js/dashboard.js"></script>
</body>
</html>
