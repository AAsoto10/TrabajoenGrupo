<?php include("conexion.php");

$nombres=$_POST['nombres'];
$documento=$_POST['documento'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];

$stmt=$con->prepare('INSERT INTO pacientes(nombre,documento,telefono,correo) VALUES(?,?,?,?)');

// Vincular parámetros
$stmt->bind_param("ssss",$nombres, $documento,$telefono,$correo);



// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Nuevo registro creado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>

