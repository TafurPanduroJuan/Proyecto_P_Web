<?php
session_start();
require_once '../config/conexion.php';

$action = $_GET['action'] ?? '';

if ($action === 'list') {
    $stmt = $db->query("SELECT * FROM empleados ORDER BY id DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

elseif ($action === 'insert') {
    $stmt = $db->prepare("INSERT INTO empleados (nombre, apellido, cargo, email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['nombre'], $_POST['apellido'], $_POST['cargo'], $_POST['email']]);
    echo "OK";
}

elseif ($action === 'update') {
    $stmt = $db->prepare("UPDATE empleados SET nombre=?, apellido=?, cargo=?, email=? WHERE id=?");
    $stmt->execute([$_POST['nombre'], $_POST['apellido'], $_POST['cargo'], $_POST['email'], $_POST['id']]);
    echo "Actualizado";
}

elseif ($action === 'delete') {
    $stmt = $db->prepare("DELETE FROM team WHERE id=?");
    $stmt->execute([$_POST['id']]);
    echo "Eliminado";
}