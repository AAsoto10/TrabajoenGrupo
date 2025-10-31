<?php 
include("conexion.php");
$id=$_GET['id'];

$stmt=$con->prepare('DELETE FROM medicos WHERE id=?');
$stmt->bind_param("i",$id);
// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro de medico eliminado";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>

