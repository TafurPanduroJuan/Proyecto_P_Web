-- Establecer el modo SQL y la zona horaria
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Crear base de datos y seleccionarla
CREATE DATABASE IF NOT EXISTS `terosempresa`;
USE `terosempresa`;

-- Crear tabla empleados
CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos en empleados
INSERT INTO `empleados` (`id`, `nombre`, `apellido`, `cargo`, `email`, `creado`) VALUES
(1, 'Juan Pablo', 'Ramírez Peña', 'Desarrollador', 'JPramirez@gmail.com', '2025-07-19 01:30:15'),
(2, 'Nicole Alejandra', 'Puma Sanchez', 'Administradora', 'AlePuma@gmail.com', '2025-07-19 01:31:25'),
(19, 'Miguel Fernando', 'Noriega Martinez', 'Contador', 'MPerezFer@gmail.com', '2025-07-19 17:24:40'),
(36, 'Luz Marina', 'Ayala Romero', 'Marketing', 'LuzMarina2018@gmail.com', '2025-07-19 17:41:51'),
(41, 'Ana Paula', 'Human Polo', 'Ventas', 'AnaPaula@gmail.com', '2025-07-19 17:44:55'),
(65, 'Joaquín Andrés', 'Torres Valverde', 'Gerente', 'JAndres@gmail.com', '2025-07-19 18:08:23'),
(71, 'Esteban Luis', 'Cáceres Salazar', 'Marketing', 'Esteban2001@gmail.com', '2025-07-19 18:18:29');

-- Crear tabla usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos en usuarios
INSERT INTO `usuarios` (`id`, `usuario`, `email`, `clave`, `fecha_registro`) VALUES
(1, 'Diego OC', 'diego@gmail.com', '$2y$10$TVUYap5fS8qEExw2EWD13.iDew2QUvCw8GjuxeWzYLw3xHmklPxAW', '2025-07-19 23:22:32');

-- Ajustar valores de AUTO_INCREMENT
ALTER TABLE `empleados` AUTO_INCREMENT = 86;
ALTER TABLE `usuarios` AUTO_INCREMENT = 2;

-- Tabla de categorías
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Tabla general de productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255),
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabla audífonos
CREATE TABLE audifonos (
    producto_id INT PRIMARY KEY,
    tipo VARCHAR(50),
    conexion VARCHAR(50),
    luces VARCHAR(50),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla monitores
CREATE TABLE monitores (
    producto_id INT PRIMARY KEY,
    pantalla VARCHAR(10),
    resolucion VARCHAR(20),
    frecuencia VARCHAR(10),
    panel VARCHAR(20),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla mouse
CREATE TABLE mouses (
    producto_id INT PRIMARY KEY,
    tipo VARCHAR(50),
    dpi VARCHAR(20),
    conexion VARCHAR(50),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla teclados
CREATE TABLE teclados (
    producto_id INT PRIMARY KEY,
    tipo VARCHAR(50),
    idioma VARCHAR(20),
    conectividad VARCHAR(50),
    iluminacion VARCHAR(50),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

CREATE TABLE IF NOT EXISTS `ordenes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre_completo_cliente` VARCHAR(255) NOT NULL, -- Campo para el nombre completo del cliente
    `monto_total` DECIMAL(10, 2) NOT NULL,
    `fecha_orden` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Insertar categorías
INSERT INTO categorias (nombre) VALUES 
('Audífonos'),
('Monitores'),
('Mouse'),
('Teclados');

-- === Insertar productos y datos específicos ===

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Audífono de conducción de aire TEROS TE-8078R, bluetooth, rojo / gris', 119.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular1.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'Conducción ósea', 'Bluetooth', 'Sin luces');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Audífono inalámbrico ANC TEROS TE-8033N (Headset), negro', 169.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular2.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'Headset', 'Bluetooth', 'Sin luces');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Audífono inalámbrico ANC TEROS TE-8033WP (Headset), blanco', 169.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular3.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'Headset', 'Bluetooth', 'Sin luces');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Audífono inalámbrico TEROS TE-8035N (Headset), negro', 149.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular4.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'Headset', 'Bluetooth', 'Sin luces');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Audífono TEROS TE-8037N (HEADSET), negro', 135.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular5.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'Headset', 'Bluetooth', 'Sin luces');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Audífonos de conducción ósea TEROS TE-8077N, bluetooth, negro', 149.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular6.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'Conducción ósea', 'Bluetooth', 'Sin luces');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Audífonos TEROS TE-80710N, Bluetooth, TWS, Negro', 99.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular7.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'TWS', 'Bluetooth', 'Sin luces');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Audífonos TEROS TE-8072N, Bluetooth, TWS, negro', 89.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular8.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'TWS', 'Bluetooth', 'Sin luces');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Auriculares Gaming TEROS TE-8170N estéreo 7.1, micrófono, conector USB, Negro, Luces RGB', 139.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular9.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'Headset', 'USB', 'RGB');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Auriculares gaming TEROS TE-8171N, estéreo, micrófono, luces RGB', 135.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/auricular10.jpg', 1);
SET @id = LAST_INSERT_ID();
INSERT INTO audifonos VALUES 
(@id, 'Headset', 'USB', 'RGB');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor curvo gaming TEROS TE-2766G, 27″ FHD VA, 180 Hz', 399.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor1.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '27"', 'Full HD', '180Hz', 'VA');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor curvo TEROS TE-3250S, 31.5″ 2K QHD VA, HDMI, DP', 499.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor2.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '31.5"', '2K', '60Hz', 'VA');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor curvo TEROS TE-2473G, 23.8″ FHD VA, HDMI, DP', 699.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor3.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '24"', 'Full HD', '60Hz', 'VA');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor curvo TEROS TE-2401S, 23.8″ FHD VA, HDMI, VGA', 650.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor4.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '24"', 'Full HD', '60Hz', 'VA');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor curvo gaming TEROS TE-2766G, 27″ FHD VA, 180 Hz', 699.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor5.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '27"', 'Full HD', '180Hz', 'VA');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor curvo gaming TEROS TE-2471G, 23.8″ FHD VA, 165 Hz', 699.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor6.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '24"', 'Full HD', '165Hz', 'VA');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor plano gaming TEROS TE-2474G, 24.5″ FHD IPS, 180Hz', 499.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor7.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '24"', 'Full HD', '180Hz', 'IPS');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor plano gaming TEROS TE-2753G, 27″ 2K QHD IPS, 180 Hz', 799.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor8.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '27"', '2K', '180Hz', 'IPS');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor plano TEROS TE-2415S, 23.8″ FHD IPS, HDMI, DP', 599.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor9.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '24"', 'Full HD', '60Hz', 'IPS');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor plano TEROS TE-2712S, 27″ FHD IPS, HDMI, VGA', 699.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor10.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '27"', 'Full HD', '60Hz', 'IPS');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Monitor plano TEROS TE-3252S, 31.5″ 4K UHD VA LED, 60 Hz', 753.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/monitor11.jpg', 2);
SET @id = LAST_INSERT_ID();
INSERT INTO monitores VALUES 
(@id, '31.5"', '4K', '60Hz', 'VA');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Mouse gamer TEROS TE-5180, RGB, 7200 DPI', 45.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/mouse1.jpg', 3);
SET @id = LAST_INSERT_ID();

