<?php
require_once __DIR__ . '/../conexion.php';

$action = $_REQUEST['action'] ?? 'list';

if ($action === 'list') {
    $res = $mysqli->query("SELECT * FROM medicos ORDER BY nombre");
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    json_response($rows);
}

if ($action === 'create') {
    $nombre = $_POST['nombre'] ?? '';
    $especialidad = $_POST['especialidad'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $stmt = $mysqli->prepare("INSERT INTO medicos (nombre, especialidad, telefono, correo) VALUES (?,?,?,?)");
    $stmt->bind_param('ssss', $nombre, $especialidad, $telefono, $correo);
    if ($stmt->execute()) json_response(['success' => true, 'id' => $stmt->insert_id]);
    else json_response(['success' => false, 'error' => $stmt->error]);
}

if ($action === 'update') {
    $id = intval($_POST['id'] ?? 0);
    $nombre = $_POST['nombre'] ?? '';
    $especialidad = $_POST['especialidad'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $stmt = $mysqli->prepare("UPDATE medicos SET nombre=?, especialidad=?, telefono=?, correo=? WHERE id=?");
    $stmt->bind_param('ssssi', $nombre, $especialidad, $telefono, $correo, $id);
    if ($stmt->execute()) json_response(['success' => true]);
    else json_response(['success' => false, 'error' => $stmt->error]);
}

if ($action === 'delete') {
    $id = intval($_POST['id'] ?? 0);
    $stmt = $mysqli->prepare("DELETE FROM medicos WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) json_response(['success' => true]);
    else json_response(['success' => false, 'error' => $stmt->error]);
}

json_response(['error' => 'Acción no reconocida']);

?>
