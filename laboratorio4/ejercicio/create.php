<?php include("conexion.php");

$nombres=$_POST['nombre'];
$especialidad=$_POST['especialidad'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];

$stmt=$con->prepare('INSERT INTO medicos(nombre,especialidad,telefono,correo) VALUES(?,?,?,?)');

// Vincular parámetros
$stmt->bind_param("ssss",$nombres, $especialidad,$telefono,$correo);



// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Nuevo registro creado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$con->close();
?>