INSERT INTO mouses VALUES 
(@id, 'Gamer', '7200 DPI', 'Cableado');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Mouse gamer TEROS TE-5166, RGB, 6400 DPI', 35.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/mouse2.jpg', 3);
SET @id = LAST_INSERT_ID();

INSERT INTO mouses VALUES 
(@id, 'Gamer', '6400 DPI', 'Cableado');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Mouse gamer TEROS TE-285, RGB, 7200 DPI', 40.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/mouse3.jpg', 3);
SET @id = LAST_INSERT_ID();

INSERT INTO mouses VALUES 
(@id, 'Gamer', '7200 DPI', 'Cableado');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Mouse gamer TEROS TE-284, RGB, 7200 DPI', 42.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/mouse4.jpg', 3);
SET @id = LAST_INSERT_ID();

INSERT INTO mouses VALUES 
(@id, 'Gamer', '7200 DPI', 'Cableado');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Mouse TEROS TE-066W, inalámbrico, 1600 DPI', 30.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/mouse5.jpg', 3);
SET @id = LAST_INSERT_ID();

INSERT INTO mouses VALUES 
(@id, 'Convencional', '1600 DPI', 'Inalámbrico');

INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Mouse TEROS TE-144, alámbrico, 1000 DPI', 20.0, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/mouse6.jpg', 3);
SET @id = LAST_INSERT_ID();

INSERT INTO mouses VALUES 
(@id, 'Convencional', '1000 DPI', 'Cableado');

-- Teclado 1
INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Teclado gamer mecánico TEROS TE-7380, RGB, Outemu Blue', 99.00, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/teclado1.jpg', 4);
SET @id = LAST_INSERT_ID();
INSERT INTO teclados VALUES (@id, 'Mecánico', 'Español', 'USB 2.0', 'RGB');

-- Teclado 2
INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Teclado gamer mecánico TEROS TE-7381, RGB, Outemu Red', 109.00, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/teclado2.jpg', 4);
SET @id = LAST_INSERT_ID();
INSERT INTO teclados VALUES (@id, 'Mecánico', 'Español', 'USB 2.0', 'RGB');

-- Teclado 3
INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Teclado gamer TEROS TE-7511, membrana, retroiluminado', 69.00, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/teclado3.jpg', 4);
SET @id = LAST_INSERT_ID();
INSERT INTO teclados VALUES (@id, 'Membrana', 'Español', 'USB 2.0', 'RGB');

-- Teclado 4
INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Teclado gamer TEROS TE-7514, membrana, retroiluminado', 65.00, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/teclado4.jpg', 4);
SET @id = LAST_INSERT_ID();
INSERT INTO teclados VALUES (@id, 'Membrana', 'Español', 'USB 2.0', 'RGB');

-- Teclado 5
INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Teclado TEROS TE-100, alámbrico, convencional', 35.00, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/teclado5.jpg', 4);
SET @id = LAST_INSERT_ID();
INSERT INTO teclados VALUES (@id, 'Convencional', 'Español', 'USB 2.0', 'No');

-- Teclado 6
INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES 
('Teclado inalámbrico TEROS TE-108W, multimedia', 45.00, '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/teclado6.jpg', 4);
SET @id = LAST_INSERT_ID();
INSERT INTO teclados VALUES (@id, 'Convencional', 'Español', 'Inalámbrico', 'No');

