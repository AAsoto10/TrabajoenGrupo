<?php
// conexion.php - configuración de conexión MySQL (ajusta según tu XAMPP)
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db_citas_medicas';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo de conexión: ' . $mysqli->connect_error]);
    exit;
}

// establecer charset
$mysqli->set_charset('utf8mb4');

function json_response($data) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}

?>
