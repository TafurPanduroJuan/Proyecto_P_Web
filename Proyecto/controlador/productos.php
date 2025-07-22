<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/conexion.php'; // Asegúrate de que la ruta sea correcta

$action = $_GET['action'] ?? '';

// Función para obtener las categorías
function getCategorias($conexion) {
    $categorias = [];
    $sql = "SELECT id, nombre FROM categorias";
    $resultado = $conexion->query($sql);
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $categorias[] = $fila;
        }
    }
    return $categorias;
}

// Función para obtener las especificaciones de un producto por su ID y categoría
function getProductoConEspecificaciones($conexion, $producto_id, $categoria_id) {
    $producto = [];
    // Obtener datos generales del producto
    $stmt = $conexion->prepare("SELECT p.id, p.nombre, p.precio, p.imagen, c.nombre as categoria_nombre FROM productos p JOIN categorias c ON p.categoria_id = c.id WHERE p.id = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();

        // Obtener especificaciones según la categoría
        switch ($categoria_id) {
            case 1: // Audífonos
                $stmt_esp = $conexion->prepare("SELECT tipo, conexion, luces FROM audifonos WHERE producto_id = ?");
                break;
            case 2: // Monitores
                $stmt_esp = $conexion->prepare("SELECT pantalla, resolucion, frecuencia, panel FROM monitores WHERE producto_id = ?");
                break;
            case 3: // Mouse
                $stmt_esp = $conexion->prepare("SELECT tipo, dpi, conexion FROM mouses WHERE producto_id = ?");
                break;
            case 4: // Teclados
                $stmt_esp = $conexion->prepare("SELECT tipo, idioma, conectividad, iluminacion FROM teclados WHERE producto_id = ?");
                break;
            default:
                $stmt_esp = null;
                break;
        }

        if ($stmt_esp) {
            $stmt_esp->bind_param("i", $producto_id);
            $stmt_esp->execute();
            $resultado_esp = $stmt_esp->get_result();
            if ($resultado_esp->num_rows > 0) {
                $especificaciones = $resultado_esp->fetch_assoc();
                $producto = array_merge($producto, $especificaciones);
            }
        }
    }
    return $producto;
}

// Lógica para listar productos (incluyendo categoría)
if ($action === 'list') {
    $productos = [];
    $sql = "SELECT p.id, p.nombre, p.precio, p.imagen, c.nombre as categoria_nombre, c.id as categoria_id FROM productos p JOIN categorias c ON p.categoria_id = c.id";
    $resultado = $conexion->query($sql);
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }
    }
    echo json_encode($productos);
}

