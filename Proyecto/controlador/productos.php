<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = $_GET['action'] ?? '';
$archivo = 'productos.json';

function leerProductos($archivo) {
    if (!file_exists($archivo)) return [];
    $contenido = file_get_contents($archivo);
    return json_decode($contenido, true);
}

function guardarProductos($archivo, $productos) {
    file_put_contents($archivo, json_encode($productos, JSON_PRETTY_PRINT));
}

if ($action === 'list') {
    echo json_encode(leerProductos($archivo));
}

elseif ($action === 'insert') {
    $productos = leerProductos($archivo);
    $nuevo = [
        'id' => time(),
        'nombre' => $_POST['nombre'],
        'numero' => $_POST['numero'],
        'estado' => $_POST['estado']
    ];
    $productos[] = $nuevo;
    guardarProductos($archivo, $productos);
    echo "Producto agregado";
}

elseif ($action === 'delete') {
    $productos = leerProductos($archivo);
    $productos = array_filter($productos, fn($p) => $p['id'] != $_POST['id']);
    guardarProductos($archivo, array_values($productos));
    echo "Producto eliminado";
}
?>
