<?php include("conexion.php");

$nombres=$_POST['nombre'];
$especialidad=$_POST['especialidad'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];

$validar = $con->prepare("SELECT * FROM citas WHERE id_medico=? AND fecha_cita=? AND hora_cita=?");
$validar->bind_param('iss', $id_medico, $fecha, $hora);
$validar->execute();
$res = $validar->get_result();

if($res->num_rows > 0){
    echo "⚠️ Error: El médico ya tiene una cita en esa fecha y hora.";
    exit;
}

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

