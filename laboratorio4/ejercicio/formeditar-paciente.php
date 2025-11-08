<?php include("conexion.php"); 
    $id=$_GET['id'];
    $sql="SELECT id,nombre,documento,telefono,correo FROM pacientes WHERE id=$id";
    $resultado=$con->query($sql);
    $row = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="javascript:editarPaciente()" method="post" id="form-editare">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row['nombre'];?>">
        <br>
        <label for="documento">Documento:</label>
        <input type="text" name="documento" value="<?php echo $row['documento'];?>">
        <br>
        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" value="<?php echo $row['telefono'];?>">
        <br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?php echo $row['correo'];?>">
        <br>
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <input type="submit" value="Actualizar">

    </form>
    
</body>
</html>