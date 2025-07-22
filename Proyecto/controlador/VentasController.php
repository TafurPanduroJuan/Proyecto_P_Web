<?php
session_start();
require_once '../config/conexion.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? ''; // Para acciones GET (list)
$method = $_SERVER['REQUEST_METHOD']; // Para diferenciar GET de POST

// Lógica para listar todas las órdenes
if ($action === 'list' && $method === 'GET') {
    $ordenes = [];
    // Seleccionamos solo los campos que nos interesan de la tabla 'ordenes'
    $sql = "SELECT id, nombre_completo_cliente, monto_total, fecha_orden FROM ordenes ORDER BY fecha_orden DESC";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $ordenes[] = $fila;
        }
    }
    echo json_encode($ordenes);
}

// Lógica para procesar la compra (cuando se realiza el pago)
elseif ($action === 'process_purchase' && $method === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // --- MENSAJES DE DEPURACIÓN ---
    error_log("VentasController: Recibida solicitud POST para process_purchase.");
    error_log("VentasController: Datos JSON recibidos: " . print_r($data, true));
    // --- FIN MENSAJES DE DEPURACIÓN ---

    if ($data === null) {
        error_log("VentasController: Error - Datos JSON inválidos.");
        echo json_encode(['success' => false, 'message' => 'Datos JSON inválidos.']);
        exit;
    }

    $nombre_completo = $data['nombre_completo'] ?? 'Cliente Desconocido';
    $monto_total = $data['monto_total'] ?? null;

    if ($monto_total === null) {
        error_log("VentasController: Error - Monto total de compra incompleto o inválido.");
        echo json_encode(['success' => false, 'message' => 'Monto total de compra incompleto o inválido.']);
        exit;
    }



    try {
        // Insertar la orden principal con el nombre completo del cliente y el monto total
        $stmt_orden = $conexion->prepare("INSERT INTO ordenes (nombre_completo_cliente, monto_total, fecha_orden) VALUES (?, ?, NOW())");
        if (!$stmt_orden) {
            $error_msg = "VentasController: Error al preparar la consulta de orden: " . $conexion->error;
            error_log($error_msg);
            throw new Exception($error_msg);
        }
        $stmt_orden->bind_param("sd", $nombre_completo, $monto_total);
        if (!$stmt_orden->execute()) {
            $error_msg = "VentasController: Error al ejecutar la inserción de orden: " . $stmt_orden->error;
            error_log($error_msg);
            throw new Exception($error_msg);
        }
        $orden_id = $conexion->insert_id;
        $stmt_orden->close();



        error_log("VentasController: Compra procesada con éxito. Orden ID: " . $orden_id);
        echo json_encode(['success' => true, 'message' => 'Compra procesada con éxito.']);

    } catch (Exception $e) {

        error_log("VentasController: Excepción al procesar compra: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error al procesar la compra: ' . $e->getMessage()]);
    }
}
// Si la acción no es reconocida o el método es incorrecto
else {
    error_log("VentasController: Acción o método no permitido. Action: " . $action . ", Method: " . $method);
    echo json_encode(['success' => false, 'message' => 'Acción o método no permitido.']);
}

$conexion->close();
?>