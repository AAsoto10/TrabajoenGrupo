<?php
require_once __DIR__ . '/../conexion.php';

$action = $_REQUEST['action'] ?? 'list';

if ($action === 'list') {
    $res = $mysqli->query(
        "SELECT c.*, m.nombre AS medico_nombre, p.nombre AS paciente_nombre
         FROM citas c
         JOIN medicos m ON c.medico_id = m.id
         JOIN pacientes p ON c.paciente_id = p.id
         ORDER BY fecha, hora"
    );
    $rows = [];
    while ($r = $res->fetch_assoc()) $rows[] = $r;
    json_response($rows);
}

if ($action === 'create') {
    $medico_id = intval($_POST['medico_id'] ?? 0);
    $paciente_id = intval($_POST['paciente_id'] ?? 0);
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';

    // simple server-side check to avoid double-booking
    $check = $mysqli->prepare("SELECT COUNT(*) as cnt FROM citas WHERE medico_id=? AND fecha=? AND hora=?");
    $check->bind_param('iss', $medico_id, $fecha, $hora);
    $check->execute();
    $res = $check->get_result()->fetch_assoc();
    if ($res['cnt'] > 0) {
        json_response(['success' => false, 'error' => 'El médico ya tiene una cita en esa fecha y hora']);
    }

    $stmt = $mysqli->prepare("INSERT INTO citas (medico_id, paciente_id, fecha, hora, motivo) VALUES (?,?,?,?,?)");
    $motivo = $_POST['motivo'] ?? '';
    $stmt->bind_param('iisss', $medico_id, $paciente_id, $fecha, $hora, $motivo);
    if ($stmt->execute()) json_response(['success' => true, 'id' => $stmt->insert_id]);
    else json_response(['success' => false, 'error' => $stmt->error]);
}

if ($action === 'delete') {
    $id = intval($_POST['id'] ?? 0);
    $stmt = $mysqli->prepare("DELETE FROM citas WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) json_response(['success' => true]);
    else json_response(['success' => false, 'error' => $stmt->error]);
}

if ($action === 'update') {
    $id = intval($_POST['id'] ?? 0);
    $medico_id = intval($_POST['medico_id'] ?? 0);
    $paciente_id = intval($_POST['paciente_id'] ?? 0);
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $motivo = $_POST['motivo'] ?? '';

    // check double-booking excluding this appointment
    $check = $mysqli->prepare("SELECT COUNT(*) as cnt FROM citas WHERE medico_id=? AND fecha=? AND hora=? AND id<>?");
    $check->bind_param('issi', $medico_id, $fecha, $hora, $id);
    $check->execute();
    $res = $check->get_result()->fetch_assoc();
    if ($res['cnt'] > 0) {
        json_response(['success' => false, 'error' => 'El médico ya tiene una cita en esa fecha y hora']);
    }

    $stmt = $mysqli->prepare("UPDATE citas SET medico_id=?, paciente_id=?, fecha=?, hora=?, motivo=? WHERE id=?");
    $stmt->bind_param('iisssi', $medico_id, $paciente_id, $fecha, $hora, $motivo, $id);
    if ($stmt->execute()) json_response(['success' => true]);
    else json_response(['success' => false, 'error' => $stmt->error]);
}

json_response(['error' => 'Acción no reconocida']);

?>
