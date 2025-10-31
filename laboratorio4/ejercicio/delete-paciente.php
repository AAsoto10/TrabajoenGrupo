<?php 
include("conexion.php");
$id=$_GET['id'];

$stmt=$con->prepare('DELETE FROM pacientes WHERE id=?');
$stmt->bind_param("i",$id);
// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro de paciente eliminado";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>

