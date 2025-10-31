<?php include("conexion.php");

$nombres=$_POST['nombre'];
$especialidad=$_POST['especialidad'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$id=$_POST['id'];



$stmt=$con->prepare('UPDATE medicos SET nombre=?,especialidad=?,telefono=?,correo=? WHERE id=?');

// Vincular parámetros
$stmt->bind_param("ssssi",$nombres, $especialidad,$telefono,$correo, $id);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro Actualizado";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>
