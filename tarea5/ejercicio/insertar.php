<?php
include("conexion.php");

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$cu = $_POST['cu'];
$sexo = $_POST['sexo'];
$carrera = $_POST['carrera'];

for ($i = 0; $i < count($nombres); $i++) {
    if (isset($_FILES['fotografia']['name'][$i])) {
    $nombre_archivo = $_FILES['fotografia']['name'][$i];
    $nombre_temporal = $_FILES['fotografia']['tmp_name'][$i];
    $extension = explode(".", $nombre_archivo);
    $nombre_nuevo = uniqid() . "." . end($extension);
    copy($nombre_temporal, "images/".$nombre_nuevo);
}

    $sql = "INSERT INTO alumnos (fotografia, nombres, apellidos, cu, sexo, codigocarrera)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssi", $nombre_nuevo, $nombres[$i], $apellidos[$i], $cu[$i], $sexo[$i], $carrera[$i]);
    $stmt->execute();
}

$sql = "SELECT a.id,fotografia,nombres,apellidos,cu,sexo, carrera as carrera_id FROM alumnos a 
JOIN carreras c ON a.codigocarrera = c.id";
$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px 12px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<table border="1">
<tr>
    <th>Nro</th>
    <th>Foto</th>
    <th>Nombres</th>
    <th>Apellidos</th>
    <th>CU</th>
    <th>Sexo</th>
    <th>Carrera</th>
</tr>
<?php $n = 1; while($row = $resultado->fetch_assoc()){ ?>
<tr>
    <td><?php echo $n++ ?></td>
    <td><img width="50px" src="images/<?php echo $row['fotografia'] ?>" alt=""></td>
    <td><?php echo $row['nombres'] ?></td>
    <td><?php echo $row['apellidos'] ?></td>
    <td><?php echo $row['cu'] ?></td>
    <td><?php echo $row['sexo'] == 'M' ? 'Masculino' : 'Femenino' ?></td>
    <td><?php echo $row['carrera_id'] ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>


