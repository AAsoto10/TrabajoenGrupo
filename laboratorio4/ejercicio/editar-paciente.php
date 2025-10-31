<?php include("conexion.php");

$nombres=$_POST['nombre'];
$documento=$_POST['documento'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$id=$_POST['id'];



$stmt=$con->prepare('UPDATE pacientes SET nombre=?,documento=?,telefono=?,correo=? WHERE id=?');

// Vincular parámetros
$stmt->bind_param("ssssi",$nombres, $documento,$telefono,$correo, $id);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro de paciente actualizado";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>
