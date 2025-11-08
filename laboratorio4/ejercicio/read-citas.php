<?php
include("conexion.php");

$buscar = isset($_GET['buscar']) ? "%".$_GET['buscar']."%" : "%%";

$sql = "SELECT 
            c.id, fecha_cita, hora_cita, motivo, estado, m.nombre AS medico,
            p.nombre AS paciente
 FROM citas c
        INNER JOIN medicos m ON c.id_medico = m.id
        INNER JOIN pacientes p ON c.id_paciente = p.id
        WHERE (m.nombre LIKE ? OR p.nombre LIKE ? OR c.motivo LIKE ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $buscar, $buscar, $buscar);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    echo '<table border="1" style="border-collapse:collapse; margin-top:10px;">
        <tr style="background:#5c6bf3; color:white;">
            <th>Médico</th>
            <th>Paciente</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Motivo</th>
            <th>Estado</th>
            <th>Operaciones</th>
        </tr>';
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['medico']}</td>
            <td>{$row['paciente']}</td>
            <td>{$row['fecha_cita']}</td>
            <td>{$row['hora_cita']}</td>
            <td>{$row['motivo']}</td>
            <td>{$row['estado']}</td>
            <td>
                <a href='javascript:cambiarEstado({$row['id']}, 'Atendida')'>Atender</a> |
                <a href='javascript:cambiarEstado({$row['id']}, 'Cancelada')'>Cancelar</a>
            </td>
        </tr>";
    }
    echo '</table>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Citas</title>
</head>
<body>
<h2>Listado de citas</h2>

<input type="text" id="buscar" placeholder="Buscar médico, paciente o motivo">
<button onclick="buscarCitas()">Buscar</button>

<div id="tabla-citas">
<table border="1" style="border-collapse:collapse; margin-top:10px;">
<tr style="background:#5c6bf3; color:white;">
    <th>Médico</th>
    <th>Paciente</th>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Motivo</th>
    <th>Estado</th>
    <th>Operaciones</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['medico'] ?></td>
    <td><?= $row['paciente'] ?></td>
    <td><?= $row['fecha_cita'] ?></td>
    <td><?= $row['hora_cita'] ?></td>
    <td><?= $row['motivo'] ?></td>
    <td><?= $row['estado'] ?></td>
    <td>
        <a href="javascript:cambiarEstado(<?= $row['id'] ?>, 'Atendida')">Atender</a> |
        <a href="javascript:cambiarEstado(<?= $row['id'] ?>, 'Cancelada')">Cancelar</a>
    </td>
</tr>
<?php } ?>
</table>
</div>

<script src="ajax.js"></script>
</body>
</html>
