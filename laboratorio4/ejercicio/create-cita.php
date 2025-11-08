<?php 
    include("conexion.php");
    $id_medico = $_POST['medico'];
    $id_paciente = $_POST['paciente'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];
    $sql = "INSERT INTO citas (id_medico, id_paciente, fecha_cita, hora_cita, motivo, estado) VALUES (?,?,?,?,?,?)";
    $estado = 'Pendiente';
    $stmt=$con->prepare($sql);
    $stmt->bind_param('iissss', $id_medico, $id_paciente, $fecha, $hora, $motivo, $estado);
if($stmt->execute())
{
    echo "registro exitoso";
}
?>
?>