// Lógica para insertar/actualizar productos
elseif ($action === 'insert' || $action === 'update') {
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria_id = $_POST['categoria'];
    $imagen = $_POST['imagen'] ?? ''; // Asume que la imagen se maneja como una URL o ruta

    // Manejo de la imagen (simplificado para el ejemplo)
    // En un entorno real, deberías subir el archivo y guardar su ruta.
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../public/imgs/catalogo_imgs/'; // Directorio donde guardar las imágenes
        $imageFileName = basename($_FILES['imagen']['name']);
        $imagePath = $uploadDir . $imageFileName;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagePath)) {
            $imagen = '/Proyecto_P_Web/Proyecto/public/imgs/catalogo_imgs/' . $imageFileName;
        } else {
            // Manejar error de subida
            echo "Error al subir la imagen.";
            exit;
        }
    } elseif ($action === 'update' && empty($imagen)) {
        // Si es una actualización y no se sube nueva imagen, mantener la existente
        $stmt_old_img = $conexion->prepare("SELECT imagen FROM productos WHERE id = ?");
        $stmt_old_img->bind_param("i", $id);
        $stmt_old_img->execute();
        $result_old_img = $stmt_old_img->get_result();
        if ($result_old_img->num_rows > 0) {
            $imagen = $result_old_img->fetch_assoc()['imagen'];
        }
    }

    if ($action === 'insert') {
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, precio, imagen, categoria_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdsi", $nombre, $precio, $imagen, $categoria_id);
        $success = $stmt->execute();
        $producto_id = $conexion->insert_id;
    } elseif ($action === 'update') {
        $stmt = $conexion->prepare("UPDATE productos SET nombre = ?, precio = ?, imagen = ?, categoria_id = ? WHERE id = ?");
        $stmt->bind_param("sdsii", $nombre, $precio, $imagen, $categoria_id, $id);
        $success = $stmt->execute();
        $producto_id = $id;
    }

    if ($success) {
        // Insertar/Actualizar especificaciones
        $especificaciones_success = true;
        switch ($categoria_id) {
            case 1: // Audífonos
                $tipo = $_POST['tipo'] ?? null;
                $conexion_esp = $_POST['conexion_esp'] ?? null; // Renombrado para evitar conflicto con la conexión de la DB
                $luces = $_POST['luces'] ?? null;
                if ($action === 'insert') {
                    $stmt_esp = $conexion->prepare("INSERT INTO audifonos (producto_id, tipo, conexion, luces) VALUES (?, ?, ?, ?)");
                    $stmt_esp->bind_param("isss", $producto_id, $tipo, $conexion_esp, $luces);
                } else {
                    $stmt_esp = $conexion->prepare("UPDATE audifonos SET tipo = ?, conexion = ?, luces = ? WHERE producto_id = ?");
                    $stmt_esp->bind_param("sssi", $tipo, $conexion_esp, $luces, $producto_id);
                }
                $especificaciones_success = $stmt_esp->execute();
                break;
            case 2: // Monitores
                $pantalla = $_POST['pantalla'] ?? null;
                $resolucion = $_POST['resolucion'] ?? null;
                $frecuencia = $_POST['frecuencia'] ?? null;
                $panel = $_POST['panel'] ?? null;
                if ($action === 'insert') {
                    $stmt_esp = $conexion->prepare("INSERT INTO monitores (producto_id, pantalla, resolucion, frecuencia, panel) VALUES (?, ?, ?, ?, ?)");
                    $stmt_esp->bind_param("issss", $producto_id, $pantalla, $resolucion, $frecuencia, $panel);
                } else {
                    $stmt_esp = $conexion->prepare("UPDATE monitores SET pantalla = ?, resolucion = ?, frecuencia = ?, panel = ? WHERE producto_id = ?");
                    $stmt_esp->bind_param("ssssi", $pantalla, $resolucion, $frecuencia, $panel, $producto_id);
                }
                $especificaciones_success = $stmt_esp->execute();
                break;
            case 3: // Mouse
                $tipo = $_POST['tipo'] ?? null;
                $dpi = $_POST['dpi'] ?? null;
                $conexion_esp = $_POST['conexion_esp'] ?? null;
                if ($action === 'insert') {
                    $stmt_esp = $conexion->prepare("INSERT INTO mouses (producto_id, tipo, dpi, conexion) VALUES (?, ?, ?, ?)");
                    $stmt_esp->bind_param("isss", $producto_id, $tipo, $dpi, $conexion_esp);
                } else {
                    $stmt_esp = $conexion->prepare("UPDATE mouses SET tipo = ?, dpi = ?, conexion = ? WHERE producto_id = ?");
                    $stmt_esp->bind_param("sssi", $tipo, $dpi, $conexion_esp, $producto_id);
                }
                $especificaciones_success = $stmt_esp->execute();
                break;
            case 4: // Teclados
                $tipo = $_POST['tipo'] ?? null;
                $idioma = $_POST['idioma'] ?? null;
                $conectividad = $_POST['conectividad'] ?? null;
                $iluminacion = $_POST['iluminacion'] ?? null;
                if ($action === 'insert') {
                    $stmt_esp = $conexion->prepare("INSERT INTO teclados (producto_id, tipo, idioma, conectividad, iluminacion) VALUES (?, ?, ?, ?, ?)");
                    $stmt_esp->bind_param("issss", $producto_id, $tipo, $idioma, $conectividad, $iluminacion);
                } else {
                    $stmt_esp = $conexion->prepare("UPDATE teclados SET tipo = ?, idioma = ?, conectividad = ?, iluminacion = ? WHERE producto_id = ?");
                    $stmt_esp->bind_param("ssssi", $tipo, $idioma, $conectividad, $iluminacion, $producto_id);
                }
                $especificaciones_success = $stmt_esp->execute();
                break;
        }

        if ($especificaciones_success) {
            echo ($action === 'insert') ? "Producto agregado" : "Producto actualizado";
        } else {
            echo "Error al guardar especificaciones.";
        }
    } else {
        echo "Error al guardar el producto.";
    }
}

// Lógica para eliminar productos
elseif ($action === 'delete') {
    $id = $_POST['id'];
    // Primero eliminar de las tablas de especificaciones (si existen)
    $stmt_cat = $conexion->prepare("SELECT categoria_id FROM productos WHERE id = ?");
    $stmt_cat->bind_param("i", $id);
    $stmt_cat->execute();
    $result_cat = $stmt_cat->get_result();
    if ($result_cat->num_rows > 0) {
        $categoria_id = $result_cat->fetch_assoc()['categoria_id'];
        switch ($categoria_id) {
            case 1: $conexion->query("DELETE FROM audifonos WHERE producto_id = $id"); break;
            case 2: $conexion->query("DELETE FROM monitores WHERE producto_id = $id"); break;
            case 3: $conexion->query("DELETE FROM mouses WHERE producto_id = $id"); break;
            case 4: $conexion->query("DELETE FROM teclados WHERE producto_id = $id"); break;
        }
    }

    // Luego eliminar de la tabla principal de productos
    $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Producto eliminado";
    } else {
        echo "Error al eliminar el producto.";
    }
}

// Lógica para obtener un producto específico con sus especificaciones (para edición)
elseif ($action === 'get_product') {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("SELECT categoria_id FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $categoria_id = $result->fetch_assoc()['categoria_id'];
        $producto = getProductoConEspecificaciones($conexion, $id, $categoria_id);
        echo json_encode($producto);
    } else {
        echo json_encode([]);
    }
}

// Lógica para obtener las categorías (para el select en el modal)
elseif ($action === 'get_categories') {
    echo json_encode(getCategorias($conexion));
}

$conexion->close();
?>
